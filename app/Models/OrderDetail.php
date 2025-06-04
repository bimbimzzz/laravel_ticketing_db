<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //fillable
    protected $fillable = [
        'order_id',
        'ticket_id',
    ];

    //order_id foreign key table orders
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //ticket_id foreign key table tickets
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
