<?php

namespace App\Models;

use Database\Factories\Category1Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category1 extends Model
{
    /** @use HasFactory<Category1Factory> */
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product1::class, 'category_id');
    }
}
