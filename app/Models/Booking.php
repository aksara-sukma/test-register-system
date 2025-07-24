<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'submit_code',
        'test_id',
        'email',
        'phone',
        'payment_proof',
        'additional_files',
        'referral',
        'status',
        'verified_at'
    ];

    protected $casts = [
        'additional_files' => 'array',
        'verified_at' => 'datetime'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            $booking->submit_code = 'BT' . date('Ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        });

        static::created(function ($booking) {
            $booking->test->updateQuotas();
        });

        static::updated(function ($booking) {
            $booking->test->updateQuotas();
        });

        static::deleted(function ($booking) {
            $booking->test->updateQuotas();
        });
    }
}