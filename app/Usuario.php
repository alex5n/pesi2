<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Usuario extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table="usuario";
    protected $primaryKey='idusuario';
    public $timestamps=false;
    protected $fillable = ['fullname', 'usuario', 'contraseña', 'permiso','estado'];
}
