@extends('layouts.member')
@section('title', 'Notifikasi')
@section('content')
<div class="px-4 pt-6 pb-4">
    <div class="flex items-center justify-between mb-2">
        <h1 class="text-2xl font-bold text-white">Notifikasi</h1>
        <a href="{{ route('member.notifications.index') }}" class="relative text-white">
            <i class="fas fa-bell text-xl"></i>
        </a>
    </div>
    <p class="text-gray-400 text-sm mb-6">Informasi dan pengumuman</p>

    @forelse($notifications as $notification)
        <a href="{{ route('member.notifications.show', $notification) }}" class="block card-dark rounded-xl p-4 mb-3 border border-gray-800">
            <div class="flex items-start">
                <div class="w-12 h-12 rounded-full bg-yellow-500/20 flex items-center justify-center mr-3 flex-shrink-0">
                    @if($notification->category === 'payment')
                        <i class="fas fa-money-bill text-gold"></i>
                    @elseif($notification->category === 'membership')
                        <i class="fas fa-id-card text-gold"></i>
                    @elseif($notification->category === 'promotion')
                        <i class="fas fa-tag text-gold"></i>
                    @elseif($notification->category === 'event')
                        <i class="fas fa-calendar text-gold"></i>
                    @elseif($notification->category === 'announcement')
                        <i class="fas fa-bullhorn text-gold"></i>
                    @else
                        <i class="fas fa-cog text-gold"></i>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white font-medium text-sm">{{ $notification->title }}</p>
                    <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ Str::limit($notification->content, 80) }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-gray-500 text-xs">
                            <i class="fas fa-clock mr-1"></i>{{ $notification->publish_at->diffForHumans() }}
                        </span>
                        <span class="text-xs bg-yellow-500/20 text-gold px-2 py-0.5 rounded-full ml-2">{{ ucfirst($notification->category) }}</span>
                    </div>
                </div>
            </div>
        </a>
    @empty
        <div class="card-dark rounded-xl p-8 text-center border border-gray-800">
            <i class="fas fa-bell-slash text-4xl text-gray-600 mb-3"></i>
            <p class="text-gray-400">Belum ada notifikasi</p>
        </div>
    @endforelse

    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
