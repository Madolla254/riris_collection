<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status', 'phone_number', 'address', 'email'];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
