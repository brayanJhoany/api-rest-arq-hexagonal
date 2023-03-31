<?php

namespace Src\Management\Login\Infrastructure\Repositories\Elocuent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Src\Application\Role\Infrastructure\Repositories\Elocuent\Role;

class User extends Model
{
    protected $table    = 'users';
    protected $fillable = ['last_name', 'first_name', 'email', 'celphone', 'password', 'state_id', 'created_at', 'updated_at'];
    protected $hidden   = ['password'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'rol_id');
    }
}