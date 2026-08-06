@extends('layouts.member')
@section('title', 'Akun Saya')
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Akun Saya</h1>
        <a href="{{ route('member.notifications.index') }}" class="relative text-white">
            <i class="fas fa-bell text-xl"></i>
        </a>
    </div>

    <div class="card-dark rounded-2xl border border-gray-800 p-6 mb-6">
        <div class="flex items-center mb-6">
            <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mr-4 shadow-lg shadow-yellow-500/30">
                @if($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full rounded-full object-cover">
                @else
                    <i class="fas fa-user text-3xl text-black"></i>
                @endif
            </div>
            <div>
                <h2 class="text-xl font-bold text-white uppercase">{{ $member->name }}</h2>
                <p class="text-gray-400 text-sm">{{ $member->member_id }}</p>
                <span class="inline-block mt-1 text-xs bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full font-medium">
                    {{ strtoupper($member->status) }}
                </span>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center p-3 bg-[#111111] rounded-xl border border-gray-800">
                <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                    <i class="fab fa-whatsapp text-gold"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">WhatsApp</p>
                    <p class="text-white font-medium">{{ $member->whatsapp }}</p>
                </div>
            </div>

            <div class="flex items-center p-3 bg-[#111111] rounded-xl border border-gray-800">
                <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                    <i class="fas fa-dumbbell text-gold"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Paket Membership</p>
                    <p class="text-white font-medium">{{ $member->membership_package }}</p>
                </div>
            </div>

            <div class="flex items-center p-3 bg-[#111111] rounded-xl border border-gray-800">
                <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                    <i class="fas fa-calendar-alt text-gold"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-xs">Berlaku Sampai</p>
                    <p class="text-white font-medium">{{ $member->expired_date->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-3 mb-6">
        <div class="card-dark rounded-xl p-4 border border-gray-800 text-center">
            <i class="fas fa-receipt text-gold text-2xl mb-2"></i>
            <p class="text-white font-bold text-xl">{{ $totalTransactions }}</p>
            <p class="text-gray-400 text-xs">Total Transaksi</p>
        </div>
        <div class="card-dark rounded-xl p-4 border border-gray-800 text-center">
            <i class="fas fa-wallet text-gold text-2xl mb-2"></i>
            <p class="text-white font-bold text-xl">Rp {{ number_format($totalPayments / 1000, 0) }}K</p>
            <p class="text-gray-400 text-xs">Total Pembayaran</p>
        </div>
    </div>

    <div class="card-dark rounded-2xl border border-gray-800 overflow-hidden mb-6">
        <a href="{{ route('member.card') }}" class="flex items-center p-4 border-b border-gray-800 hover:bg-[#222] transition">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-id-card text-gold"></i>
            </div>
            <div class="flex-1">
                <p class="text-white font-medium text-sm">Kartu Member Digital</p>
                <p class="text-gray-400 text-xs">Lihat kartu member Anda</p>
            </div>
            <i class="fas fa-chevron-right text-gray-600"></i>
        </a>
        <a href="{{ route('member.payments.index') }}" class="flex items-center p-4 border-b border-gray-800 hover:bg-[#222] transition">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-history text-gold"></i>
            </div>
            <div class="flex-1">
                <p class="text-white font-medium text-sm">Riwayat Pembayaran</p>
                <p class="text-gray-400 text-xs">Lihat semua transaksi</p>
            </div>
            <i class="fas fa-chevron-right text-gray-600"></i>
        </a>
        <a href="{{ route('member.notifications.index') }}" class="flex items-center p-4 hover:bg-[#222] transition">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-bell text-gold"></i>
            </div>
            <div class="flex-1">
                <p class="text-white font-medium text-sm">Notifikasi</p>
                <p class="text-gray-400 text-xs">Pengumuman & informasi</p>
            </div>
            <i class="fas fa-chevron-right text-gray-600"></i>
        </a>
    </div>

    <form action="{{ route('member.logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full bg-red-500/20 text-red-400 py-4 rounded-xl font-bold text-base border border-red-500/30 hover:bg-red-500/30 transition-all">
            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
        </button>
    </form>

    <p class="text-center text-gray-600 text-xs mt-6">Gym Member Portal v1.0</p>
</div>
@endsection
