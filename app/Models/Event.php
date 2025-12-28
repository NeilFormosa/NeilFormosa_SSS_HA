<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'department_id',
        'date',
        'location',
        'organizer_name',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }
}
