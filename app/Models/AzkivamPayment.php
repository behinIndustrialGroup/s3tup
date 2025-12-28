<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AzkivamPayment extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_WAITING_FOR_CALLBACK = 'waiting_for_callback';
    public const STATUS_PAID = 'paid';
    public const STATUS_FAILED = 'failed';

    protected $fillable = [
        'payment_id',
        'order_id',
        'amount',
        'status',
        'gateway_url',
        'callback_url',
        'tracking_code',
        'meta',
        'provider_payload',
        'verified_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'provider_payload' => 'array',
        'verified_at' => 'datetime',
    ];

    public function markVerified(?string $trackingCode = null): void
    {
        $this->forceFill([
            'status' => self::STATUS_PAID,
            'tracking_code' => $trackingCode ?? $this->tracking_code,
            'verified_at' => Carbon::now(),
        ])->save();
    }
}
