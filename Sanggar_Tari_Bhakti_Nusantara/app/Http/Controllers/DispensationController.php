<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispensation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Helpers\DocxGenerator;
use PhpOffice\PhpWord\TemplateProcessor;

class DispensationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:mahasiswa,siswa',
        ]);

        // Validate depending on selected type and normalize payload
        $payload = [];
        if ($request->input('type') === 'mahasiswa') {
            $v = $request->validate([
                'name' => 'required|string|max:255',
                'id_number' => 'required|string|max:100',
                'school_or_program' => 'required|string|max:255',
                'program' => 'nullable|string|max:255',
                'event_name' => 'required|string|max:255',
                'day' => 'required|string|max:50',
                'date_from' => 'required|date',
                'date_to' => 'nullable|date',
                'time' => 'nullable|string|max:100',
                'place' => 'nullable|string|max:255',
                'city_province' => 'nullable|string|max:255',
            ]);

            $payload = [
                'name' => $v['name'],
                'id_number' => $v['id_number'],
                'school_or_program' => $v['school_or_program'],
                'program' => $v['program'] ?? null,
                'event_name' => $v['event_name'],
                'day' => $v['day'],
                'date_from' => $v['date_from'],
                'date_to' => $v['date_to'] ?? null,
                'time' => $v['time'] ?? null,
                'place' => $v['place'] ?? null,
                'city_province' => $v['city_province'] ?? null,
            ];
        } else {
            // siswa
            $v = $request->validate([
                'name_siswa' => 'required|string|max:255',
                'id_number_siswa' => 'required|string|max:100',
                'student_class' => 'nullable|string|max:100',
                'school_or_program_siswa' => 'required|string|max:255',
                'event_name_siswa' => 'required|string|max:255',
                'day_siswa' => 'required|string|max:50',
                'date_from_siswa' => 'required|date',
                'date_to_siswa' => 'nullable|date',
                'time_siswa' => 'nullable|string|max:100',
                'place_siswa' => 'nullable|string|max:255',
                'city_province_siswa' => 'nullable|string|max:255',
            ]);

            $payload = [
                'name' => $v['name_siswa'],
                'id_number' => $v['id_number_siswa'],
                'student_class' => $v['student_class'] ?? null,
                'school_or_program' => $v['school_or_program_siswa'],
                'event_name' => $v['event_name_siswa'],
                'day' => $v['day_siswa'],
                'date_from' => $v['date_from_siswa'],
                'date_to' => $v['date_to_siswa'] ?? null,
                'time' => $v['time_siswa'] ?? null,
                'place' => $v['place_siswa'] ?? null,
                'city_province' => $v['city_province_siswa'] ?? null,
            ];
        }

        Dispensation::create([
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'payload' => $payload,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Surat dispensasi berhasil dibuat. Menunggu persetujuan admin.');
    }

    // Admin: list all
    public function adminIndex()
    {
        // only allow admins to view the admin index
        if (auth()->user()->role !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        // Paginate admin list to 15 items per page
        $items = Dispensation::latest()->paginate(15);
        return view('admin.dispensations.index', compact('items'));
    }

    // Admin: show single
    public function adminShow(Dispensation $dispensation)
    {
        // allow admin or owner to view
        $user = auth()->user();
        if ($user->role !== 'admin' && $user->id !== $dispensation->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        return view('admin.dispensations.show', compact('dispensation'));
    }

   public function approve(Dispensation $dispensation)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    // Tentukan kode surat berdasarkan tipe
    $letterCode = ($dispensation->type === 'mahasiswa') ? 'BN.11' : 'BN.06';

    // Generate nomor untuk tipe tersebut saja (mahasiswa & siswa terpisah)
    if (!$dispensation->letter_number) {

        $lastNumber = Dispensation::where('type', $dispensation->type)
            ->whereYear('created_at', date('Y'))
            ->max('letter_number');

        $dispensation->letter_number = $lastNumber ? $lastNumber + 1 : 1;
        $dispensation->letter_code   = $letterCode;
        $dispensation->save();
    }

    // Lanjut generate dokumen
    try {
        $this->generateDocuments($dispensation);
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal generate: ' . $e->getMessage());
    }

    $dispensation->update(['status' => 'approved']);
    return back()->with('success', 'Berhasil Disetujui Dan Dokumen berhasil digenerate.');
}

// fungsi clean html untuk DOCX ke PDF
private function cleanHtmlForPdf($html)
{
    // ✅ HANYA hapus style khusus Word (mso-*)
    $html = preg_replace('/mso-[^:]+:[^;"]+;?/i', '', $html);

    // ✅ Hapus class Word
    $html = preg_replace('/class="[^"]*"/i', '', $html);

    // ✅ Normalisasi spasi Word
    $html = str_replace(['&nbsp;'], ' ', $html);

    // ✅ Pastikan paragraf aman
    $html = preg_replace(
        '/<p([^>]*)>/i',
        '<p$1 style="margin:0 0 12px 0;">',
        $html
    );

    // ✅ Tabel rapi
    $html = str_replace(
        '<table>',
        '<table style="width:100%; border-collapse:collapse;">',
        $html
    );

    // ✅ Pastikan bold tetap aktif
    $html = str_replace(['<b>', '</b>'], ['<strong>', '</strong>'], $html);

    // ✅ FORCE ulang font-weight kalau masih ada sisa
    $html = str_replace(
        ['font-weight:700', 'font-weight: 700'],
        'font-weight:bold',
        $html
    );

    // ✅ FORCE underline tetap hidup
    $html = str_replace(
        ['text-decoration:underline'],
        'text-decoration: underline',
        $html
    );

    // ✅ PAKSA TAG <u> agar DomPDF tidak abaikan
    $html = str_replace(
        ['<u>', '</u>'],
        ['<span style="text-decoration: underline;">', '</span>'],
        $html
    );

    return $html;
}


    /**
 * Convert DOCX file to HTML string
 */
private function convertDocxToHtml($filePath)
{
    if (!file_exists($filePath)) {
        throw new \Exception("File DOCX tidak ditemukan: $filePath");
    }

    // Load DOCX
    $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath, 'Word2007');

    // Buat writer HTML
    $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

    // Simpan sementara ke file HTML
    $tempHtmlPath = storage_path('app/temp_' . uniqid() . '.html');
    $writer->save($tempHtmlPath);

    // Baca konten HTML
    $html = file_get_contents($tempHtmlPath);

    // Hapus file sementara
    @unlink($tempHtmlPath);

    return $html;
}

function tanggalIndo($date)
{
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $tgl = date('j', strtotime($date));
    $bln = $bulan[(int)date('n', strtotime($date))];
    $thn = date('Y', strtotime($date));

    return "$tgl $bln $thn";
}




    /**
     * Admin action to (re)generate the DOCX/PDF for an existing dispensation.
     */
    public function generate(Dispensation $dispensation)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        try {
            $this->generateDocuments($dispensation);
            return redirect()->back()->with('success', 'Dokumen dispensasi berhasil digenerate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengenerate dokumen: ' . $e->getMessage());
        }
    }

    


    /**
     * Internal: generate DOCX using native PHP (no external libraries needed).
     * Maps payload to template placeholders like [Nama_Mahasiswa].
     */
    protected function generateDocuments(Dispensation $dispensation)
    {
        $p = $dispensation->payload ?? [];

        // Pilih template berdasarkan type
        $templateFilename = ($dispensation->type === 'mahasiswa') 
            ? 'dispen_kuliah.docx' 
            : 'dispen_sekolah.docx';

        $templateFile = public_path('images/surat/' . $templateFilename);

        if (!file_exists($templateFile)) {
            throw new \RuntimeException("Template DOCX tidak ditemukan: {$templateFile}");
        }

        // Load TemplateProcessor
        $template = new TemplateProcessor($templateFile);

        // =============================
        // 1. VARIABEL SESUAI FORMAT [TAG]
        // =============================
        $variables = [
            'Nomor_Surat' => 
        str_pad($dispensation->letter_number, 2, '0', STR_PAD_LEFT)
        . '/' . $dispensation->letter_code
        . '/' . date('Y'),

            'Tahun_Sekarang'         => date('Y'),
            'Tanggal_Surat' => $this->tanggalIndo(now()),
            'Hari'                   => $p['day'] ?? '—',
            'Tanggal_Dilaksanakan'   => (function($p){
                // Indonesian month names
                $months = [1=> 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

                if (!isset($p['date_from']) || !$p['date_from']) return '—';
                $fromTs = strtotime($p['date_from']);
                if ($fromTs === false) return '—';
                $fromDay = date('j', $fromTs);
                $fromMonth = (int)date('n', $fromTs);
                $fromYear = date('Y', $fromTs);

                if (!isset($p['date_to']) || !$p['date_to']) {
                    return $fromDay . ' ' . $months[$fromMonth] . ' ' . $fromYear;
                }

                $toTs = strtotime($p['date_to']);
                if ($toTs === false) {
                    return $fromDay . ' ' . $months[$fromMonth] . ' ' . $fromYear;
                }
                $toDay = date('j', $toTs);
                $toMonth = (int)date('n', $toTs);
                $toYear = date('Y', $toTs);

                // Same year
                if ($fromYear === $toYear) {
                    // Same month -> "15 - 17 Desember 2025"
                    if ($fromMonth === $toMonth) {
                        return $fromDay . ' - ' . $toDay . ' ' . $months[$fromMonth] . ' ' . $fromYear;
                    }
                    // Different month but same year -> "29 Maret - 1 April 2025"
                    return $fromDay . ' ' . $months[$fromMonth] . ' - ' . $toDay . ' ' . $months[$toMonth] . ' ' . $fromYear;
                }

                // Different years -> include year for both
                return $fromDay . ' ' . $months[$fromMonth] . ' ' . $fromYear . ' - ' . $toDay . ' ' . $months[$toMonth] . ' ' . $toYear;
            })($p),
            'Waktu'                  => $p['time'] ?? '—',
            'Nama_Tempat'            => $p['place'] ?? '—',
            'Kota_Atau_Provinsi'     => $p['city_province'] ?? '—',
        ];

        if ($dispensation->type === 'mahasiswa') {
            $variables['Nama_Kegiatan']         = $p['event_name'] ?? '—';
            $variables['Nama_Mahasiswa']        = $p['name'] ?? '—';
            $variables['Nomor_Induk_Mahasiswa'] = $p['id_number'] ?? '—';
            $variables['Prodi_Mahasiswa']       = $p['program'] ?? '—';
            $variables['Nama_Instansi']         = $p['school_or_program'] ?? '—';
        } else {
            $variables['Nama_Sekolah']          = $p['school_or_program'] ?? '—';
            $variables['Nama_Kegiatan']         = $p['event_name'] ?? '—';
            $variables['Nama_Siswa']            = $p['name'] ?? '—';
            $variables['Nomor_Induk_Siswa']     = $p['id_number'] ?? '—';
            $variables['Kelas_Siswa']           = $p['student_class'] ?? '—';
        }

        // =============================
        // 2. SET VALUE TEMPLATE
        // =============================
        foreach ($variables as $tag => $value) {
            // Tag harus tanpa [] → Word hanya pakai {{TAG}} atau ${TAG}
            // Jadi: pastikan template DOCX pakai format: ${TAG}
            $template->setValue($tag, $value);
        }

       // =============================
        // 3. Simpan DOCX hasil generate
        // =============================

        // Gunakan satu timestamp untuk DOCX & PDF
        $timestamp = time();

        $filename = 'dispensation_' . $dispensation->id . '_' . $timestamp . '.docx';
        $relativePath = 'surat/' . $filename;
        $savePath = storage_path('app/public/' . $relativePath);

        // Pastikan folder ada
        if (!is_dir(dirname($savePath))) {
            mkdir(dirname($savePath), 0755, true);
        }

        // Simpan file DOCX
        $template->saveAs($savePath);

        // Simpan path ke DB
        $dispensation->update(['template' => $relativePath]);


        // =============================
        // 4. Generate PDF (DOCX → HTML → DOMPDF)
        // =============================
        

            // 1. Convert DOCX → HTML
            $html = $this->convertDocxToHtml($savePath);
            $html = $this->cleanHtmlForPdf($html);

        $tanggalSurat = $this->tanggalIndo(now());
        
            // 2. Wrap HTML dengan kop surat (gunakan PNG)
            $html = view('pdf.dispensation', [
                'htmlContent' => $html,
                'tanggalSurat' => $tanggalSurat
            ])->render();

            // 3. Siapkan nama file PDF
            $pdfFilename = 'dispensation_' . $dispensation->id . '_' . $timestamp . '.pdf';
            $pdfRelative = 'surat/' . $pdfFilename;
            $pdfPath = storage_path('app/public/' . $pdfRelative);

            // 4. Render PDF via DOMPDF
            $dompdf = new \Dompdf\Dompdf([
                'isRemoteEnabled' => true, // wajib true agar PNG bisa dibaca
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => false,
            ]);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // 5. Simpan PDF ke storage
            file_put_contents($pdfPath, $dompdf->output());

            // 6. Update path PDF ke database
            $dispensation->update(['pdf' => $pdfRelative]);

            return true;


    }


    public function reject(Request $request, Dispensation $dispensation)
    {
        // only admins can reject
        if (auth()->user()->role !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        $request->validate(['rejection_reason' => 'required|string']);
        $dispensation->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);
        return redirect()->back()->with('success', 'Dispensasi telah ditolak.');
    }
}
