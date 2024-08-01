<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estilos extends Model
{
    use HasFactory;
    protected $table ='estilos';
    protected $fillable=['id','nombre','descripcion'];
}
