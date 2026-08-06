@extends('layouts.app')
@section('title', 'Admin Login')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <i class="fas fa-dumbbell text-4xl text-indigo-600 mb-2"></i>
            <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
            <p class="text-gray-500">Gym Member Portal</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('member.login') }}" class="text-indigo-600 hover:underline text-sm">
                Member Login <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection
