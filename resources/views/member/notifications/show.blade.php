@extends('layouts.member')
@section('title', $notification->title)
@section('content')
<div class="mb-4">
    <a href="{{ route('member.notifications.index') }}" class="text-indigo-600 text-sm"><i class="fas fa-arrow-left mr-1"></i> Back</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b bg-gray-50">
        <div class="flex items-center justify-between">
            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full font-medium">
                {{ ucfirst($notification->category) }}
            </span>
            <span class="text-xs text-gray-500">
                <i class="fas fa-clock mr-1"></i>{{ $notification->publish_at->format('d M Y, H:i') }}
            </span>
        </div>
    </div>

    <div class="p-4">
        <h1 class="text-lg font-bold text-gray-800 mb-4">{{ $notification->title }}</h1>
        <div class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
            {{ $notification->content }}
        </div>
    </div>
</div>
@endsection
