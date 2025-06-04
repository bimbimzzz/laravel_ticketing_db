<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    //fillable sku
    protected $fillable = [
        'name',
        'price',
        'event_id',
        'categories',
        'stock',
        'day_type',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    //tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
