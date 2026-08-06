<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $member = auth()->guard('member')->user();
        return view('member.card', compact('member'));
    }

    public function qrCode()
    {
        $member = auth()->guard('member')->user();
        $qrData = json_encode([
            'member_id' => $member->member_id,
            'name' => $member->name,
            'whatsapp' => $member->whatsapp,
        ]);

        return view('member.qrcode', compact('member', 'qrData'));
    }
}
