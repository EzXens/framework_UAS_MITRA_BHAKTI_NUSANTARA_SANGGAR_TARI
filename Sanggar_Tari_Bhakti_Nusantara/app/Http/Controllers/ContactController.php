<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http; // <-- WAJIB

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function submit(Request $request)
    {
        // 1. Validasi input + captcha
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'cf-turnstile-response' => 'required', // Wajib
        ]);

        // 2. Verifikasi ke Cloudflare Turnstile
        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => env('TURNSTILE_SECRET'),
            'response' => $request->input('cf-turnstile-response'),
            'remoteip' => $request->ip(),
        ]);

        $verification = $response->json();

        if (!$verification['success']) {
            return back()->withErrors([
                'captcha' => 'Verifikasi captcha gagal. Silakan coba lagi.'
            ])->withInput();
        }

        // 3. Log Pesan
        Log::info('Contact message received', $validated);

        // 4. Kirim Email (opsional)
        try {
            $to = Config::get('mail.from.address');

            if ($to) {
                Mail::raw(
                    "From: {$validated['name']} ({$validated['email']})\n"
                    . "Subject: {$validated['subject']}\n\n"
                    . "{$validated['message']}",
                    function ($m) use ($to, $validated) {
                        $m->to($to)->subject('Contact Form: ' . ($validated['subject'] ?? 'Support'));
                    }
                );
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to send contact message email: ' . $e->getMessage());
        }

        return back()->with('success', 'Terima kasih! Pesan Anda telah diterima. Kami akan menghubungi Anda segera.');
    }
}
