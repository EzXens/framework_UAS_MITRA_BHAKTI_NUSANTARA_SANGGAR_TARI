<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Log the contact message
        Log::info('Contact message received', $validated);

        // Try to send an email to the app mail address if configured (best-effort)
        try {
            $to = Config::get('mail.from.address');
            if ($to) {
                Mail::raw("From: {$validated['name']} ({$validated['email']})\nSubject: {$validated['subject']}\n\n{$validated['message']}", function ($m) use ($to, $validated) {
                    $m->to($to)->subject('Contact Form: ' . ($validated['subject'] ?? 'Support'));
                });
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to send contact message email: ' . $e->getMessage());
        }

        return back()->with('success', 'Terima kasih! Pesan Anda telah diterima. Kami akan menghubungi Anda segera.');
    }
}
