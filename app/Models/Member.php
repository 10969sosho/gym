<?php

namespace App\Models;

use Database\Factories\MemberFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    /** @use HasFactory<MemberFactory> */
    use HasFactory;

    protected $fillable = [
        'member_id',
        'name',
        'whatsapp',
        'photo',
        'membership_package',
        'start_date',
        'expired_date',
        'status',
        'qr_code',
        'login_token',
        'token_expires_at',
    ];

    protected $hidden = [
        'login_token',
        'token_expires_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'expired_date' => 'date',
        'token_expires_at' => 'datetime',
    ];

    protected $guard = 'member';

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function notificationReads()
    {
        return $this->hasMany(NotificationRead::class);
    }

    public function unreadNotifications()
    {
        return Notification::where('status', 'published')
            ->whereDoesntHave('reads', function ($q) {
                $q->where('member_id', $this->id);
            });
    }
}
