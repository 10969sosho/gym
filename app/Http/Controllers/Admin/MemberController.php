<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('whatsapp', 'like', '%' . $request->search . '%')
                    ->orWhere('member_id', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $members = $query->latest()->paginate(10);

        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string|unique:members,whatsapp',
            'photo' => 'nullable|image|max:2048',
            'membership_package' => 'required|string',
            'start_date' => 'required|date',
            'expired_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,expired,inactive',
        ]);

        $validated['member_id'] = 'GYM' . str_pad(Member::max('id') ? Member::max('id') + 1 : 1, 4, '0', STR_PAD_LEFT);
        $validated['whatsapp'] = preg_replace('/[^0-9]/', '', $validated['whatsapp']);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos/members', 'public');
        }

        Member::create($validated);

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string|unique:members,whatsapp,' . $member->id,
            'photo' => 'nullable|image|max:2048',
            'membership_package' => 'required|string',
            'start_date' => 'required|date',
            'expired_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,expired,inactive',
        ]);

        $validated['whatsapp'] = preg_replace('/[^0-9]/', '', $validated['whatsapp']);

        if ($request->hasFile('photo')) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $validated['photo'] = $request->file('photo')->store('photos/members', 'public');
        }

        $member->update($validated);

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil diupdate.');
    }

    public function destroy(Member $member)
    {
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil dihapus.');
    }
}
