@extends('layouts.app')
@section('title', 'Member Login')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-[#0a0a0a] py-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-yellow-500/40">
                <i class="fas fa-dumbbell text-4xl text-black"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Member Portal</h1>
            <p class="text-gray-400 text-base">Masuk dengan nomor WhatsApp Anda</p>
        </div>

        <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-6 shadow-xl">
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('member.login.submit') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-base font-semibold text-white mb-3">Nomor WhatsApp</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 bg-[#111111] border border-r-0 border-gray-700 rounded-l-xl">
                            <i class="fab fa-whatsapp text-2xl text-green-500"></i>
                        </span>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="628xxxxxxxxxx" required
                            class="flex-1 px-4 py-4 bg-[#111111] border border-gray-700 rounded-r-xl text-white text-base font-medium placeholder-gray-500 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/20">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 ml-1">Masukkan nomor WhatsApp yang terdaftar</p>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-black py-4 rounded-xl font-bold text-base shadow-lg shadow-yellow-500/30 hover:shadow-yellow-500/50 transition-all">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Kode OTP
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center text-gray-400 hover:text-white text-sm font-medium transition">
                <i class="fas fa-lock mr-2"></i> Login sebagai Admin
            </a>
        </div>
    </div>
</div>
@endsection
