@extends('layouts.member')
@section('title', 'Payment History')
@section('content')
<div class="mb-4">
    <h1 class="text-xl font-bold text-gray-800">Payment History</h1>
    <p class="text-gray-500 text-sm">Riwayat transaksi membership</p>
</div>

<form action="{{ route('member.payments.index') }}" method="GET" class="mb-4">
    <div class="flex">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari invoice..."
            class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>

@forelse($payments as $payment)
    <a href="{{ route('member.payments.show', $payment) }}" class="block bg-white rounded-lg p-4 mb-3 shadow-sm hover:shadow-md transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="font-bold text-gray-800">{{ $payment->invoice_number }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-calendar mr-1"></i>{{ $payment->transaction_date->format('d M Y') }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-clock mr-1"></i>{{ $payment->membership_period }}
                </p>
            </div>
            <div class="text-right">
                <p class="font-bold text-gray-800">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                @if($payment->payment_status === 'paid')
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full mt-1 inline-block">Paid</span>
                @elseif($payment->payment_status === 'pending')
                    <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full mt-1 inline-block">Pending</span>
                @else
                    <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full mt-1 inline-block">Overdue</span>
                @endif
            </div>
        </div>
    </a>
@empty
    <div class="bg-white rounded-lg p-8 text-center">
        <i class="fas fa-receipt text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-500">Belum ada pembayaran</p>
    </div>
@endforelse

<div class="mt-4">
    {{ $payments->links() }}
</div>
@endsection
