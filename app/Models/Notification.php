<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'publish_at',
        'status',
    ];

    protected $casts = [
        'publish_at' => 'datetime',
    ];

    public function reads()
    {
        return $this->hasMany(NotificationRead::class);
    }

    public function isReadBy($member)
    {
        return $this->reads()->where('member_id', $member->id)->exists();
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
