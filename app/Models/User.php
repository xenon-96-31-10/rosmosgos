<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRolesAndPermissions;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    public function orders()
    {
      return $this->hasMany(Order::class);
    }

    public function bio()
    {
       return $this->hasOne(Bio::class);
    }

    public function kiorders()
    {
      return $this->hasMany(Execution::class, 'ki_id')->orderBy('created_at', 'desc');
    }




}
