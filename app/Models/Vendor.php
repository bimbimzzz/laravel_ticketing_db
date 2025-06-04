<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //protected fillable = ['name'];
    protected $fillable = [
        'name',
        'description',
        'phone',
        'email',
        'city',
        'verify_status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //events
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
