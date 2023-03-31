<?php

namespace Src\Application\Role\Infrastructure\Repositories\Elocuent;

use Illuminate\Database\Eloquent\Model;
use Src\Management\Login\Infrastructure\Repositories\Elocuent\User;

final class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}