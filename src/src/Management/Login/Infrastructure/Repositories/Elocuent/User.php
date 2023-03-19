<?php

namespace Src\Management\Login\Infrastructure\Repositories\Elocuent;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table    = 'users';
    protected $fillable = ['last_name', 'first_name', 'email', 'celphone', 'password', 'state_id', 'created_at', 'updated_at'];
    protected $hidden   = ['password'];
}