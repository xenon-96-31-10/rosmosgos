<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biopas extends Model
{
    use HasFactory;

    protected $fillable = [
        'snils',
        'pass',
        'codepass',
        'kemmpass',
        'datepass',
        'datebirth',
        'scanpass',
    ];

    public function bio()
     {
       return $this->morphMany(Bio::class, 'data');
     }
}
