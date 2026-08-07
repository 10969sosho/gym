<div class="mb-4 p-4 bg-gray-50 rounded-lg">
    <p class="text-sm text-gray-500">Member ID</p>
    <p class="font-bold text-gray-800">{{ $member->member_id }}</p>
    <p class="text-sm text-gray-500 mt-2">WhatsApp</p>
    <p class="text-gray-800">{{ $member->whatsapp }}</p>
    <p class="text-sm text-gray-500 mt-2">Package</p>
    <p class="text-gray-800">{{ $member->membership_package }}</p>
    <p class="text-sm text-gray-500 mt-2">Status</p>
    @if($member->status === 'active')
        <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Active</span>
    @elseif($member->status === 'expired')
        <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Expired</span>
    @else
        <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full">Inactive</span>
    @endif
</div>

<h4 class="font-bold text-gray-800 mb-3">Riwayat Invoice</h4>

@forelse($payments as $payment)
    <div class="border border-gray-200 rounded-lg p-4 mb-3">
        <div class="flex justify-between items-start mb-2">
            <div>
                <p class="font-bold text-gray-800 text-sm">{{ $payment->invoice_number }}</p>
                <p class="text-xs text-gray-500">{{ $payment->transaction_date->format('d M Y') }} · {{ $payment->membership_period }}</p>
            </div>
            <span class="font-bold text-indigo-600 text-sm">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
        </div>
        <div class="flex items-center justify-between">
            <div>
                @if($payment->payment_status === 'paid')
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Paid</span>
                @elseif($payment->payment_status === 'pending')
                    <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">Pending</span>
                @else
                    <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Overdue</span>
                @endif
            </div>
            @if($payment->invoice_file)
                <a href="{{ asset('storage/' . $payment->invoice_file) }}" target="_blank" class="text-green-600 hover:text-green-800 text-sm font-medium">
                    <i class="fas fa-file-download mr-1"></i> Download Invoice
                </a>
            @else
                <span class="text-gray-400 text-xs">No file</span>
            @endif
        </div>
    </div>
@empty
    <div class="text-center text-gray-500 py-8">
        <i class="fas fa-receipt text-3xl text-gray-300 mb-2"></i>
        <p>Belum ada invoice</p>
    </div>
@endforelse
