<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Member Portal') - Gym Member Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background-color: #0a0a0a; }
        .card-dark { background-color: #1a1a1a; }
        .card-darker { background-color: #111111; }
        .text-gold { color: #f5c518; }
        .bg-gold { background-color: #f5c518; }
        .border-gold { border-color: #f5c518; }
        .nav-item.active { color: #f5c518; }
        .nav-item.active i { color: #f5c518; }
    </style>
</head>
<body class="bg-[#0a0a0a] min-h-screen text-white">
    <div class="max-w-lg mx-auto min-h-screen relative pb-20">
        @yield('content')

        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-lg bg-[#111111] border-t border-gray-800 flex justify-around py-2 z-50">
            <a href="{{ route('member.dashboard') }}" class="nav-item flex flex-col items-center text-xs {{ request()->routeIs('member.dashboard') ? 'active' : 'text-gray-500' }}">
                <i class="fas fa-home text-lg mb-1"></i> Beranda
            </a>
            <a href="{{ route('member.payments.index') }}" class="nav-item flex flex-col items-center text-xs {{ request()->routeIs('member.payments*') ? 'active' : 'text-gray-500' }}">
                <i class="fas fa-calendar-alt text-lg mb-1"></i> Jadwal
            </a>
            <a href="{{ route('member.card') }}" class="nav-item flex flex-col items-center text-xs {{ request()->routeIs('member.card*') ? 'active' : 'text-gray-500' }}">
                <i class="fas fa-id-card text-lg mb-1"></i> Kartu
            </a>
            <a href="{{ route('member.notifications.index') }}" class="nav-item flex flex-col items-center text-xs {{ request()->routeIs('member.notifications*') ? 'active' : 'text-gray-500' }}">
                <i class="fas fa-chart-line text-lg mb-1"></i> Aktivitas
            </a>
            <a href="{{ route('member.account') }}" class="nav-item flex flex-col items-center text-xs {{ request()->routeIs('member.account') ? 'active' : 'text-gray-500' }}">
                <i class="fas fa-user text-lg mb-1"></i> Akun
            </a>
        </nav>
    </div>
    @stack('scripts')
</body>
</html>
