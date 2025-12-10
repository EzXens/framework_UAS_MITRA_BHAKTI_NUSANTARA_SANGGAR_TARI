<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\VerificationMail;
use App\Mail\PasswordResetMail;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check existing user
        $existing = User::where('email', $request->email)->first();

        if ($existing) {
            // If already verified, block registration
            if (!is_null($existing->email_verified_at)) {
                return back()->withErrors(['email' => 'Alamat email sudah digunakan. Silakan login atau gunakan email lain.'])->withInput();
            }

            // If exists but not verified, update name/password with submitted data
            $existing->name = $request->name;
            $existing->password = Hash::make($request->password);
            $existing->save();

            $user = $existing;
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);
        }

        // create verification token and send email
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expires = Carbon::now()->addHours(24);

        // rate limit: max 3 tokens in last 24 hours
        $recentCount = DB::table('email_verification_tokens')
            ->where('email', $user->email)
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();

        if ($recentCount >= 3) {
            return redirect()->route('home')->with('warning', 'Terlalu banyak permintaan verifikasi. Coba lagi nanti.');
        }

        DB::table('email_verification_tokens')->insert([
            'email' => $user->email,
            'token_hash' => $tokenHash,
            'expires_at' => $expires,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        try {
            Mail::to($user->email)->send(new VerificationMail($user->email, $token));
        } catch (\Exception $e) {
            // log but continue
            Log::error('Failed sending verification email', ['email' => $user->email, 'err' => $e->getMessage()]);
        }

        // For development: log token so developer can retrieve when mail isn't configured
        Log::info('Email verification token generated', ['email' => $user->email, 'token' => $token]);

        // In debug, flash token (so dev can see on UI) — only for local/dev
        if (config('app.debug')) {
            session()->flash('verification_token', $token);
        }

        return redirect()->route('verification.notice')->with('success', 'Registrasi berhasil! Silakan cek email untuk verifikasi.');
    }

    // Verify email via token
    public function verifyEmail($token)
    {
        $tokenHash = hash('sha256', $token);
        $row = DB::table('email_verification_tokens')
            ->where('token_hash', $tokenHash)
            ->where('used_at', null)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$row) {
            return redirect()->route('home')->with('error', 'Token verifikasi tidak valid atau telah kedaluwarsa.');
        }

        $user = User::where('email', $row->email)->first();
        if (!$user) {
            return redirect()->route('home')->with('error', 'Akun tidak ditemukan.');
        }

        $user->email_verified_at = Carbon::now();
        $user->save();

        DB::table('email_verification_tokens')->where('id', $row->id)->update(['used_at' => Carbon::now()]);

        return redirect()->route('home')->with('success', 'Email berhasil diverifikasi. Anda sekarang dapat login.');
    }

    // Show a notice page after registration asking user to verify
    public function showVerifyNotice()
    {
        return view('auth.verify_notice');
    }

    // Resend verification token (rate-limited)
    public function resendVerification(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->with('warning', 'Jika email terdaftar, instruksi verifikasi akan dikirim.');
        }

        // limit resends: max 3 in 24 hours
        $recentCount = DB::table('email_verification_tokens')
            ->where('email', $email)
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();

        if ($recentCount >= 3) {
            return back()->with('warning', 'Terlalu banyak permintaan. Coba lagi nanti.');
        }

        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expires = Carbon::now()->addHours(24);

        DB::table('email_verification_tokens')->insert([
            'email' => $email,
            'token_hash' => $tokenHash,
            'expires_at' => $expires,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        try {
            Mail::to($email)->send(new VerificationMail($email, $token));
        } catch (\Exception $e) {
            Log::error('Failed resending verification email', ['email' => $email, 'err' => $e->getMessage()]);
        }

        if (config('app.debug')) session()->flash('verification_token', $token);

        return back()->with('success', 'Instruksi verifikasi telah dikirim (cek email).');
    }

    // Verify email using manual token code
    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $token = $request->code;

        $tokenHash = hash('sha256', $token);
        $row = DB::table('email_verification_tokens')
            ->where('token_hash', $tokenHash)
            ->where('used_at', null)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$row) {
            return back()->withErrors(['code' => 'Kode verifikasi tidak valid atau telah kedaluwarsa.']);
        }

        $user = User::where('email', $row->email)->first();
        if (!$user) {
            return back()->withErrors(['code' => 'Akun tidak ditemukan.']);
        }

        $user->email_verified_at = Carbon::now();
        $user->save();

        DB::table('email_verification_tokens')->where('id', $row->id)->update(['used_at' => Carbon::now()]);

        return redirect()->route('home')->with('success', 'Email berhasil diverifikasi! Anda sekarang dapat login.');
    }

    // Show forgot password form
    public function showForgot()
    {
        return view('auth.passwords.forgot');
    }

    // Handle forgot password submit
    public function sendForgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if (!$user) {
            // don't reveal - respond as if sent
            return back()->with('success', 'Jika alamat email terdaftar, instruksi reset telah dikirim.');
        }

        // create reset token (1 hour expiry)
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $tokenHash, 'created_at' => Carbon::now()]
        );

        try {
            Mail::to($email)->send(new PasswordResetMail($email, $token));
        } catch (\Exception $e) {}

        return back()->with('success', 'Jika alamat email terdaftar, instruksi reset telah dikirim.');
    }

    // Show reset password notice page (ask for token input)
    public function showResetNotice()
    {
        return view('auth.passwords.reset_notice');
    }

    // Verify reset token manually
    public function verifyResetCode(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $token = $request->code;
        $tokenHash = hash('sha256', $token);

        $row = DB::table('password_reset_tokens')
            ->where('token', $tokenHash)
            ->first();

        if (!$row) {
            return back()->withErrors(['code' => 'Kode reset tidak valid atau telah kedaluwarsa.']);
        }

        // check expiry (1 hour)
        if (Carbon::parse($row->created_at)->addHour()->isPast()) {
            return back()->withErrors(['code' => 'Kode reset telah kedaluwarsa.']);
        }

        // For development: log token so developer can retrieve when mail isn't configured
        if (config('app.debug')) {
            session()->flash('reset_token', $token);
        }

        return redirect()->route('password.reset', ['token' => $token]);
    }

    // Show reset password form
    public function showReset($token)
    {
        return view('auth.passwords.reset')->with(['token' => $token]);
    }

    // Process reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $token = $request->token;
        $tokenHash = hash('sha256', $token);

        $row = DB::table('password_reset_tokens')
            ->where('token', $tokenHash)
            ->first();

        if (!$row) {
            return back()->withErrors(['token' => 'Token tidak valid atau kedaluwarsa.']);
        }

        // check expiry (1 hour)
        if (Carbon::parse($row->created_at)->addHour()->isPast()) {
            return back()->withErrors(['token' => 'Token telah kedaluwarsa.']);
        }

        $user = User::where('email', $row->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // remove token
        DB::table('password_reset_tokens')->where('email', $row->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            // Restrict access if email not verified
            $user = Auth::user();
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun belum diverifikasi. Silakan cek email Anda.']);
            }

            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'Logout berhasil!');
    }
}
