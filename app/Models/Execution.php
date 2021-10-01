<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'ki_id',
        'act',
        'data',
    ];

    public function ki()
   {
     return $this->belongsTo(User::class);
   }

   public function order()
   {
     return $this->belongsTo(Order::class);
   }

}
