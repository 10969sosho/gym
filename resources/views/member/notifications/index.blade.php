@extends('layouts.member')
@section('title', 'Notifications')
@section('content')
<div class="mb-4">
    <h1 class="text-xl font-bold text-gray-800">Notifications</h1>
    <p class="text-gray-500 text-sm">Informasi dan pengumuman</p>
</div>

@forelse($notifications as $notification)
    <a href="{{ route('member.notifications.show', $notification) }}" class="block bg-white rounded-lg p-4 mb-3 shadow-sm hover:shadow-md transition">
        <div class="flex items-start">
            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 flex-shrink-0
                @if($notification->category === 'payment') bg-green-100
                @elseif($notification->category === 'membership') bg-blue-100
                @elseif($notification->category === 'promotion') bg-orange-100
                @elseif($notification->category === 'event') bg-purple-100
                @else bg-gray-100 @endif">
                @if($notification->category === 'payment')
                    <i class="fas fa-money-bill text-green-600"></i>
                @elseif($notification->category === 'membership')
                    <i class="fas fa-id-card text-blue-600"></i>
                @elseif($notification->category === 'promotion')
                    <i class="fas fa-tag text-orange-600"></i>
                @elseif($notification->category === 'event')
                    <i class="fas fa-calendar text-purple-600"></i>
                @elseif($notification->category === 'announcement')
                    <i class="fas fa-bullhorn text-gray-600"></i>
                @else
                    <i class="fas fa-cog text-gray-600"></i>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-medium text-gray-800 text-sm">{{ $notification->title }}</p>
                <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ Str::limit($notification->content, 80) }}</p>
                <div class="flex items-center mt-2">
                    <span class="text-xs text-gray-400">
                        <i class="fas fa-clock mr-1"></i>{{ $notification->publish_at->diffForHumans() }}
                    </span>
                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full ml-2">{{ ucfirst($notification->category) }}</span>
                </div>
            </div>
        </div>
    </a>
@empty
    <div class="bg-white rounded-lg p-8 text-center">
        <i class="fas fa-bell-slash text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-500">Belum ada notifikasi</p>
    </div>
@endforelse

<div class="mt-4">
    {{ $notifications->links() }}
</div>
@endsection
