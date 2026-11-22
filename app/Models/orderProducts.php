<?php

namespace App\Models;

use Database\Factories\OrderProductsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderProducts extends Model
{
    /** @use HasFactory<OrderProductsFactory> */
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product1::class);
    }
}
