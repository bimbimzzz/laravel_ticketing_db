<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //fillable
    protected $fillable = [
        'sku_id',
        'event_id',
        'ticket_code',
        'ticket_date',
        'status',
    ];

    //sku
    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    //event_id
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
