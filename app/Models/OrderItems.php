<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price','product_name'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
    public function order()
{
    return $this->belongsTo(Orders::class, 'order_id'); // Ensure correct foreign key reference
}
}
