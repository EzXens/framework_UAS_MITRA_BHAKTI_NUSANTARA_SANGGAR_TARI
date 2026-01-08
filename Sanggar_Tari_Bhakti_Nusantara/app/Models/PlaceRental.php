<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'letter_number',
        'letter_code',
        'to',
        'activity_name',
        'organizer',
        'place_name',
        'rental_purpose',
        'day',
        'date_from',
        'date_to',
        'time',
        'city_province',
        'status',
        'template',
        'pdf',
    ];

    protected $casts = [
        'date_from' => 'date',
        'date_to' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
