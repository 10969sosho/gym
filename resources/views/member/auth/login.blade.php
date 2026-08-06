@extends('layouts.app')
@section('title', 'Member Login')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-[#0a0a0a]">
    <div class="max-w-md w-full bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-yellow-500/30">
                <i class="fas fa-dumbbell text-3xl text-black"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Member Portal</h1>
            <p class="text-gray-400">Masuk dengan nomor WhatsApp</p>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-400 px-4 py-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded-xl mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('member.login.submit') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">Nomor WhatsApp</label>
                <div class="flex">
                    <span class="inline-flex items-center px-4 bg-[#111111] border border-r-0 border-gray-800 rounded-l-xl text-gold">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </span>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="628xxxxxxxxxx" required
                        class="flex-1 px-4 py-3 bg-[#111111] border border-gray-800 rounded-r-xl text-white focus:outline-none focus:border-yellow-500">
                </div>
                <p class="text-xs text-gray-500 mt-2">Masukkan nomor WhatsApp terdaftar</p>
            </div>
            <button type="submit" class="w-full bg-gold text-black py-3 rounded-xl font-bold text-lg hover:bg-yellow-400 transition">
                <i class="fas fa-paper-plane mr-2"></i> Kirim Kode OTP
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-300 text-sm">
                <i class="fas fa-lock mr-1"></i> Admin Login
            </a>
        </div>
    </div>
</div>
@endsection
