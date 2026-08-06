@extends('layouts.member')
@section('title', 'Beranda')
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-gray-400 text-sm">Selamat datang,</p>
            <h1 class="text-2xl font-bold text-white">{{ $member->name }} 👋</h1>
        </div>
        <a href="{{ route('member.notifications.index') }}" class="relative text-white">
            <i class="fas fa-bell text-xl"></i>
            @if($unreadCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">{{ $unreadCount }}</span>
            @endif
        </a>
    </div>

    <div class="bg-gradient-to-r from-[#1a1a1a] to-[#111111] border border-yellow-500/30 rounded-2xl p-5 mb-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/10 rounded-full -mr-16 -mt-16"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-gray-400 text-xs">Member ID</p>
                    <p class="text-white font-bold text-xl">{{ $member->member_id }}</p>
                </div>
                <div>
                    @if($member->status === 'active')
                        <span class="bg-green-500/20 text-green-400 text-xs font-bold px-3 py-1 rounded-full">ACTIVE</span>
                    @elseif($member->status === 'expired')
                        <span class="bg-red-500/20 text-red-400 text-xs font-bold px-3 py-1 rounded-full">EXPIRED</span>
                    @else
                        <span class="bg-gray-500/20 text-gray-400 text-xs font-bold px-3 py-1 rounded-full">INACTIVE</span>
                    @endif
                </div>
            </div>
            <div class="border-t border-gray-700 pt-3 mt-3">
                <div class="flex justify-between">
                    <div>
                        <p class="text-gray-400 text-xs">Package</p>
                        <p class="text-white font-medium">{{ $member->membership_package }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400 text-xs">Expires</p>
                        <p class="text-white font-medium">{{ $member->expired_date->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-3 mb-6">
        <a href="{{ route('member.card') }}" class="card-dark rounded-xl p-4 text-center border border-gray-800">
            <i class="fas fa-id-card text-2xl text-gold mb-2"></i>
            <p class="text-gray-300 text-xs">Digital Card</p>
        </a>
        <a href="{{ route('member.payments.index') }}" class="card-dark rounded-xl p-4 text-center border border-gray-800">
            <i class="fas fa-receipt text-2xl text-gold mb-2"></i>
            <p class="text-gray-300 text-xs">Payments</p>
        </a>
        <a href="{{ route('member.notifications.index') }}" class="card-dark rounded-xl p-4 text-center border border-gray-800 relative">
            <i class="fas fa-bell text-2xl text-gold mb-2"></i>
            <p class="text-gray-300 text-xs">Notifications</p>
            @if($unreadCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $unreadCount }}</span>
            @endif
        </a>
    </div>

    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-white font-bold text-lg">Benefit Member</h2>
            <button class="text-gold text-sm font-medium">Lihat Semua</button>
        </div>
        <div class="grid grid-cols-3 gap-3">
            <div class="card-dark rounded-xl p-4 text-center border border-gray-800">
                <i class="fas fa-star text-gold text-2xl mb-2"></i>
                <p class="text-white font-bold text-xl">1.250</p>
                <p class="text-gray-400 text-xs">Total Poin</p>
            </div>
            <div class="card-dark rounded-xl p-4 text-center border border-gray-800">
                <i class="fas fa-gift text-gold text-2xl mb-2"></i>
                <p class="text-white font-bold text-xl">3</p>
                <p class="text-gray-400 text-xs">Reward</p>
            </div>
            <div class="card-dark rounded-xl p-4 text-center border border-gray-800">
                <i class="fas fa-calendar-check text-gold text-2xl mb-2"></i>
                <p class="text-white font-bold text-xl">12</p>
                <p class="text-gray-400 text-xs">Check-in</p>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-white font-bold text-lg mb-3">Recent Payments</h2>
        @forelse($payments as $payment)
            <a href="{{ route('member.payments.show', $payment) }}" class="block card-dark rounded-xl p-4 mb-3 border border-gray-800">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-white font-bold text-sm">{{ $payment->invoice_number }}</p>
                        <p class="text-gray-400 text-xs mt-1">{{ $payment->transaction_date->format('d M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-white font-bold text-sm">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        @if($payment->payment_status === 'paid')
                            <span class="text-xs bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full">Paid</span>
                        @elseif($payment->payment_status === 'pending')
                            <span class="text-xs bg-yellow-500/20 text-yellow-400 px-2 py-0.5 rounded-full">Pending</span>
                        @else
                            <span class="text-xs bg-red-500/20 text-red-400 px-2 py-0.5 rounded-full">Overdue</span>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div class="card-dark rounded-xl p-6 text-center border border-gray-800">
                <i class="fas fa-receipt text-3xl text-gray-600 mb-2"></i>
                <p class="text-gray-400 text-sm">Belum ada pembayaran</p>
            </div>
        @endforelse
    </div>

    <div>
        <h2 class="text-white font-bold text-lg mb-3">Recent Notifications</h2>
        @forelse($notifications as $notification)
            <a href="{{ route('member.notifications.show', $notification) }}" class="block card-dark rounded-xl p-4 mb-3 border border-gray-800">
                <div class="flex items-start">
                    <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3 flex-shrink-0">
                        @if($notification->category === 'payment')
                            <i class="fas fa-money-bill text-gold text-sm"></i>
                        @elseif($notification->category === 'membership')
                            <i class="fas fa-id-card text-gold text-sm"></i>
                        @elseif($notification->category === 'promotion')
                            <i class="fas fa-tag text-gold text-sm"></i>
                        @else
                            <i class="fas fa-info-circle text-gold text-sm"></i>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-medium text-sm truncate">{{ $notification->title }}</p>
                        <p class="text-gray-400 text-xs mt-1">{{ $notification->publish_at->diffForHumans() }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="card-dark rounded-xl p-6 text-center border border-gray-800">
                <i class="fas fa-bell text-3xl text-gray-600 mb-2"></i>
                <p class="text-gray-400 text-sm">Belum ada notifikasi</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
