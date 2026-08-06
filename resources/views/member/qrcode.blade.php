@extends('layouts.member')
@section('title', 'QR Code')
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="mb-4">
        <a href="{{ route('member.card') }}" class="text-gold text-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Kartu</a>
    </div>

    <div class="card-dark rounded-2xl p-8 border border-gray-800 text-center">
        <h2 class="text-white font-bold text-lg mb-2">Scan QR Code</h2>
        <p class="text-gray-400 text-sm mb-6">Tunjukkan QR code ini saat check-in</p>

        <div class="bg-white border-2 border-yellow-500 rounded-xl p-6 inline-block mb-6">
            <div id="qrcode" class="flex items-center justify-center" style="min-width: 200px; min-height: 200px;">
                <div class="text-center">
                    <i class="fas fa-qrcode text-8xl text-black mb-4"></i>
                    <p class="text-sm text-gray-600 font-mono">{{ $member->member_id }}</p>
                    <p class="text-xs text-gray-500">{{ $member->name }}</p>
                </div>
            </div>
        </div>

        <div class="bg-[#111111] rounded-xl p-4 border border-gray-800">
            <p class="text-white font-bold">{{ $member->name }}</p>
            <p class="text-gray-400 text-sm">{{ $member->member_id }} | {{ $member->membership_package }}</p>
        </div>
    </div>
</div>
@endsection
