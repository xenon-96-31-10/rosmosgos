<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    use HasFactory;

    protected $fillable = [
        'services',
        'datespec',
        'adresdostavki',
    ];

    public function order()
    {
      return $this->morphMany(Order::class, 'data');
    } 
}
