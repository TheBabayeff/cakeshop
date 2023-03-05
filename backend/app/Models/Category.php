<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements HasMedia
{
    use HasFactory, Filterable , InteractsWithMedia, SoftDeletes;

    protected $with = ['media'];

    protected $fillable = ['name', 'description'];

    protected $appends = ['primaryMediaUrl'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('primary')
            ->singleFile();
    }

    public function getPrimaryMediaUrlAttribute()
    {
        return $this->getFirstMediaUrl('primary') ?? null;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
