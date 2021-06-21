<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaPdf extends Model
{
    protected $table = 'lista_pdf';
    protected $primaryKey = 'id';
    protected $fillable = ['codigo_propiedad','usuario_id'];
}
