<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberAuthController extends Controller
{
    public function showLogin()
    {
        return view('member.auth.login');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'whatsapp' => 'required|string',
        ]);

        $whatsapp = preg_replace('/[^0-9]/', '', $request->whatsapp);
        $member = Member::where('whatsapp', $whatsapp)->first();

        if (!$member) {
            return back()->withErrors(['whatsapp' => 'Nomor WhatsApp tidak ditemukan.']);
        }

        $otp = rand(100000, 999999);
        $member->update([
            'login_token' => Hash::make($otp),
            'token_expires_at' => now()->addMinutes(5),
        ]);

        session(['dev_otp' => $otp]);

        return redirect()->route('member.otp', ['whatsapp' => $whatsapp])->with('success', 'Kode OTP telah dikirim ke WhatsApp Anda.');
    }

    public function showOtp(Request $request)
    {
        $otp = session('dev_otp');
        return view('member.auth.otp', [
            'whatsapp' => $request->whatsapp,
            'otp' => $otp,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'whatsapp' => 'required|string',
            'otp' => 'required|string|size:6',
        ]);

        $whatsapp = preg_replace('/[^0-9]/', '', $request->whatsapp);
        $member = Member::where('whatsapp', $whatsapp)->first();

        if (!$member || !$member->login_token || !$member->token_expires_at || $member->token_expires_at->isPast()) {
            return back()->withErrors(['otp' => 'Token tidak valid atau sudah kedaluwarsa.']);
        }

        if (!Hash::check($request->otp, $member->login_token)) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        $member->update([
            'login_token' => null,
            'token_expires_at' => null,
        ]);

        Auth::guard('member')->login($member);

        return redirect()->route('member.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('member.login');
    }
}
