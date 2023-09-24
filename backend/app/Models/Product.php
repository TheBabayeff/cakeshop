<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Filterable, HasFactory;




    protected $fillable = ['category_id', 'name', 'code','preview_image','slug','product_images','original_filename', 'slug' ,'description', 'price', ];


    protected $casts = [
        'product_images' => 'array',
        'original_filename' => 'array',
    ];



    public function category()
        {
            return $this->belongsTo(Category::class);
        }



}
