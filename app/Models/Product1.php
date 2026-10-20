<?php

namespace App\Models;

use Database\Factories\Product1Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product1 extends Model
{
    /** @use HasFactory<Product1Factory> */
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category1::class, 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
