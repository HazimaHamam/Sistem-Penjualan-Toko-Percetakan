<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use App\Mail\NewsletterVerificationMail;

class NewsletterController extends Controller
{
    /**
     * Halaman form subscribe newsletter.
     */
    public function show()
    {
        return view('frontend.newsletter.subscribe');
    }

    /**
     * Proses subscribe newsletter.
     *
     * Flow:
     * 1. Rate limit — maks 3x/menit per IP
     * 2. Validasi email
     * 3. Cek email sudah terdaftar:
     *    a. Sudah verified  → tolak dengan pesan jelas
     *    b. Belum verified  → regenerate token, kirim ulang email
     *    c. Belum ada sama sekali → buat baru, kirim email
     */
    public function subscribe(Request $request)
    {
        // ── Rate limiting ──────────────────────────────────
        $key = 'newsletter:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return back()
                ->withInput()
                ->withErrors(['email' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik."]);
        }
        RateLimiter::hit($key, 60);

        // ── Validasi ───────────────────────────────────────
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = strtolower($validated['email']);

        // ── Cek existing ───────────────────────────────────
        $existing = Newsletter::where('email', $email)->first();

        if ($existing) {
            if ($existing->is_verified) {
                return back()
                    ->withInput()
                    ->withErrors(['email' => 'Email ini sudah terdaftar dan aktif di newsletter kami.']);
            }

            // Belum verified — regenerate token & kirim ulang
            $existing->update(['verification_token' => Str::uuid()]);
            Mail::to($existing->email)->send(new NewsletterVerificationMail($existing->fresh()));

            return $this->redirectSuccess($request);
        }

        // ── Buat subscriber baru ───────────────────────────
        $newsletter = Newsletter::create([
            'email'              => $email,
            'verification_token' => Str::uuid(),
            'is_verified'        => false,
            'is_active'          => false, // aktif setelah email dikonfirmasi
        ]);

        Mail::to($newsletter->email)->send(new NewsletterVerificationMail($newsletter));

        return $this->redirectSuccess($request);
    }

    /**
     * Verifikasi email via token dari link di email.
     *
     * Flow:
     * 1. Cari subscriber berdasarkan token
     * 2. Token tidak ada / sudah dipakai → error
     * 3. Sudah verified sebelumnya → info
     * 4. Verifikasi: set verified + active, hapus token
     */
    public function verify(string $token)
    {
        $newsletter = Newsletter::where('verification_token', $token)->first();

        if (! $newsletter) {
            return redirect()->route('home')
                ->with('error', 'Link verifikasi tidak valid atau sudah kadaluarsa.');
        }

        if ($newsletter->is_verified) {
            return redirect()->route('home')
                ->with('info', 'Email Anda sudah diverifikasi sebelumnya.');
        }

        $newsletter->update([
            'is_verified'        => true,
            'is_active'          => true,
            'verification_token' => null, // hapus agar tidak bisa dipakai ulang
        ]);

        return redirect()->route('home')
            ->with('success', 'Email berhasil dikonfirmasi. Selamat bergabung! 🎉');
    }

    /**
     * Redirect setelah subscribe berhasil.
     * - Dari /newsletter/subscribe → redirect ke halaman itu (tampil sukses)
     * - Dari partial home atau halaman lain → back() dengan flash
     */
    private function redirectSuccess(Request $request)
    {
        $message = 'Silakan cek email Anda untuk mengkonfirmasi pendaftaran newsletter.';

        $referer = $request->headers->get('referer', '');

        if (str_contains($referer, 'newsletter/subscribe')) {
            return redirect()->route('newsletter.subscribe.form')->with('success', $message);
        }

        return back()->with('newsletter_success', $message);
    }
}