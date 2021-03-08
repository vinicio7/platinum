<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Bank extends Model
{
	use LaravelVueDatatableTrait;
    protected $table = 'banks';
    public $primaryKey = 'bank_id';
	protected $fillable = ['name','account','status'];

	protected $dataTableColumns = [
        'bank_id' => [
            'searchable' => true,
        ],
        'name' => [
            'searchable' => true,
        ],
        'account' => [
            'searchable' => true,
        ],
        'status' => [
            'searchable' => true,
        ],
    ];
}
