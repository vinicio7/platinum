<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{   protected $table = 'users';
    protected $primaryKey= 'user_id';
    protected $fillable = [
        'rol_id',
        'name',
        'username',
        'password',
        'email',
        'phone',
        'adress',
        'gender',
        'document_id',
        'birthdate',
        'marital_status',
        'title',
        'facebook',
        'twitter',
        'whatsapp',
        'instagram',
        'pinterest',
        'youtube',
        'linkedin',
        'picture',
        'api_token',
        'status',
        'agente'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol()
    {
        return $this->hasOne(Rol::class, 'rol_id', 'rol_id');
    }
}
