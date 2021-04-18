<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Subproceso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table="subproceso";
    protected $primaryKey='idsubproceso';
    public $timestamps=false;

    protected $fillable=[
        'idproceso','descripcion','estado'
    ];

    public function IdProceso(){
        return $this->hasOne('App\Proceso','idproceso','idproceso');
    }
}
