<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tallas extends Model
{
    use HasFactory;
    protected $table ='tallas';
    protected $fillable=['id','talla','stock'];
}
