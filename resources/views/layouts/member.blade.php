<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Member Portal') - Gym Member Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-lg mx-auto bg-white min-h-screen shadow-lg relative">
        <nav class="bg-indigo-600 text-white p-4 flex items-center justify-between sticky top-0 z-50">
            <a href="{{ route('member.dashboard') }}" class="font-bold text-lg">
                <i class="fas fa-dumbbell mr-1"></i> Gym Portal
            </a>
            <form action="{{ route('member.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white hover:text-indigo-200">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </nav>

        <main class="p-4 pb-20">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>

        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-lg bg-white border-t border-gray-200 flex justify-around py-2 z-50">
            <a href="{{ route('member.dashboard') }}" class="flex flex-col items-center text-xs {{ request()->routeIs('member.dashboard') ? 'text-indigo-600' : 'text-gray-500' }}">
                <i class="fas fa-home text-lg mb-1"></i> Home
            </a>
            <a href="{{ route('member.card') }}" class="flex flex-col items-center text-xs {{ request()->routeIs('member.card*') ? 'text-indigo-600' : 'text-gray-500' }}">
                <i class="fas fa-id-card text-lg mb-1"></i> Card
            </a>
            <a href="{{ route('member.payments.index') }}" class="flex flex-col items-center text-xs {{ request()->routeIs('member.payments*') ? 'text-indigo-600' : 'text-gray-500' }}">
                <i class="fas fa-receipt text-lg mb-1"></i> Payment
            </a>
            <a href="{{ route('member.notifications.index') }}" class="flex flex-col items-center text-xs {{ request()->routeIs('member.notifications*') ? 'text-indigo-600' : 'text-gray-500' }}">
                <i class="fas fa-bell text-lg mb-1"></i> Info
            </a>
        </nav>
    </div>
    @stack('scripts')
</body>
</html>
