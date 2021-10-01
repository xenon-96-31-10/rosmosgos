<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biocom extends Model
{
    use HasFactory;

    protected $fillable = [
        'inn',
        'bank',
        'bill',
        'numdov',
        'datedov',
        'scandov',
    ];

    public function bio()
     {
       return $this->morphMany(Bio::class, 'data');
     }
}
