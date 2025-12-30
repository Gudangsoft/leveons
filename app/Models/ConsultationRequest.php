<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company_name',
        'position',
        'service_needs',
        'estimated_implementation_time',
        'scope_details'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get formatted created date
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d F Y, H:i');
    }
}
