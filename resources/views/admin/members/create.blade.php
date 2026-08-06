@extends('layouts.admin')
@section('title', 'Add Member')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.members.index') }}" class="text-indigo-600 text-sm hover:underline"><i class="fas fa-arrow-left mr-1"></i> Back to Members</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl">
    <h1 class="text-xl font-bold text-gray-800 mb-6">Add New Member</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
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
                    <option value="Basic" {{ old('membership_package') === 'Basic' ? 'selected' : '' }}>Basic</option>
                    <option value="Standard" {{ old('membership_package') === 'Standard' ? 'selected' : '' }}>Standard</option>
                    <option value="Premium" {{ old('membership_package') === 'Premium' ? 'selected' : '' }}>Premium</option>
                    <option value="VIP" {{ old('membership_package') === 'VIP' ? 'selected' : '' }}>VIP</option>
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
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ old('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="mt-6 flex space-x-3">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                <i class="fas fa-save mr-2"></i>Save Member
            </button>
            <a href="{{ route('admin.members.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
