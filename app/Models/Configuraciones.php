<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Configuraciones extends Authenticatable
{
    protected $table = 'configuraciones';
    protected $fillable = [
        'propiedad_principal',
        'capsula',
        'texto',
        'titulo'
    ];

}
