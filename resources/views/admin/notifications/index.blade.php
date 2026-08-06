@extends('layouts.admin')
@section('title', 'Notifications')
@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Notification Management</h1>
    <button onclick="openDrawer('notificationDrawer')" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">
        <i class="fas fa-plus mr-2"></i>Add Notification
    </button>
</div>

<div class="bg-white rounded-lg shadow-sm">
    <div class="p-4 border-b">
        <form action="{{ route('admin.notifications.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title..."
                class="flex-1 px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <select name="status" class="px-3 py-2 border rounded-lg text-sm">
                <option value="">All Status</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                <i class="fas fa-search mr-1"></i> Search
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="px-4 py-3 text-gray-500 font-medium">Title</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Category</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Status</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Published At</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $notification)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <p class="font-medium">{{ Str::limit($notification->title, 40) }}</p>
                        <p class="text-xs text-gray-500">{{ Str::limit($notification->content, 60) }}</p>
                    </td>
                    <td class="px-4 py-3">
                        <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full">{{ ucfirst($notification->category) }}</span>
                    </td>
                    <td class="px-4 py-3">
                        @if($notification->status === 'published')
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Published</span>
                        @elseif($notification->status === 'draft')
                            <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">Draft</span>
                        @else
                            <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full">Archived</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ $notification->publish_at ? $notification->publish_at->format('d M Y') : '-' }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-2">
                            <button onclick="openEditDrawer('notificationDrawer', {
                                id: {{ $notification->id }},
                                title: '{{ addslashes($notification->title) }}',
                                content: @js($notification->content),
                                category: '{{ $notification->category }}',
                                publish_at: '{{ $notification->publish_at ? $notification->publish_at->format('Y-m-d\TH:i') : '' }}',
                                status: '{{ $notification->status }}'
                            })" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.notifications.destroy', $notification) }}" method="POST" onsubmit="return confirm('Yakin hapus notifikasi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-bell-slash text-3xl text-gray-300 mb-2"></i>
                        <p>Tidak ada notifikasi ditemukan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t">
        {{ $notifications->links() }}
    </div>
</div>

{{-- Drawer for Create/Edit Notification --}}
<div id="notificationDrawer" class="fixed inset-0 z-50 hidden">
    <div class="drawer-overlay fixed inset-0 bg-black bg-opacity-50 opacity-0" onclick="closeDrawer('notificationDrawer')"></div>
    <div class="drawer-panel fixed top-0 right-0 h-full w-full max-w-lg bg-white shadow-xl transform translate-x-full">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b flex-shrink-0">
                <h3 class="drawer-title text-lg font-bold text-gray-800" data-default-title="Create Notification">Create Notification</h3>
                <button onclick="closeDrawer('notificationDrawer')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-4">
                <form action="{{ route('admin.notifications.store') }}" method="POST" data-edit-action="{{ route('admin.notifications.update', ':id') }}" data-store-action="{{ route('admin.notifications.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content *</label>
                            <textarea name="content" rows="6" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">{{ old('content') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                            <select name="category" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                                <option value="">Select Category</option>
                                <option value="membership">Membership</option>
                                <option value="payment">Payment</option>
                                <option value="announcement">Announcement</option>
                                <option value="promotion">Promotion</option>
                                <option value="event">Event</option>
                                <option value="operational">Operational</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Publish At</label>
                            <input type="datetime-local" name="publish_at" value="{{ old('publish_at') }}"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan untuk publish sekarang</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                            <select name="status" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex space-x-3">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                            <i class="fas fa-save mr-2"></i>Save Notification
                        </button>
                        <button type="button" onclick="closeDrawer('notificationDrawer')" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($errors->any() && request()->routeIs('admin.notifications.*'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        openDrawer('notificationDrawer');
    });
</script>
@endif
@endsection
