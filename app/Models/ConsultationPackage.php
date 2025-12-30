<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'name',
        'duration',
        'price',
        'price_display',
        'description',
        'platform',
        'order',
        'is_active',
        'is_popular',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
    ];

    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }
}