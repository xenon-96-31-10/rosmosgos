<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rosreestrinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'typeobj',
        'cadnomer',
        'adres',
        'statusobj',
        'datepostuch',
        'catzemly',
        'razreshisp',
        'area',
        'areacod',
        'cadastrcost',
        'dateoprcost',
        'datevnescost',
        'dateutvercost',
        'dateupdateinf',
        'formsobstv',
        'numberhoz',
        'ki',
        'coordinata1',
        'coordinata2',
    ];

    public function order()
     {
       return $this->belongsTo(Order::class);
     }
}
