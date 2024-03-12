<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
        protected $fillable = [
        'item_id',
        'quantity',
    ];
    public  function order()
    {
        $this->belongsTo(Order::class);
    }
}
