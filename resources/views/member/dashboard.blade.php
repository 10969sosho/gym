@extends('layouts.member')
@section('title', 'Dashboard')
@section('content')
<div class="mb-6">
    <h1 class="text-xl font-bold text-gray-800">Halo, {{ $member->name }} 👋</h1>
    <p class="text-gray-500 text-sm">Selamat datang di Member Portal</p>
</div>

<div class="bg-gradient-to-r from-indigo-500 to-indigo-700 rounded-xl p-5 text-white mb-6">
    <div class="flex items-center justify-between mb-3">
        <div>
            <p class="text-indigo-200 text-xs">Member ID</p>
            <p class="font-bold text-lg">{{ $member->member_id }}</p>
        </div>
        <div class="text-right">
            @if($member->status === 'active')
                <span class="bg-green-400 text-green-900 text-xs font-bold px-2 py-1 rounded-full">ACTIVE</span>
            @elseif($member->status === 'expired')
                <span class="bg-red-400 text-red-900 text-xs font-bold px-2 py-1 rounded-full">EXPIRED</span>
            @else
                <span class="bg-gray-400 text-gray-900 text-xs font-bold px-2 py-1 rounded-full">INACTIVE</span>
            @endif
        </div>
    </div>
    <div class="border-t border-indigo-400 pt-3 mt-3">
        <div class="flex justify-between text-sm">
            <div>
                <p class="text-indigo-200 text-xs">Package</p>
                <p class="font-medium">{{ $member->membership_package }}</p>
            </div>
            <div class="text-right">
                <p class="text-indigo-200 text-xs">Expires</p>
                <p class="font-medium">{{ $member->expired_date->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-3 gap-3 mb-6">
    <a href="{{ route('member.card') }}" class="bg-white rounded-xl p-4 text-center shadow-sm hover:shadow-md transition">
        <i class="fas fa-id-card text-2xl text-indigo-600 mb-2"></i>
        <p class="text-xs text-gray-600">Digital Card</p>
    </a>
    <a href="{{ route('member.payments.index') }}" class="bg-white rounded-xl p-4 text-center shadow-sm hover:shadow-md transition">
        <i class="fas fa-receipt text-2xl text-green-600 mb-2"></i>
        <p class="text-xs text-gray-600">Payments</p>
    </a>
    <a href="{{ route('member.notifications.index') }}" class="bg-white rounded-xl p-4 text-center shadow-sm hover:shadow-md transition relative">
        <i class="fas fa-bell text-2xl text-orange-500 mb-2"></i>
        <p class="text-xs text-gray-600">Notifications</p>
        @if($unreadCount > 0)
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $unreadCount }}</span>
        @endif
    </a>
</div>

<div class="mb-6">
    <h2 class="font-bold text-gray-800 mb-3"><i class="fas fa-receipt mr-2 text-gray-400"></i>Recent Payments</h2>
    @forelse($payments as $payment)
        <a href="{{ route('member.payments.show', $payment) }}" class="block bg-white rounded-lg p-3 mb-2 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-medium text-sm text-gray-800">{{ $payment->invoice_number }}</p>
                    <p class="text-xs text-gray-500">{{ $payment->transaction_date->format('d M Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-sm">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                    @if($payment->payment_status === 'paid')
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Paid</span>
                    @elseif($payment->payment_status === 'pending')
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">Pending</span>
                    @else
                        <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Overdue</span>
                    @endif
                </div>
            </div>
        </a>
    @empty
        <div class="bg-white rounded-lg p-4 text-center text-gray-500 text-sm">
            Belum ada pembayaran
        </div>
    @endforelse
</div>

<div>
    <h2 class="font-bold text-gray-800 mb-3"><i class="fas fa-bell mr-2 text-gray-400"></i>Recent Notifications</h2>
    @forelse($notifications as $notification)
        <a href="{{ route('member.notifications.show', $notification) }}" class="block bg-white rounded-lg p-3 mb-2 shadow-sm hover:shadow-md transition">
            <div class="flex items-start">
                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3 flex-shrink-0">
                    @if($notification->category === 'payment')
                        <i class="fas fa-money-bill text-indigo-600 text-sm"></i>
                    @elseif($notification->category === 'membership')
                        <i class="fas fa-id-card text-indigo-600 text-sm"></i>
                    @elseif($notification->category === 'promotion')
                        <i class="fas fa-tag text-indigo-600 text-sm"></i>
                    @else
                        <i class="fas fa-info-circle text-indigo-600 text-sm"></i>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-sm text-gray-800 truncate">{{ $notification->title }}</p>
                    <p class="text-xs text-gray-500">{{ $notification->publish_at->diffForHumans() }}</p>
                </div>
            </div>
        </a>
    @empty
        <div class="bg-white rounded-lg p-4 text-center text-gray-500 text-sm">
            Belum ada notifikasi
        </div>
    @endforelse
</div>
@endsection
