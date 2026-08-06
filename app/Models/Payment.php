<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'invoice_number',
        'transaction_date',
        'membership_period',
        'amount',
        'payment_status',
        'invoice_file',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
