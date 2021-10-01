<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bioki extends Model
{
    use HasFactory;

    protected $fillable = [
        'sertificate',
        'region',
    ];

    public function bio()
     {
       return $this->morphMany(Bio::class, 'data');
     }
}
