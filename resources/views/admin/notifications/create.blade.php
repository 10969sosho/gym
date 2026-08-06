@extends('layouts.admin')
@section('title', 'Add Notification')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.notifications.index') }}" class="text-indigo-600 text-sm hover:underline"><i class="fas fa-arrow-left mr-1"></i> Back to Notifications</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl">
    <h1 class="text-xl font-bold text-gray-800 mb-6">Create Notification</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.notifications.store') }}" method="POST">
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
                    <option value="membership" {{ old('category') === 'membership' ? 'selected' : '' }}>Membership</option>
                    <option value="payment" {{ old('category') === 'payment' ? 'selected' : '' }}>Payment</option>
                    <option value="announcement" {{ old('category') === 'announcement' ? 'selected' : '' }}>Announcement</option>
                    <option value="promotion" {{ old('category') === 'promotion' ? 'selected' : '' }}>Promotion</option>
                    <option value="event" {{ old('category') === 'event' ? 'selected' : '' }}>Event</option>
                    <option value="operational" {{ old('category') === 'operational' ? 'selected' : '' }}>Operational</option>
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
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
        </div>
        <div class="mt-6 flex space-x-3">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                <i class="fas fa-save mr-2"></i>Save Notification
            </button>
            <a href="{{ route('admin.notifications.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
