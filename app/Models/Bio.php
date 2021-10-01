<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'familia',
        'name',
        'lastname',
        'data_id',
        'data_type',
    ];

    public function user()
     {
       return $this->belongsTo(User::class);
     }

     public function data()
     {
       return $this->morphTo();
     }
}
