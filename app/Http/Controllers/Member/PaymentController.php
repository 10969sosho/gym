<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $member = auth()->guard('member')->user();
        $query = Payment::where('member_id', $member->id)->latest();

        if ($request->search) {
            $query->where('invoice_number', 'like', '%' . $request->search . '%');
        }

        $payments = $query->paginate(10);

        return view('member.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $member = auth()->guard('member')->user();
        if ($payment->member_id !== $member->id) {
            abort(403);
        }
        return view('member.payments.show', compact('payment'));
    }
}
