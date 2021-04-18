<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Organizacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table="organizacion";
    protected $primaryKey='idarea';
    public $timestamps=false;

    protected $fillable=[
        'descripcion','ruc',
    ];

    public function RUC(){
        return $this->hasOne('App\Empresa','ruc','ruc');
    }
}
