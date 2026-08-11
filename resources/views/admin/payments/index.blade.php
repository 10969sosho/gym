@extends('layouts.admin')
@section('title', 'Payments')
@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Payment Management</h1>
    <button onclick="openDrawer('paymentDrawer')" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">
        <i class="fas fa-plus mr-2"></i>Add Payment
    </button>
</div>

<div class="bg-white rounded-lg shadow-sm">
    <div class="p-4 border-b">
        <form action="{{ route('admin.payments.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search invoice or member name..."
                class="flex-1 px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
                    <th class="px-4 py-3 text-gray-500 font-medium">Period</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Date</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Amount</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Status</th>
                    <th class="px-4 py-3 text-gray-500 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <p class="font-medium">{{ $payment->member->name }}</p>
                        <p class="text-xs text-gray-500">{{ $payment->member->member_id }}</p>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $payment->membership_period }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $payment->transaction_date->format('d M Y') }}</td>
                    <td class="px-4 py-3 font-medium">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        @if($payment->payment_status === 'paid')
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Paid</span>
                        @elseif($payment->payment_status === 'pending')
                            <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">Pending</span>
                        @else
                            <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Overdue</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-2">
                            <button onclick="openMemberPaymentDrawer({{ $payment->member_id }}, @js($payment->member->name))" class="text-indigo-600 hover:text-indigo-800" title="Detail Customer">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button onclick="openEditDrawer('paymentDrawer', {
                                id: {{ $payment->id }},
                                member_id: {{ $payment->member_id }},
                                invoice_number: '{{ $payment->invoice_number }}',
                                transaction_date: '{{ $payment->transaction_date->format('Y-m-d') }}',
                                membership_period: '{{ $payment->membership_period }}',
                                amount: '{{ $payment->amount }}',
                                payment_status: '{{ $payment->payment_status }}'
                            })" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Yakin hapus pembayaran ini?')">
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
                        <i class="fas fa-money-bill-wave text-3xl text-gray-300 mb-2"></i>
                        <p>Tidak ada pembayaran ditemukan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t">
        {{ $payments->links() }}
    </div>
</div>

{{-- Drawer for Create/Edit Payment --}}
<div id="paymentDrawer" class="fixed inset-0 z-50 hidden">
    <div class="drawer-overlay fixed inset-0 bg-black bg-opacity-50 opacity-0" onclick="closeDrawer('paymentDrawer')"></div>
    <div class="drawer-panel fixed top-0 right-0 h-full w-full max-w-lg bg-white shadow-xl transform translate-x-full">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b flex-shrink-0">
                <h3 class="drawer-title text-lg font-bold text-gray-800" data-default-title="Add New Payment">Add New Payment</h3>
                <button onclick="closeDrawer('paymentDrawer')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-4">
                <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data" data-edit-action="{{ route('admin.payments.update', ':id') }}" data-store-action="{{ route('admin.payments.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Member *</label>
                            <select name="member_id" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                                <option value="">Select Member</option>
                                @foreach(\App\Models\Member::orderBy('name')->get() as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->member_id }})</option>
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
                                <option value="1 Month">1 Month</option>
                                <option value="3 Months">3 Months</option>
                                <option value="6 Months">6 Months</option>
                                <option value="12 Months">12 Months</option>
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
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="overdue">Overdue</option>
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
                        <button type="button" onclick="closeDrawer('paymentDrawer')" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($errors->any() && request()->routeIs('admin.payments.*'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        openDrawer('paymentDrawer');
    });
</script>
@endif

{{-- Drawer for Member Payment Detail --}}
<div id="memberPaymentDrawer" class="fixed inset-0 z-50 hidden">
    <div class="drawer-overlay fixed inset-0 bg-black bg-opacity-50 opacity-0" onclick="closeDrawer('memberPaymentDrawer')"></div>
    <div class="drawer-panel fixed top-0 right-0 h-full w-full max-w-lg bg-white shadow-xl transform translate-x-full">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b flex-shrink-0">
                <h3 class="text-lg font-bold text-gray-800" id="memberPaymentTitle">Detail Customer</h3>
                <button onclick="closeDrawer('memberPaymentDrawer')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-4">
                <div id="memberPaymentContent" class="text-center text-gray-500 text-sm py-8">
                    <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function openMemberPaymentDrawer(memberId, memberName) {
        const drawer = document.getElementById('memberPaymentDrawer');
        const overlay = drawer.querySelector('.drawer-overlay');
        const panel = drawer.querySelector('.drawer-panel');
        const title = document.getElementById('memberPaymentTitle');
        const content = document.getElementById('memberPaymentContent');

        title.textContent = memberName;
        content.innerHTML = '<div class="text-center text-gray-500 text-sm py-8"><i class="fas fa-spinner fa-spin text-2xl mb-2"></i><p>Loading...</p></div>';

        drawer.classList.remove('hidden');
        setTimeout(() => {
            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');
            panel.classList.remove('translate-x-full');
            panel.classList.add('translate-x-0');
        }, 10);
        document.body.style.overflow = 'hidden';

        try {
            const response = await fetch('/admin/members/' + memberId + '/payments');
            if (!response.ok) {
                throw new Error('Failed to load member payments');
            }
            const html = await response.text();
            content.innerHTML = html;
        } catch (e) {
            content.innerHTML = '<div class="text-center text-red-500 py-8"><p>Gagal memuat data.</p></div>';
        }
    }
</script>
@endsection
