<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'package_name',
        'duration',
        'price',
        'booking_date',
        'booking_time',
        'full_name',
        'email',
        'phone',
        'company',
        'notes',
        'status',
        'meeting_url',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }
}
