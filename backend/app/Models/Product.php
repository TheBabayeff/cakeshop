<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasMedia
{
    use SoftDeletes, Filterable, HasFactory , InteractsWithMedia;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['category_id', 'name', 'code', 'description', 'price', ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ["imageUrl"];

    /**
     * Register the media collections
     *
     * @return void
     */
    public function registerMediaCollections(): void
{
    $this->addMediaCollection('product-photo')->singleFile();
}

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
{
    return $this->belongsTo(Category::class);
}

    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    /**
     * Determines one-to-many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function orderItems()
//{
//    return $this->hasMany(OrderItem::class);
//}

    /**
     * Get the sale price as formatted
     */
//    public function getPriceFormattedAttribute()
//{
//    $value = new Money(ceil($this->price), new Currency("BDT"), true);
//    return $value->formatWithoutZeroes();
//}

    /**
     * Get the image url
     */
    public function getImageUrlAttribute()
{
    return $this->getFirstMediaUrl('product-photo') ?? null;
}
}
