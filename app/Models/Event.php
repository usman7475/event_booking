<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
 'title','description','location','event_datetime',
 'total_seats','available_seats','user_id'
];

    protected $casts = [
        'event_datetime' => 'datetime',
    ];

public function bookings(){
 return $this->hasMany(Booking::class);
}

public function user(){
 return $this->belongsTo(User::class);
}
}
