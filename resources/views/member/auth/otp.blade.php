@extends('layouts.app')
@section('title', 'Verify OTP')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-[#0a0a0a] py-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-yellow-500/40">
                <i class="fas fa-shield-alt text-4xl text-black"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Verifikasi OTP</h1>
            <p class="text-gray-400 text-base">Masukkan kode 6 digit ke WhatsApp</p>
            <p class="text-yellow-400 text-sm mt-3 font-semibold bg-yellow-500/10 px-4 py-2 rounded-lg inline-block">{{ $whatsapp }}</p>
        </div>

        <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-6 shadow-xl">
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if($otp)
                <div class="bg-yellow-500/10 border-2 border-yellow-500 rounded-xl p-4 mb-4 text-center">
                    <p class="text-xs text-yellow-400 font-semibold mb-2 uppercase tracking-wide">Kode OTP Anda</p>
                    <p class="text-4xl font-bold text-yellow-400 tracking-widest">{{ $otp }}</p>
                    <p class="text-xs text-gray-500 mt-2">Gunakan kode ini untuk login</p>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('member.otp.verify') }}" method="POST">
                @csrf
                <input type="hidden" name="whatsapp" value="{{ $whatsapp }}">
                <div class="mb-6">
                    <label class="block text-base font-semibold text-white mb-3">Kode OTP</label>
                    <input type="text" name="otp" maxlength="6" pattern="[0-9]{6}" required autofocus
                        class="w-full text-center text-3xl tracking-[0.3em] px-4 py-5 bg-[#111111] border border-gray-700 rounded-xl text-yellow-400 font-bold placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/20"
                        placeholder="000000">
                    <p class="text-xs text-gray-500 mt-2 ml-1">Kode berlaku selama 5 menit</p>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-black py-4 rounded-xl font-bold text-base shadow-lg shadow-yellow-500/30 hover:shadow-yellow-500/50 transition-all">
                    <i class="fas fa-check-circle mr-2"></i> Verifikasi
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('member.login') }}" class="inline-flex items-center text-gray-400 hover:text-white text-sm font-medium transition">
                <i class="fas fa-arrow-left mr-2"></i> Kirim ulang kode
            </a>
        </div>
    </div>
</div>
@endsection
