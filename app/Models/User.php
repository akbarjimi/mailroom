<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasTeams;

class User extends Model implements Authenticatable, Authorizable
{
    use HasFactory, \Illuminate\Auth\Authenticatable, \Illuminate\Foundation\Auth\Access\Authorizable;


    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name' , 'family',
    ];

    public function getFullNameAttribute()
    {
        return "$this->name $this->family";
    }
}
