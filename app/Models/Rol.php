<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Rol extends Model
{
	use LaravelVueDatatableTrait;
    protected $table = 'roles';
    public $primaryKey = 'rol_id';
	protected $fillable = ['name','dashboard','propierties','departaments','municipality','regions','user','status','zones','banks','history','rols'];

	protected $dataTableColumns = [
        'name' => [
            'searchable' => true,
        ],
        'dashboard' => [
            'searchable' => false,
        ],
        'propierties' => [
            'searchable' => false,
        ],
        'departaments' => [
            'searchable' => false,
        ],
        'municipality' => [
            'searchable' => false,
        ],
        'regions' => [
            'searchable' => false,
        ],
        'user' => [
            'searchable' => false,
        ],
        'status' => [
            'searchable' => false,
        ],
        'zones' => [
            'searchable' => false,
        ],
        'banks' => [
            'searchable' => false,
        ],
        'history' => [
            'searchable' => false,
        ],
        'rols' => [
            'searchable' => false,
        ],
    ];
}
