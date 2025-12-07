<?php

namespace App\Helpers;

use Exception;

/**
 * DOCX Generator - pure PHP DOCX template processor
 * Supports: ZipArchive, phar:// stream wrapper, or PowerShell/zip commands
 */
class DocxGenerator
{
    public static function generate($templatePath, $variables, $outputPath)
    {
        if (!file_exists($templatePath)) {
            throw new Exception("Template not found: {$templatePath}");
        }

        $outputDir = dirname($outputPath);
        if (!is_dir($outputDir)) {
            @mkdir($outputDir, 0755, true);
        }

        $tempDir = sys_get_temp_dir() . '/docx_' . uniqid();
        if (!@mkdir($tempDir, 0755, true)) {
            throw new Exception("Cannot create temp directory");
        }

        try {
            if (extension_loaded('zip') && class_exists('\ZipArchive')) {
                self::methodZipArchive($templatePath, $variables, $tempDir, $outputPath);
            } elseif (in_array('phar', stream_get_wrappers())) {
                try {
                    self::methodPharStream($templatePath, $variables, $tempDir, $outputPath);
                } catch (Exception $e) {
                    // phar failed (not a real phar), try PowerShell extraction on Windows
                    if (PHP_OS_FAMILY === 'Windows') {
                        self::methodShellExtract($templatePath, $variables, $tempDir, $outputPath);
                    } else {
                        throw $e;
                    }
                }
            } elseif (PHP_OS_FAMILY === 'Windows') {
                // Try PowerShell extraction as a last resort on Windows
                self::methodShellExtract($templatePath, $variables, $tempDir, $outputPath);
            } else {
                throw new Exception(
                    "Missing: PHP zip extension or phar wrapper. " .
                    "Enable extension=zip in php.ini (Windows XAMPP)"
                );
            }
            return true;
        } finally {
            self::cleanupDir($tempDir);
        }
    }

    private static function methodZipArchive($templatePath, $variables, $tempDir, $outputPath)
    {
        $zip = new \ZipArchive();
        if ($zip->open($templatePath) !== true) {
            throw new Exception("Failed to open DOCX");
        }
        $zip->extractTo($tempDir);
        $zip->close();

        self::replaceInDocument($tempDir, $variables);

        $zip = new \ZipArchive();
        if ($zip->open($outputPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            throw new Exception("Failed to create output DOCX");
        }
        self::addDirToZip($tempDir, $zip);
        $zip->close();
    }

    private static function methodPharStream($templatePath, $variables, $tempDir, $outputPath)
    {
        $realPath = realpath($templatePath);
        $pharUrl = "phar://" . $realPath;
        self::copyFromPhar($pharUrl, $tempDir);

        self::replaceInDocument($tempDir, $variables);

        self::createZip($tempDir, $outputPath);
    }

    private static function copyFromPhar($pharUrl, $target)
    {
        @mkdir($target, 0755, true);
        
        $handle = @opendir($pharUrl);
        if (!$handle) {
            throw new Exception("Cannot read phar stream");
        }

        while (false !== ($file = @readdir($handle))) {
            if ($file === '.' || $file === '..') continue;

            $src = $pharUrl . '/' . $file;
            $dst = $target . '/' . $file;

            if (@is_dir($src)) {
                self::copyFromPhar($src, $dst);
            } else {
                $content = @file_get_contents($src);
                if ($content !== false) {
                    @mkdir(dirname($dst), 0755, true);
                    file_put_contents($dst, $content);
                }
            }
        }
        @closedir($handle);
    }

    private static function replaceInDocument($tempDir, $variables)
    {
        $docPath = $tempDir . '/word/document.xml';
        if (!file_exists($docPath)) {
            throw new Exception("document.xml not found");
        }

        $xml = file_get_contents($docPath);
        foreach ($variables as $key => $value) {
            $xml = str_replace("[{$key}]", (string)$value, $xml);
        }
        file_put_contents($docPath, $xml);
    }

    private static function createZip($source, $output)
    {
        if (extension_loaded('zip') && class_exists('\ZipArchive')) {
            $zip = new \ZipArchive();
            if ($zip->open($output, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
                throw new Exception("Failed to create ZIP");
            }
            self::addDirToZip($source, $zip);
            $zip->close();
        } else {
            self::createZipViaShell($source, $output);
        }
    }

    /**
     * Extract DOCX using PowerShell Expand-Archive, replace placeholders, and re-zip.
     * Windows-only fallback when ZipArchive and phar stream are not viable.
     * Note: PowerShell Expand-Archive only accepts .zip files, so we copy DOCX to .zip, extract, replace, and re-zip.
     */
    private static function methodShellExtract($templatePath, $variables, $tempDir, $outputPath)
    {
        // Ensure temp dir exists
        @mkdir($tempDir, 0755, true);

        $templateReal = realpath($templatePath);
        if ($templateReal === false) {
            throw new Exception('Template realpath failed');
        }

        // PowerShell Expand-Archive only accepts .zip files, so copy .docx to temp .zip
        $tempZipSrc = sys_get_temp_dir() . '/docx_' . uniqid() . '.zip';
        if (!@copy($templateReal, $tempZipSrc)) {
            throw new Exception('Failed to copy DOCX to temporary .zip for extraction');
        }

        try {
            // Use encoded PowerShell command to avoid quoting problems with spaces
            $psSrcRaw = str_replace("'", "''", $tempZipSrc);
            $psDestRaw = str_replace("'", "''", $tempDir);
            $expandScript = "Expand-Archive -LiteralPath '$psSrcRaw' -DestinationPath '$psDestRaw' -Force";
            list($out, $code) = self::runPowerShellCommand($expandScript);
            if ($code !== 0) {
                $msg = is_array($out) ? implode(' | ', array_slice($out, 0, 5)) : (string)$out;
                throw new Exception('PowerShell Expand-Archive failed: ' . $msg);
            }

            // Do replacement
            self::replaceInDocument($tempDir, $variables);

            // Recreate DOCX using PowerShell Compress-Archive if ZipArchive not present
            if (extension_loaded('zip') && class_exists('\ZipArchive')) {
                $zip = new \ZipArchive();
                if ($zip->open($outputPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
                    throw new Exception('Failed to create output DOCX via ZipArchive');
                }
                self::addDirToZip($tempDir, $zip);
                $zip->close();
                return;
            }

            // PowerShell Compress-Archive only accepts .zip files, so create with .zip then rename to .docx
            $tempZipOut = sys_get_temp_dir() . '/output_' . uniqid() . '.zip';
            $tempZipOutRaw = str_replace("'", "''", $tempZipOut);
            
            // Compress the contents of tempDir into a temporary .zip file
            $compressScript = "Set-Location -LiteralPath '$psDestRaw'; Compress-Archive -Path * -DestinationPath '$tempZipOutRaw' -Force";
            list($out2, $code2) = self::runPowerShellCommand($compressScript);
            if ($code2 !== 0) {
                $msg2 = is_array($out2) ? implode(' | ', array_slice($out2, 0, 5)) : (string)$out2;
                @unlink($tempZipOut); // cleanup temp zip on error
                throw new Exception('PowerShell Compress-Archive failed: ' . $msg2);
            }

            // Rename the temporary .zip to the output .docx path
            if (!@rename($tempZipOut, $outputPath)) {
                @unlink($tempZipOut);
                throw new Exception('Failed to rename compressed archive to output DOCX');
            }
        } finally {
            // Clean up temporary zip copy
            @unlink($tempZipSrc);
        }
    }

    private static function createZipViaShell($source, $output)
    {
        // Ensure inputs are strings to avoid passing arrays to escapeshellarg
        $sourceStr = is_string($source) ? $source : (string) $source;
        $outputStr = is_string($output) ? $output : (string) $output;

        if (PHP_OS_FAMILY === 'Windows') {
            // Use encoded PowerShell to avoid quoting issues
            $srcRaw = str_replace("'", "''", $sourceStr);
            // Create temporary .zip file since PowerShell Compress-Archive only accepts .zip extension
            $tempZipOut = sys_get_temp_dir() . '/output_' . uniqid() . '.zip';
            $tempZipOutRaw = str_replace("'", "''", $tempZipOut);
            
            $script = "Set-Location -LiteralPath '$srcRaw'; Compress-Archive -Path * -DestinationPath '$tempZipOutRaw' -Force";
            list($execOutput, $code) = self::runPowerShellCommand($script);
            if ($code === 0) {
                // Successfully created temp .zip, now rename it to the target .docx
                if (@rename($tempZipOut, $outputStr)) {
                    return; // Success
                }
                @unlink($tempZipOut); // cleanup on rename failure
            }
        }

        // Fallback to shell zip command (may not exist on Windows)
        $srcEsc = escapeshellarg($sourceStr);
        $outEsc = escapeshellarg($outputStr);
        $cmd = "cd $srcEsc ; zip -r -q $outEsc . 2>&1";
        $execOutput = [];
        @exec($cmd, $execOutput, $code);

        if (!isset($code) || $code !== 0) {
            $msg = implode(" | ", array_slice($execOutput, 0, 2));
            throw new Exception("ZIP creation failed: {$msg}");
        }
    }

    /**
     * Run a PowerShell script using -EncodedCommand to avoid quoting issues.
     * Returns array: [outputArray, exitCode]
     */
    private static function runPowerShellCommand($script)
    {
        // Ensure UTF-16LE encoding for PowerShell -EncodedCommand
        $utf16 = mb_convert_encoding($script, 'UTF-16LE');
        $b64 = base64_encode($utf16);
        $cmd = "powershell -NoProfile -NonInteractive -EncodedCommand $b64 2>&1";
        $out = [];
        @exec($cmd, $out, $code);
        return [$out, $code ?? 1];
    }

    private static function addDirToZip($dir, $zip)
    {
        $files = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
        $it = new \RecursiveIteratorIterator($files, \RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($it as $file) {
            if ($file->isFile()) {
                $path = $file->getRealPath();
                $rel = str_replace($dir . DIRECTORY_SEPARATOR, '', $path);
                $rel = str_replace(DIRECTORY_SEPARATOR, '/', $rel);
                $zip->addFile($path, $rel);
            }
        }
    }

    private static function cleanupDir($dir)
    {
        if (!is_dir($dir)) return;
        
        try {
            $files = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
            $it = new \RecursiveIteratorIterator($files, \RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($it as $file) {
                $file->isDir() ? @rmdir($file->getRealPath()) : @unlink($file->getRealPath());
            }
            @rmdir($dir);
        } catch (Exception $e) {
            // ignore
        }
    }
}
