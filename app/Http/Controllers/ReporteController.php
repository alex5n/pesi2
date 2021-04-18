<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Usuario;
use App\Empresa;
use App\Proceso;
use App\Subproceso;
use App\Organizacion;
use App\DetalleProceso;
use App\Responsabilidad;


class ReporteController extends Controller
{
    CONST PAGINATION=15;
    
    public function informe1($id)
    {
        if (strcmp($id,"ninguno") === 0) {
            return redirect()->route('empresa.index')->with('datos','Elija una empresa para trabajar');
        }
        $empresa=Empresa::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$id)->distinct()->where('estado','=','1')->get();
        $subproceso=Subproceso::where('ruc','=',$id)->get();
        $subprocesoNA[] = new Subproceso();
        $j=0;
        foreach ($subproceso as $item) {
            $detalle=DetalleProceso::where('idsubproceso','=',$item->idsubproceso)->get();
            $i=0;
            foreach ($detalle as $item2) {
                if ($item2->idresponsabilidad != 4) {
                    $i=$i+1;
                }
            }
            if ($i == 0) {
                $subprocesoNA[$j]=$item;
                $j=$j+1;
            }
        }
        $valor=$j;
        return view('reporte.informe1',compact('empresa','proceso','subproceso','subprocesoNA','valor'));
    }

    public function informe2($id)
    {
        if (strcmp($id,"ninguno") === 0) {
            return redirect()->route('empresa.index')->with('datos','Elija una empresa para trabajar');
        }
        $empresa=Empresa::findOrFail($id);
        $area=Organizacion::where('ruc','=',$id)->orderBy('idarea')->get();
        $areaNA[] = new Organizacion();
        $j=0;
        $valor=null;
        foreach ($area as $item) {
            $detalle=DetalleProceso::where('idarea','=',$item->idarea)->get();
            $i=0;
            foreach ($detalle as $item2) {
                if ($item2->idresponsabilidad != 4) {
                    $i++;
                }
            }
            if ($i == 0) {
                $areaNA[$j]=$item;
                $j++;
            }
        }
        $valor=$j;
        //return view('subproceso.prueba',compact('empresa','areaNA','valor'));
        return view('reporte.informe2',compact('empresa','areaNA','valor'));
    }

    public function informe3($id)
    {
        if (strcmp($id,"ninguno") === 0) {
            return redirect()->route('empresa.index')->with('datos','Elija una empresa para trabajar');
        }
        $empresa=Empresa::findOrFail($id);
        $subproceso=Subproceso::where('ruc','=',$id)->get();
        $area=Organizacion::where('ruc','=',$id)->orderBy('idarea')->get();
        $subprocesoNA[] = new Subproceso();
        $array = array();
        $j=0;
        foreach ($area as $item) {
            $detalle=DetalleProceso::where('idarea','=',$item->idarea)->get();
            $i=0;
            foreach ($detalle as $item2) {
                if ($item2->idresponsabilidad == 4) {
                    $subprocesoNA[$j]=Subproceso::findOrFail($item2->idsubproceso);
                    $i++;
                    $j++;
                }
            }
            /*if ($i==0) {
                $i=1;
            }*/
            $array[] = $i;
        }
        return view('reporte.informe3',compact('empresa','subproceso','subprocesoNA','area','array'));
    }

    public function matriz($id)
    {
        if (strcmp($id,"ninguno") === 0) {
            return redirect()->route('empresa.index')->with('datos','Elija una empresa para trabajar');
        }
        $empresa=Empresa::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$id)->distinct()->where('estado','=','1')->orderBy('idproceso')->get();
        $subproceso=Subproceso::where('ruc','=',$id)->orderBy('idproceso')->get();
        $area=Organizacion::where('ruc','=',$id)->orderBy('idarea')->get();
        $detalle[] = new DetalleProceso();
        $j=0;
        foreach ($subproceso as $item) {
            $temp=DetalleProceso::where('idsubproceso','=',$item->idsubproceso)->orderBy('idarea')->get();
            foreach ($temp as $item2) {
                $detalle[$j]=$item2;
                $j++;
            }
        }
        $array=array();
        foreach ($proceso as $item) {
            $i=0;
            foreach ($subproceso as $item2) {
                if ($item2->idproceso==$item->idproceso) {
                    $i=$i+1;
                }
            }
            if ($i==0) {
                $i=1;
            }
            $array[]=$i;
        }
        $cantidad = DB::table('organizacion')->where('ruc','=',$id)->count();
        //return view('subproceso.prueba',compact('empresa','proceso','subproceso','area','detalle','cantidad','array'));
        return view('reporte.matriz',compact('empresa','proceso','subproceso','area','detalle','cantidad','array'));
    }

    public function auditoria()
    {
        //$auditoria = DB::table('audits')->latest()->get();
        $auditoria = DB::table('audits')->latest()->paginate();
        $usuario=Usuario::findOrFail($auditoria[0]->user_id);
        return view('reporte.auditoria',compact('auditoria','usuario'));
    }
}