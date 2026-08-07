@extends('layouts.member')
@section('title', 'Kartu Member')
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Kartu Member</h1>
            <p class="text-gray-400 text-sm">Tunjukkan kartu ini saat check-in di gym</p>
        </div>
        <a href="{{ route('member.notifications.index') }}" class="relative text-white">
            <i class="fas fa-bell text-xl"></i>
            @if($unreadCount ?? 0 > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">{{ $unreadCount }}</span>
            @endif
        </a>
    </div>

    <div class="relative rounded-2xl overflow-hidden mb-6 shadow-2xl shadow-yellow-500/10 aspect-[1.6/1]">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('bg.png') }}');"></div>

        <div class="relative z-10 p-5 flex flex-col justify-between h-full">
            <div class="flex justify-end">
                <span class="bg-yellow-500/20 text-yellow-400 text-xs font-bold px-3 py-1 rounded-full">
                    {{ $member->membership_package }}
                </span>
            </div>

            <div class="flex items-end justify-between">
                <div>
                    @if($member->photo)
                        <div class="w-14 h-14 rounded-full border-2 border-yellow-500 overflow-hidden mb-2">
                            <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
                <div class="absolute bottom-10 left-5">
                    <p class="text-gold text-sm font-bold">{{ $member->member_id }}</p>
                </div>
                <a href="{{ route('member.card.qr') }}" class="bg-white rounded-xl p-2 shadow-lg">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ $member->member_id }}" alt="QR" class="w-20 h-20">
                </a>
            </div>
        </div>
    </div>

    <div class="card-dark rounded-2xl p-5 mb-6 border border-gray-800">
        <div class="flex items-center mb-5 pb-4 border-b border-gray-800">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-phone text-gold"></i>
            </div>
            <div>
                <p class="text-gray-400 text-xs">WhatsApp</p>
                <p class="text-white font-medium">{{ $member->whatsapp }}</p>
            </div>
        </div>

        <div class="flex items-center mb-5 pb-4 border-b border-gray-800">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-crown text-gold"></i>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Paket Membership</p>
                <p class="text-white font-medium">{{ $member->membership_package }}</p>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3">
                <i class="fas fa-calendar-alt text-gold"></i>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Masa Aktif</p>
                <p class="text-white font-medium">{{ $member->start_date->format('d M Y') }} - {{ $member->expired_date->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <div class="card-dark rounded-2xl p-5 mb-6 border border-gray-800">
        <div class="flex items-start">
            <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3 flex-shrink-0">
                <i class="fas fa-shield-check text-gold"></i>
            </div>
            <div class="flex-1">
                <p class="text-white font-bold mb-1">Tunjukkan kartu ini</p>
                <p class="text-gray-400 text-sm">saat check-in di gym untuk mendapatkan akses dan benefit member.</p>
            </div>
            <i class="fas fa-chevron-right text-gray-600"></i>
        </div>
    </div>

    <a href="{{ route('member.card.qr') }}" class="block w-full bg-gold text-black text-center py-4 rounded-xl font-bold text-lg hover:bg-yellow-400 transition">
        <i class="fas fa-qrcode mr-2"></i> Scan QR Code
    </a>
</div>
@endsection
