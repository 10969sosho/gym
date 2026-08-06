@extends('layouts.member')
@section('title', 'Digital Member Card')
@section('content')
<div class="mb-4">
    <h1 class="text-xl font-bold text-gray-800">Digital Member Card</h1>
    <p class="text-gray-500 text-sm">Tunjukkan kartu ini saat check-in</p>
</div>

<div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl p-6 text-white shadow-xl mb-6 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 rounded-full -mr-16 -mt-16 opacity-20"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-indigo-500 rounded-full -ml-12 -mb-12 opacity-20"></div>

    <div class="relative z-10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-gray-400 text-xs">GYM MEMBER</p>
                <h2 class="font-bold text-lg">Digital Card</h2>
            </div>
            <i class="fas fa-dumbbell text-3xl text-indigo-400"></i>
        </div>

        <div class="flex items-center mb-6">
            <div class="w-16 h-16 bg-gray-600 rounded-full flex items-center justify-center mr-4 overflow-hidden">
                @if($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-user text-2xl text-gray-400"></i>
                @endif
            </div>
            <div>
                <h3 class="font-bold text-lg">{{ $member->name }}</h3>
                <p class="text-indigo-300 text-sm">{{ $member->member_id }}</p>
            </div>
        </div>

        <div class="border-t border-gray-700 pt-4 space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Package</span>
                <span class="font-medium">{{ $member->membership_package }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Start Date</span>
                <span class="font-medium">{{ $member->start_date->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Expired Date</span>
                <span class="font-medium {{ $member->status === 'expired' ? 'text-red-400' : '' }}">{{ $member->expired_date->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Status</span>
                @if($member->status === 'active')
                    <span class="bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">ACTIVE</span>
                @elseif($member->status === 'expired')
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">EXPIRED</span>
                @else
                    <span class="bg-gray-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">INACTIVE</span>
                @endif
            </div>
        </div>
    </div>
</div>

<a href="{{ route('member.card.qr') }}" class="block w-full bg-indigo-600 text-white text-center py-3 rounded-xl hover:bg-indigo-700 transition font-medium mb-4">
    <i class="fas fa-qrcode mr-2"></i> Show QR Code
</a>

<div class="bg-white rounded-xl p-4 shadow-sm">
    <h3 class="font-bold text-gray-800 mb-3"><i class="fas fa-info-circle mr-2 text-indigo-500"></i>Card Info</h3>
    <div class="space-y-2 text-sm">
        <div class="flex justify-between">
            <span class="text-gray-500">WhatsApp</span>
            <span class="font-medium text-gray-800">{{ $member->whatsapp }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">Member Since</span>
            <span class="font-medium text-gray-800">{{ $member->start_date->format('d M Y') }}</span>
        </div>
    </div>
</div>
@endsection
