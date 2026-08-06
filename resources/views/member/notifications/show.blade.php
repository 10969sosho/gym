@extends('layouts.member')
@section('title', $notification->title)
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="mb-4">
        <a href="{{ route('member.notifications.index') }}" class="text-gold text-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>

    <div class="card-dark rounded-2xl border border-gray-800 overflow-hidden">
        <div class="p-4 border-b border-gray-800 bg-[#111111]">
            <div class="flex items-center justify-between">
                <span class="text-xs bg-yellow-500/20 text-gold px-3 py-1 rounded-full font-medium">
                    {{ ucfirst($notification->category) }}
                </span>
                <span class="text-xs text-gray-400">
                    <i class="fas fa-clock mr-1"></i>{{ $notification->publish_at->format('d M Y, H:i') }}
                </span>
            </div>
        </div>

        <div class="p-4">
            <h1 class="text-xl font-bold text-white mb-4">{{ $notification->title }}</h1>
            <div class="text-gray-300 text-sm leading-relaxed whitespace-pre-line">
                {{ $notification->content }}
            </div>
        </div>
    </div>
</div>
@endsection
