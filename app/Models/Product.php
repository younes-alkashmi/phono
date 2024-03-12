<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'price',
        'battery',
        "brand",
        "proximity",
        "screen_size",
        "front_cam",
        "rear_cam",
        "rear_cam_no",
        "storage",
        "weight",
        "charger",
        "dimension",
        "resolution",
        "processor",
    ];


    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function rates(){
        return $this->hasMany(Rate::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
