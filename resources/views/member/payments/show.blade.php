@extends('layouts.member')
@section('title', 'Payment Detail')
@section('content')
<div class="mb-4">
    <a href="{{ route('member.payments.index') }}" class="text-indigo-600 text-sm"><i class="fas fa-arrow-left mr-1"></i> Back</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="bg-indigo-600 text-white p-4">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-lg">Invoice</h2>
            @if($payment->payment_status === 'paid')
                <span class="bg-green-400 text-green-900 text-xs font-bold px-3 py-1 rounded-full">PAID</span>
            @elseif($payment->payment_status === 'pending')
                <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full">PENDING</span>
            @else
                <span class="bg-red-400 text-red-900 text-xs font-bold px-3 py-1 rounded-full">OVERDUE</span>
            @endif
        </div>
    </div>

    <div class="p-4 space-y-4">
        <div class="border-b pb-4">
            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-500">Invoice Number</span>
                <span class="font-medium">{{ $payment->invoice_number }}</span>
            </div>
            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-500">Transaction Date</span>
                <span class="font-medium">{{ $payment->transaction_date->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Member Name</span>
                <span class="font-medium">{{ $payment->member->name }}</span>
            </div>
        </div>

        <div class="border-b pb-4">
            <h3 class="font-bold text-gray-800 mb-3 text-sm">Membership Details</h3>
            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-500">Package</span>
                <span class="font-medium">{{ $payment->member->membership_package }}</span>
            </div>
            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-500">Period</span>
                <span class="font-medium">{{ $payment->membership_period }}</span>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex justify-between items-center">
                <span class="text-gray-600 font-medium">Total Amount</span>
                <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
            </div>
        </div>

        @if($payment->invoice_file)
            <div class="pt-2">
                <a href="{{ asset('storage/' . $payment->invoice_file) }}" target="_blank"
                    class="block w-full text-center bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
                    <i class="fas fa-file-pdf mr-2"></i>Download Invoice
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
