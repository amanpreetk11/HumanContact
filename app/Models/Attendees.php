<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendees extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'approved',
        'member_since',
    ];

    protected $casts = [
        'member_since' => 'datetime',
    ];

    public function getMemberSinceAttribute($value)
    {
        return Carbon::parse($value)->toDayDateTimeString();
    }

    public function getApprovedAttribute($value)
    {
        return ($value == 'true' ? 'Yes' : 'No');
    }
}
