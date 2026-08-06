<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('member')->latest();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%')
                    ->orWhereHas('member', function ($q2) use ($request) {
                        $q2->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $payments = $query->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();
        return view('admin.payments.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'invoice_number' => 'required|string|unique:payments,invoice_number',
            'transaction_date' => 'required|date',
            'membership_period' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid,overdue',
            'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('invoice_file')) {
            $validated['invoice_file'] = $request->file('invoice_file')->store('invoices', 'public');
        }

        Payment::create($validated);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function edit(Payment $payment)
    {
        $members = Member::orderBy('name')->get();
        return view('admin.payments.edit', compact('payment', 'members'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'invoice_number' => 'required|string|unique:payments,invoice_number,' . $payment->id,
            'transaction_date' => 'required|date',
            'membership_period' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid,overdue',
            'invoice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('invoice_file')) {
            if ($payment->invoice_file) {
                Storage::disk('public')->delete($payment->invoice_file);
            }
            $validated['invoice_file'] = $request->file('invoice_file')->store('invoices', 'public');
        }

        $payment->update($validated);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil diupdate.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->invoice_file) {
            Storage::disk('public')->delete($payment->invoice_file);
        }
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
