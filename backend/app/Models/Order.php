<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Order extends Model implements HasMedia
{
    use HasFactory , SoftDeletes , InteractsWithMedia;
    protected $fillable = ['customer_id', 'beh', 'date', 'time', 'total', 'status', 'description'];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('order-photo');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
