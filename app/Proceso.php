<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Proceso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table="proceso";
    protected $primaryKey='idproceso';
    public $timestamps=false;

    protected $fillable=[
        'descripcion','estado','ruc'
    ];

    public function RUC(){
        return $this->hasOne('App\Empresa','ruc','ruc');
    }
}
