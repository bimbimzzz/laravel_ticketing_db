<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    //fillable properties
    protected $fillable = [
        'name',
        'description',
    ];

    //events
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
