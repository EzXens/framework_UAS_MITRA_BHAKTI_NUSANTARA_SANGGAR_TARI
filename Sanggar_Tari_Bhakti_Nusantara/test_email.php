<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    Mail::raw('Test email dari Laravel', function($message) {
        $message->to('bhaktimahakamemail@gmail.com')->subject('Test Email');
    });
    echo 'Email test dikirim berhasil';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}