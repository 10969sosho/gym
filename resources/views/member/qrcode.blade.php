@extends('layouts.member')
@section('title', 'QR Code')
@section('content')
<div class="mb-4">
    <a href="{{ route('member.card') }}" class="text-indigo-600 text-sm"><i class="fas fa-arrow-left mr-1"></i> Back to Card</a>
</div>

<div class="bg-white rounded-2xl p-8 shadow-sm text-center">
    <h2 class="font-bold text-lg text-gray-800 mb-2">Scan QR Code</h2>
    <p class="text-gray-500 text-sm mb-6">Tunjukkan QR code ini saat check-in</p>

    <div class="bg-white border-2 border-indigo-200 rounded-xl p-6 inline-block mb-6">
        <div id="qrcode" class="flex items-center justify-center" style="min-width: 200px; min-height: 200px;">
            <div class="text-center">
                <i class="fas fa-qrcode text-8xl text-indigo-600 mb-4"></i>
                <p class="text-sm text-gray-500 font-mono">{{ $member->member_id }}</p>
                <p class="text-xs text-gray-400">{{ $member->name }}</p>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-sm font-medium text-gray-800">{{ $member->name }}</p>
        <p class="text-xs text-gray-500">{{ $member->member_id }} | {{ $member->membership_package }}</p>
    </div>
</div>
@endsection
