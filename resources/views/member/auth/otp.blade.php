@extends('layouts.app')
@section('title', 'Verify OTP')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-[#0a0a0a]">
    <div class="max-w-md w-full bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-yellow-500/30">
                <i class="fas fa-shield-alt text-3xl text-black"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Verifikasi OTP</h1>
            <p class="text-gray-400">Masukkan kode 6 digit yang dikirim ke WhatsApp</p>
            <p class="text-gold text-sm mt-2 font-medium">{{ $whatsapp }}</p>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-400 px-4 py-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($otp)
            <div class="bg-yellow-500/20 border-2 border-yellow-500 rounded-xl p-4 mb-4 text-center">
                <p class="text-xs text-gold font-medium mb-1">KODE OTP (Development Mode)</p>
                <p class="text-3xl font-bold text-gold tracking-widest">{{ $otp }}</p>
                <p class="text-xs text-gray-400 mt-2">Gunakan kode ini untuk login</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded-xl mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('member.otp.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="whatsapp" value="{{ $whatsapp }}">
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">Kode OTP</label>
                <input type="text" name="otp" maxlength="6" pattern="[0-9]{6}" required autofocus
                    class="w-full text-center text-2xl tracking-widest px-4 py-4 bg-[#111111] border border-gray-800 rounded-xl text-gold focus:outline-none focus:border-yellow-500"
                    placeholder="000000">
                <p class="text-xs text-gray-500 mt-2">Kode berlaku selama 5 menit</p>
            </div>
            <button type="submit" class="w-full bg-gold text-black py-3 rounded-xl font-bold text-lg hover:bg-yellow-400 transition">
                <i class="fas fa-check-circle mr-2"></i> Verifikasi
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('member.login') }}" class="text-gold hover:text-yellow-400 text-sm font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Kirim ulang kode
            </a>
        </div>
    </div>
</div>
@endsection
