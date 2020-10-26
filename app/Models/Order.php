<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at', 'updated_at',
    ];

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_detail_id');
    }
}
