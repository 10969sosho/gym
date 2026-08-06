<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationRead extends Model
{
    protected $fillable = [
        'notification_id',
        'member_id',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
