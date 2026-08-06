<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('category', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $notifications = $query->latest()->paginate(10);

        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:membership,payment,announcement,promotion,event,operational',
            'publish_at' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
        ]);

        Notification::create($validated);

        return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi berhasil ditambahkan.');
    }

    public function edit(Notification $notification)
    {
        return view('admin.notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:membership,payment,announcement,promotion,event,operational',
            'publish_at' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
        ]);

        $notification->update($validated);

        return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi berhasil diupdate.');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi berhasil dihapus.');
    }
}
