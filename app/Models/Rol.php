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
	protected $fillable = ['name','dashboard','propierties','favorieties','reports','logs','user','status'];

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
        'favorieties' => [
            'searchable' => false,
        ],
        'reports' => [
            'searchable' => false,
        ],
        'logs' => [
            'searchable' => false,
        ],
        'user' => [
            'searchable' => false,
        ],
        'status' => [
            'searchable' => false,
        ],
    ];
}
