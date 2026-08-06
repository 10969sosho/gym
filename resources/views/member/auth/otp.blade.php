@extends('layouts.app')
@section('title', 'Verify OTP')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-b from-indigo-600 to-indigo-800">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <i class="fas fa-shield-alt text-4xl text-indigo-600 mb-2"></i>
            <h1 class="text-2xl font-bold text-gray-800">Verifikasi OTP</h1>
            <p class="text-gray-500">Masukkan kode 6 digit yang dikirim ke WhatsApp</p>
            <p class="text-sm text-indigo-600 mt-2">{{ $whatsapp }}</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($otp)
            <div class="bg-blue-50 border-2 border-blue-300 rounded-lg p-4 mb-4 text-center">
                <p class="text-xs text-blue-600 font-medium mb-1">KODE OTP (Development Mode)</p>
                <p class="text-3xl font-bold text-blue-800 tracking-widest">{{ $otp }}</p>
                <p class="text-xs text-blue-500 mt-2">Gunakan kode ini untuk login</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('member.otp.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="whatsapp" value="{{ $whatsapp }}">
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode OTP</label>
                <input type="text" name="otp" maxlength="6" pattern="[0-9]{6}" required autofocus
                    class="w-full text-center text-2xl tracking-widest px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="000000">
                <p class="text-xs text-gray-500 mt-1">Kode berlaku selama 5 menit</p>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-medium">
                <i class="fas fa-check-circle mr-2"></i> Verifikasi
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('member.login') }}" class="text-indigo-600 hover:underline text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kirim ulang kode
            </a>
        </div>
    </div>
</div>
@endsection
