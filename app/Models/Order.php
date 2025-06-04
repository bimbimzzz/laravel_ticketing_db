<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //fillable
    protected $fillable = [
        'user_id',
        'event_id',
        'quantity',
        'total_price',
        'event_date',
        'status_payment',
        'payment_url',
    ];

    //user_id foreign key table users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //event_id foreign key table events
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    //sku_id foreign key table skus
    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}
