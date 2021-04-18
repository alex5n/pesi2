<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleProceso extends Model
{
    protected $table="participacion";
    protected $primaryKey='idparticipacion';
    public $timestamps=false;
    protected $fillable=[
        'idsubproceso','idarea','idresponsabilidad'
    ];

    public function idSubproceso(){
        return $this->hasOne('App\Subproceso','idsubproceso','idsubproceso');
    }

    public function idArea(){
        return $this->hasOne('App\Organizacion','idarea','idarea');
    }
}
