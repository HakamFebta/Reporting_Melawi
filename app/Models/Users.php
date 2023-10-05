<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Users extends Authenticatable
{
    use HasFactory;

    protected $table = 'Users';
    protected $fillable = [
        'id_user',
        'username',
        'password',
    ];
    protected $primaryKey = 'id_user';
    protected $connection = 'sqlsrv';
}
