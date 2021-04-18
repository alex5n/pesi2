<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsabilidad extends Model
{
    protected $table="responsabilidad";
    protected $primaryKey='idresponsabilidad';
    public $timestamps=false;
    protected $fillable=[
        'descripcion'
    ];
}
