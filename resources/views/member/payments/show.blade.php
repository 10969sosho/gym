@extends('layouts.member')
@section('title', 'Detail Pembayaran')
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="mb-4">
        <a href="{{ route('member.payments.index') }}" class="text-gold text-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>

    <div class="card-dark rounded-2xl border border-gray-800 overflow-hidden">
        <div class="bg-gradient-to-r from-yellow-500/20 to-transparent p-4 border-b border-gray-800">
            <div class="flex justify-between items-center">
                <h2 class="text-white font-bold text-lg">Invoice</h2>
                @if($payment->payment_status === 'paid')
                    <span class="bg-green-500/20 text-green-400 text-xs font-bold px-3 py-1 rounded-full">PAID</span>
                @elseif($payment->payment_status === 'pending')
                    <span class="bg-yellow-500/20 text-yellow-400 text-xs font-bold px-3 py-1 rounded-full">PENDING</span>
                @else
                    <span class="bg-red-500/20 text-red-400 text-xs font-bold px-3 py-1 rounded-full">OVERDUE</span>
                @endif
            </div>
        </div>

        <div class="p-4 space-y-4">
            <div class="border-b border-gray-800 pb-4">
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-400">Invoice Number</span>
                    <span class="text-white font-medium">{{ $payment->invoice_number }}</span>
                </div>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-400">Transaction Date</span>
                    <span class="text-white font-medium">{{ $payment->transaction_date->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Member Name</span>
                    <span class="text-white font-medium">{{ $payment->member->name }}</span>
                </div>
            </div>

            <div class="border-b border-gray-800 pb-4">
                <h3 class="text-white font-bold mb-3 text-sm">Membership Details</h3>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-400">Package</span>
                    <span class="text-white font-medium">{{ $payment->member->membership_package }}</span>
                </div>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-400">Period</span>
                    <span class="text-white font-medium">{{ $payment->membership_period }}</span>
                </div>
            </div>

            <div class="bg-[#111111] rounded-xl p-4 border border-gray-800">
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 font-medium">Total Amount</span>
                    <span class="text-2xl font-bold text-gold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
            </div>

            @if($payment->invoice_file)
                <div class="pt-2">
                    <a href="{{ asset('storage/' . $payment->invoice_file) }}" target="_blank"
                        class="block w-full text-center bg-gold text-black py-3 rounded-xl font-medium text-sm">
                        <i class="fas fa-file-pdf mr-2"></i>Download Invoice
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
