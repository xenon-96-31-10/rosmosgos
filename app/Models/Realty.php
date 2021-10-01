<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realty extends Model
{
    use HasFactory;

    protected $fillable = [
        'services',
        'dateki',
        'adresdostavki',
    ];

    public function order()
    {
      return $this->morphMany(Order::class, 'data');
    } 
}
