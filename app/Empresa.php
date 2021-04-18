<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Empresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table="empresa";
    protected $primaryKey='ruc';
    public $timestamps=false;

    protected $fillable=[
        'nombre','dirección','estado'
    ];
}
