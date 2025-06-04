<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //events fillable
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'image',
        'event_category_id',
        'vendor_id',
    ];

    //vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    //event_category
    public function event_category()
    {
        return $this->belongsTo(EventCategory::class);
    }

    //skus
    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
