@extends('layouts.app')
@section('title', 'Member Login')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-b from-indigo-600 to-indigo-800">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <i class="fas fa-dumbbell text-4xl text-indigo-600 mb-2"></i>
            <h1 class="text-2xl font-bold text-gray-800">Member Portal</h1>
            <p class="text-gray-500">Masuk dengan nomor WhatsApp</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('member.login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-500">
                        <i class="fab fa-whatsapp text-green-500"></i>
                    </span>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="628xxxxxxxxxx" required
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <p class="text-xs text-gray-500 mt-1">Masukkan nomor WhatsApp terdaftar</p>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-medium">
                <i class="fas fa-paper-plane mr-2"></i> Kirim Kode OTP
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-gray-500 hover:underline text-sm">
                <i class="fas fa-lock mr-1"></i> Admin Login
            </a>
        </div>
    </div>
</div>
@endsection
