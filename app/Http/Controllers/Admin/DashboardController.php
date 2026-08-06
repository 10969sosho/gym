<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'active')->count();
        $expiredMembers = Member::where('status', 'expired')->count();
        $inactiveMembers = Member::where('status', 'inactive')->count();
        $expiringSoon = Member::where('status', 'active')
            ->whereBetween('expired_date', [now(), now()->addDays(30)])
            ->count();
        $totalPayment = Payment::where('payment_status', 'paid')->sum('amount');
        $recentMembers = Member::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalMembers',
            'activeMembers',
            'expiredMembers',
            'inactiveMembers',
            'expiringSoon',
            'totalPayment',
            'recentMembers'
        ));
    }
}
