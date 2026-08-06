@extends('layouts.app')
@section('title', 'Admin Login')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-[#0a0a0a] py-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-yellow-500/40">
                <i class="fas fa-dumbbell text-4xl text-black"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Panel</h1>
            <p class="text-gray-400 text-base">Gym Member Portal Management</p>
        </div>

        <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-6 shadow-xl">
            @if($errors->any())
                <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-base font-semibold text-white mb-3">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-4 bg-[#111111] border border-gray-700 rounded-xl text-white text-base font-medium placeholder-gray-500 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/20"
                        placeholder="admin@gym.com">
                </div>
                <div class="mb-5">
                    <label class="block text-base font-semibold text-white mb-3">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-4 bg-[#111111] border border-gray-700 rounded-xl text-white text-base font-medium placeholder-gray-500 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/20"
                        placeholder="••••••••">
                </div>
                <div class="mb-6 flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 mr-3 accent-yellow-500 rounded">
                    <label for="remember" class="text-sm text-gray-400">Ingat saya</label>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-black py-4 rounded-xl font-bold text-base shadow-lg shadow-yellow-500/30 hover:shadow-yellow-500/50 transition-all">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('member.login') }}" class="inline-flex items-center text-gray-400 hover:text-white text-sm font-medium transition">
                <i class="fas fa-user mr-2"></i> Login sebagai Member
            </a>
        </div>
    </div>
</div>
@endsection
