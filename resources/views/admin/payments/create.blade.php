@extends('layouts.admin')
@section('title', 'Add Payment')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.payments.index') }}" class="text-indigo-600 text-sm hover:underline"><i class="fas fa-arrow-left mr-1"></i> Back to Payments</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl">
    <h1 class="text-xl font-bold text-gray-800 mb-6">Add New Payment</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Member *</label>
                <select name="member_id" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                    <option value="">Select Member</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>{{ $member->name }} ({{ $member->member_id }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Number *</label>
                <input type="text" name="invoice_number" value="{{ old('invoice_number') }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Transaction Date *</label>
                <input type="date" name="transaction_date" value="{{ old('transaction_date') }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Membership Period *</label>
                <select name="membership_period" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                    <option value="">Select Period</option>
                    <option value="1 Month" {{ old('membership_period') === '1 Month' ? 'selected' : '' }}>1 Month</option>
                    <option value="3 Months" {{ old('membership_period') === '3 Months' ? 'selected' : '' }}>3 Months</option>
                    <option value="6 Months" {{ old('membership_period') === '6 Months' ? 'selected' : '' }}>6 Months</option>
                    <option value="12 Months" {{ old('membership_period') === '12 Months' ? 'selected' : '' }}>12 Months</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Amount (Rp) *</label>
                <input type="number" name="amount" value="{{ old('amount') }}" min="0" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Status *</label>
                <select name="payment_status" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                    <option value="pending" {{ old('payment_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="overdue" {{ old('payment_status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice / Receipt File</label>
                <input type="file" name="invoice_file" accept=".pdf,.jpg,.jpeg,.png"
                    class="w-full px-3 py-2 border rounded-lg text-sm">
            </div>
        </div>
        <div class="mt-6 flex space-x-3">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 text-sm">
                <i class="fas fa-save mr-2"></i>Save Payment
            </button>
            <a href="{{ route('admin.payments.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
