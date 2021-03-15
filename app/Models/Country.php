<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $primaryKey = 'country_id';
	protected $fillable = ['name','status'];

    public function departaments(){
        return $this->hasMany(Departament::class, 'country_id');
     }
}