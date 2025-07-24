<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'test_date',
        'start_time',
        'end_time',
        'test_day',
        'total_quota',
        'verified_quota',
        'pending_quota',
        'is_active'
    ];

    protected $casts = [
        'test_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getAvailableQuotaAttribute()
    {
        return $this->total_quota - $this->verified_quota - $this->pending_quota;
    }

    public function updateQuotas()
    {
        $this->verified_quota = $this->bookings()->where('status', 'verified')->count();
        $this->pending_quota = $this->bookings()->where('status', 'pending')->count();
        $this->save();
    }
}