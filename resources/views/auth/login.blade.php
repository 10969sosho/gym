@extends('layouts.app')
@section('title', 'Admin Login')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-[#0a0a0a]">
    <div class="max-w-md w-full bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-yellow-500/30">
                <i class="fas fa-dumbbell text-3xl text-black"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            <p class="text-gray-400">Gym Member Portal</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded-xl mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 bg-[#111111] border border-gray-800 rounded-xl text-white focus:outline-none focus:border-yellow-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 bg-[#111111] border border-gray-800 rounded-xl text-white focus:outline-none focus:border-yellow-500">
            </div>
            <div class="mb-6 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2 accent-yellow-500">
                <label for="remember" class="text-sm text-gray-400">Remember me</label>
            </div>
            <button type="submit" class="w-full bg-gold text-black py-3 rounded-xl font-bold text-lg hover:bg-yellow-400 transition">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('member.login') }}" class="text-gold hover:text-yellow-400 font-medium text-sm">
                Member Login <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection
