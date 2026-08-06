@extends('layouts.member')
@section('title', 'Pembayaran')
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="flex items-center justify-between mb-2">
        <h1 class="text-2xl font-bold text-white">Riwayat Pembayaran</h1>
        <a href="{{ route('member.notifications.index') }}" class="relative text-white">
            <i class="fas fa-bell text-xl"></i>
        </a>
    </div>
    <p class="text-gray-400 text-sm mb-6">Riwayat transaksi membership</p>

    <form action="{{ route('member.payments.index') }}" method="GET" class="mb-4">
        <div class="flex">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari invoice..."
                class="flex-1 px-4 py-3 bg-[#1a1a1a] border border-gray-800 rounded-l-xl text-white text-sm focus:outline-none focus:border-yellow-500">
            <button type="submit" class="bg-gold text-black px-4 py-3 rounded-r-xl font-medium">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    @forelse($payments as $payment)
        <a href="{{ route('member.payments.show', $payment) }}" class="block card-dark rounded-xl p-4 mb-3 border border-gray-800">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-white font-bold text-sm">{{ $payment->invoice_number }}</p>
                    <p class="text-gray-400 text-xs mt-2">
                        <i class="fas fa-calendar mr-1"></i>{{ $payment->transaction_date->format('d M Y') }}
                    </p>
                    <p class="text-gray-400 text-xs mt-1">
                        <i class="fas fa-clock mr-1"></i>{{ $payment->membership_period }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-white font-bold text-sm">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                    @if($payment->payment_status === 'paid')
                        <span class="text-xs bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full mt-2 inline-block">Paid</span>
                    @elseif($payment->payment_status === 'pending')
                        <span class="text-xs bg-yellow-500/20 text-yellow-400 px-2 py-0.5 rounded-full mt-2 inline-block">Pending</span>
                    @else
                        <span class="text-xs bg-red-500/20 text-red-400 px-2 py-0.5 rounded-full mt-2 inline-block">Overdue</span>
                    @endif
                </div>
            </div>
        </a>
    @empty
        <div class="card-dark rounded-xl p-8 text-center border border-gray-800">
            <i class="fas fa-receipt text-4xl text-gray-600 mb-3"></i>
            <p class="text-gray-400">Belum ada pembayaran</p>
        </div>
    @endforelse

    <div class="mt-4">
        {{ $payments->links() }}
    </div>
</div>
@endsection
