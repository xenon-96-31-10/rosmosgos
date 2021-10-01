<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'text',
    ];

    public function order()
    {
      return $this->belongsTo(Order::class);
    }
}
