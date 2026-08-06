@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Member</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalMembers }}</p>
            </div>
            <i class="fas fa-users text-3xl text-blue-200"></i>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Active Member</p>
                <p class="text-2xl font-bold text-gray-800">{{ $activeMembers }}</p>
            </div>
            <i class="fas fa-user-check text-3xl text-green-200"></i>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Expired Member</p>
                <p class="text-2xl font-bold text-gray-800">{{ $expiredMembers }}</p>
            </div>
            <i class="fas fa-user-times text-3xl text-red-200"></i>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Expiring Soon</p>
                <p class="text-2xl font-bold text-gray-800">{{ $expiringSoon }}</p>
            </div>
            <i class="fas fa-exclamation-triangle text-3xl text-yellow-200"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-5">
        <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-chart-pie mr-2 text-indigo-500"></i>Member Status</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Active</span>
                </div>
                <span class="font-bold text-sm">{{ $activeMembers }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Expired</span>
                </div>
                <span class="font-bold text-sm">{{ $expiredMembers }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-gray-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Inactive</span>
                </div>
                <span class="font-bold text-sm">{{ $inactiveMembers }}</span>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-5">
        <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-money-bill-wave mr-2 text-green-500"></i>Total Revenue</h3>
        <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalPayment, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500 mt-2">Dari pembayaran yang sudah diterima</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-sm p-5">
    <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-clock mr-2 text-blue-500"></i>Recent Members</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b text-left">
                    <th class="pb-2 text-gray-500 font-medium">Name</th>
                    <th class="pb-2 text-gray-500 font-medium">Package</th>
                    <th class="pb-2 text-gray-500 font-medium">Status</th>
                    <th class="pb-2 text-gray-500 font-medium">Expires</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentMembers as $member)
                <tr class="border-b">
                    <td class="py-3">
                        <p class="font-medium">{{ $member->name }}</p>
                        <p class="text-xs text-gray-500">{{ $member->member_id }}</p>
                    </td>
                    <td class="py-3">{{ $member->membership_package }}</td>
                    <td class="py-3">
                        @if($member->status === 'active')
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Active</span>
                        @elseif($member->status === 'expired')
                            <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Expired</span>
                        @else
                            <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full">Inactive</span>
                        @endif
                    </td>
                    <td class="py-3 text-gray-500">{{ $member->expired_date->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
