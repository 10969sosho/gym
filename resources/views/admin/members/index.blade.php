@extends('layouts.admin')
@section('title', 'Members')
@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Member Management</h1>
    <button onclick="openDrawer('memberDrawer')" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">
        <i class="fas fa-plus mr-2"></i>Add Member
    </button>
</div>

<div class="bg-white rounded-lg shadow-sm">
    <div class="p-4 border-b">
        <form action="{{ route('admin.members.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, WhatsApp, or ID..."
                class="flex-1 px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <select name="status" class="px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                    <th class="px-4 py-3 text-gray-500 font-medium">Member</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">WhatsApp</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Package</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Status</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Expires</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3 overflow-hidden">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-user text-indigo-600 text-sm"></i>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium">{{ $member->name }}</p>
                                <p class="text-xs text-gray-500">{{ $member->member_id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $member->whatsapp }}</td>
                    <td class="px-4 py-3">{{ $member->membership_package }}</td>
                    <td class="px-4 py-3">
                        @if($member->status === 'active')
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Active</span>
                        @elseif($member->status === 'expired')
                            <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Expired</span>
                        @else
                            <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $member->expired_date->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-2">
                            <button onclick="openEditDrawer('memberDrawer', {
                                id: {{ $member->id }},
                                name: '{{ addslashes($member->name) }}',
                                whatsapp: '{{ $member->whatsapp }}',
                                membership_package: '{{ $member->membership_package }}',
                                start_date: '{{ $member->start_date->format('Y-m-d') }}',
                                expired_date: '{{ $member->expired_date->format('Y-m-d') }}',
                                status: '{{ $member->status }}'
                            })" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.members.destroy', $member) }}" method="POST" onsubmit="return confirm('Yakin hapus member ini?')">
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
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-users text-3xl text-gray-300 mb-2"></i>
                        <p>Tidak ada member ditemukan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t">
        {{ $members->links() }}
    </div>
</div>

{{-- Drawer for Create/Edit Member --}}
<div id="memberDrawer" class="fixed inset-0 z-50 hidden">
    <div class="drawer-overlay fixed inset-0 bg-black bg-opacity-50 opacity-0" onclick="closeDrawer('memberDrawer')"></div>
    <div class="drawer-panel fixed top-0 right-0 h-full w-full max-w-lg bg-white shadow-xl transform translate-x-full">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b flex-shrink-0">
                <h3 class="drawer-title text-lg font-bold text-gray-800" data-default-title="Add New Member">Add New Member</h3>
                <button onclick="closeDrawer('memberDrawer')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-4">
                <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data" data-edit-action="{{ route('admin.members.update', ':id') }}" data-store-action="{{ route('admin.members.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp *</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="628xxxxxxxxxx" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                            <input type="file" name="photo" accept="image/*"
                                class="w-full px-3 py-2 border rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Membership Package *</label>
                            <select name="membership_package" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                                <option value="">Select Package</option>
                                <option value="Basic">Basic</option>
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                                <option value="VIP">VIP</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}" required
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Expired Date *</label>
                                <input type="date" name="expired_date" value="{{ old('expired_date') }}" required
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                            <select name="status" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex space-x-3">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                            <i class="fas fa-save mr-2"></i>Save Member
                        </button>
                        <button type="button" onclick="closeDrawer('memberDrawer')" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($errors->any() && request()->routeIs('admin.members.*'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        openDrawer('memberDrawer');
    });
</script>
@endif
@endsection
