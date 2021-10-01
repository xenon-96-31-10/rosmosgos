<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cost',
        'status',
        'sposobpay',
        'statuspay',
        'region',
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

     public function rosreestr()
     {
        return $this->hasOne(Rosreestrinfo::class);
     }

     public function ki()
     {
        return $this->hasOne(Execution::class);
     }

     public function quotes()
     {
       return $this->hasMany(Quote::class);
     }

     public function refuses()
     {
       return $this->hasMany(Refuse::class);
     }

     public function docs()
     {
       return $this->hasMany(Doc::class);
     }


}
