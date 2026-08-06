@extends('layouts.member')
@section('title', 'Kartu Member')
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="flex items-center justify-between mb-2">
        <h1 class="text-2xl font-bold text-white">Kartu Member</h1>
        <a href="{{ route('member.notifications.index') }}" class="relative text-white">
            <i class="fas fa-bell text-xl"></i>
            @if($unreadCount ?? 0 > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">{{ $unreadCount }}</span>
            @endif
        </a>
    </div>
    <p class="text-gray-400 text-sm mb-6">Tunjukkan kartu ini saat check-in di gym</p>

    <div class="bg-gradient-to-br from-[#1a1a1a] to-[#0a0a0a] border border-yellow-500/30 rounded-2xl p-5 mb-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-20 h-full bg-gradient-to-r from-yellow-500/20 to-transparent"></div>
        <div class="absolute top-0 right-0 w-20 h-full bg-gradient-to-l from-yellow-500/20 to-transparent"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xl font-bold tracking-wider">
                    <span class="text-white">MEMBER</span><span class="text-gold">CARD</span>
                </span>
            </div>

            <div class="flex items-center justify-center mb-4">
                <div class="w-24 h-24 bg-yellow-500 rounded-full flex items-center justify-center border-4 border-yellow-400 shadow-lg shadow-yellow-500/30">
                    <i class="fas fa-dumbbell text-4xl text-black"></i>
                </div>
            </div>
            <div class="text-center mb-4">
                <p class="text-gold font-bold text-sm">XTREME FITNESS CENTER</p>
            </div>

            <div class="flex items-end justify-between">
                <div>
                    <p class="text-white font-bold text-xl tracking-wider">{{ $member->member_id }}</p>
                </div>
                <a href="{{ route('member.card.qr') }}" class="bg-white p-2 rounded-lg">
                    <i class="fas fa-qrcode text-3xl text-black"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card-dark rounded-2xl p-5 mb-6">
        <div class="flex items-center mb-5 pb-4 border-b border-gray-800">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-user text-gold"></i>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Nama Member</p>
                <p class="text-white font-bold text-lg uppercase">{{ $member->name }}</p>
            </div>
        </div>

        <div class="flex items-center mb-5 pb-4 border-b border-gray-800">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-credit-card text-gold"></i>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Nomor Kartu</p>
                <p class="text-white font-bold text-lg">{{ $member->member_id }}</p>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-calendar-alt text-gold"></i>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Berlaku Sampai</p>
                <p class="text-white font-bold text-lg">{{ $member->expired_date->format('d F Y') }}</p>
            </div>
        </div>
    </div>

    <div class="card-dark rounded-2xl p-5 mb-6">
        <div class="flex items-start">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3 flex-shrink-0">
                <i class="fas fa-shield-check text-gold"></i>
            </div>
            <div class="flex-1">
                <p class="text-white font-bold mb-1">Tunjukkan kartu ini</p>
                <p class="text-gray-400 text-sm">saat check-in di gym untuk mendapatkan akses dan benefit member.</p>
            </div>
            <i class="fas fa-chevron-right text-gray-600"></i>
        </div>
    </div>

    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-white font-bold text-lg">Benefit Member</h2>
            <button class="text-gold text-sm font-medium">Lihat Semua</button>
        </div>

        <div class="grid grid-cols-3 gap-3">
            <div class="card-dark rounded-xl p-4 text-center">
                <i class="fas fa-star text-gold text-2xl mb-2"></i>
                <p class="text-white font-bold text-xl">1.250</p>
                <p class="text-gray-400 text-xs">Total Poin</p>
            </div>
            <div class="card-dark rounded-xl p-4 text-center">
                <i class="fas fa-gift text-gold text-2xl mb-2"></i>
                <p class="text-white font-bold text-xl">3</p>
                <p class="text-gray-400 text-xs">Reward Tersedia</p>
            </div>
            <div class="card-dark rounded-xl p-4 text-center">
                <i class="fas fa-calendar-check text-gold text-2xl mb-2"></i>
                <p class="text-white font-bold text-xl">12</p>
                <p class="text-gray-400 text-xs">Check-in Bulan Ini</p>
            </div>
        </div>
    </div>

    <a href="{{ route('member.card.qr') }}" class="block w-full bg-gold text-black text-center py-4 rounded-xl font-bold text-lg hover:bg-yellow-400 transition">
        <i class="fas fa-qrcode mr-2"></i> Scan QR Code
    </a>
</div>
@endsection
