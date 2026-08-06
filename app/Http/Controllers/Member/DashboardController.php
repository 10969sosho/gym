<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $member = auth()->guard('member')->user();
        $payments = Payment::where('member_id', $member->id)->latest()->take(5)->get();
        $notifications = Notification::published()->latest()->take(5)->get();
        $unreadCount = $member->unreadNotifications()->count();

        return view('member.dashboard', compact('member', 'payments', 'notifications', 'unreadCount'));
    }
}
