<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationRead;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $member = auth()->guard('member')->user();
        $notifications = Notification::published()->latest('publish_at')->paginate(10);

        return view('member.notifications.index', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        $member = auth()->guard('member')->user();

        if ($notification->status !== 'published') {
            abort(404);
        }

        NotificationRead::firstOrCreate(
            ['notification_id' => $notification->id, 'member_id' => $member->id],
            ['read_at' => now()]
        );

        return view('member.notifications.show', compact('notification'));
    }
}
