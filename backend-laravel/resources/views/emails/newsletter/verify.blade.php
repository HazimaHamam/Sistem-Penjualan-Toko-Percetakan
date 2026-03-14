<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Newsletter — {{ config('app.name', 'Mirza Stamp') }}</title>
    <!--[if mso]>
    <noscript>
        <xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml>
    </noscript>
    <![endif]-->
</head>
<body style="margin:0;padding:0;background-color:#12111a;font-family:'DM Sans','Segoe UI',Arial,sans-serif;-webkit-font-smoothing:antialiased">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#12111a;padding:40px 16px">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:560px">

                    {{-- ── HEADER / LOGO ── --}}
                    <tr>
                        <td align="center" style="padding-bottom:32px">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="background-color:#1e1d2e;border-radius:12px;padding:10px 20px">
                                        <span style="font-family:Georgia,serif;font-size:18px;font-weight:700;color:#ffffff;letter-spacing:-0.01em">
                                            {{ config('app.name', 'Mirza Stamp') }}
                                        </span>
                                        <span style="font-size:11px;color:rgba(255,255,255,.35);margin-left:8px;text-transform:uppercase;letter-spacing:0.08em">
                                            Percetakan Online
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ── CARD ── --}}
                    <tr>
                        <td style="background-color:#1e1d2e;border-radius:20px;border:1px solid rgba(255,255,255,.08);overflow:hidden">

                            {{-- Gold top bar --}}
                            <div style="height:3px;background:linear-gradient(90deg,#c9820a,#e8a020)"></div>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding:40px 40px 32px;text-align:center">

                                        {{-- Icon --}}
                                        <div style="width:64px;height:64px;background:rgba(201,130,10,.15);border:1px solid rgba(201,130,10,.25);border-radius:16px;margin:0 auto 24px;display:flex;align-items:center;justify-content:center">
                                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='28' viewBox='0 0 24 24' fill='none' stroke='%23e8a020' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z'/%3E%3Cpolyline points='22,6 12,13 2,6'/%3E%3C/svg%3E"
                                                 width="28" height="28" alt="" style="display:block;margin:18px auto 0">
                                        </div>

                                        {{-- Eyebrow --}}
                                        <p style="font-size:11px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:#c9820a;margin:0 0 12px">
                                            Newsletter
                                        </p>

                                        {{-- Heading --}}
                                        <h1 style="font-family:Georgia,serif;font-size:28px;font-weight:700;color:#ffffff;margin:0 0 16px;line-height:1.25;letter-spacing:-0.01em">
                                            Konfirmasi Email Anda
                                        </h1>

                                        {{-- Body --}}
                                        <p style="font-size:15px;color:rgba(255,255,255,.5);line-height:1.7;margin:0 0 8px">
                                            Terima kasih telah mendaftar newsletter <strong style="color:rgba(255,255,255,.7)">{{ config('app.name', 'Mirza Stamp') }}</strong>.
                                        </p>
                                        <p style="font-size:15px;color:rgba(255,255,255,.5);line-height:1.7;margin:0 0 32px">
                                            Klik tombol di bawah untuk mengaktifkan langganan Anda dan mulai menerima promo eksklusif.
                                        </p>

                                        {{-- CTA Button --}}
                                        <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto">
                                            <tr>
                                                <td style="background-color:#c9820a;border-radius:12px;box-shadow:0 6px 24px rgba(201,130,10,.4)">
                                                    <a href="{{ route('newsletter.verify', $newsletter->verification_token) }}"
                                                       style="display:inline-block;padding:14px 32px;font-size:15px;font-weight:600;color:#ffffff;text-decoration:none;letter-spacing:0.01em">
                                                        ✓ &nbsp;Konfirmasi Email Saya
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Expiry note --}}
                                        <p style="font-size:13px;color:rgba(255,255,255,.25);margin:20px 0 0">
                                            Link ini berlaku selama 24 jam.
                                        </p>

                                    </td>
                                </tr>

                                {{-- Divider --}}
                                <tr>
                                    <td style="padding:0 40px">
                                        <div style="height:1px;background:rgba(255,255,255,.07)"></div>
                                    </td>
                                </tr>

                                {{-- Fallback URL --}}
                                <tr>
                                    <td style="padding:24px 40px">
                                        <p style="font-size:12px;color:rgba(255,255,255,.25);margin:0 0 8px">
                                            Jika tombol tidak berfungsi, salin link berikut ke browser:
                                        </p>
                                        <p style="font-size:11px;color:rgba(201,130,10,.5);word-break:break-all;margin:0">
                                            {{ route('newsletter.verify', $newsletter->verification_token) }}
                                        </p>
                                    </td>
                                </tr>

                                {{-- Footer --}}
                                <tr>
                                    <td style="padding:16px 40px 32px;text-align:center">
                                        <p style="font-size:12px;color:rgba(255,255,255,.2);margin:0 0 4px">
                                            Jika Anda tidak merasa mendaftar, abaikan email ini.
                                        </p>
                                        <p style="font-size:12px;color:rgba(255,255,255,.15);margin:0">
                                            &copy; {{ date('Y') }} {{ config('app.name', 'Mirza Stamp') }}. Semua hak dilindungi.
                                        </p>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>