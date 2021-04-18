<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Empresa;
use App\Organizacion;
use App\DetalleProceso;
use App\Subproceso;
use App\Usuario;
use App\Audit;

class OrganizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    CONST PAGINACION=10;

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organizacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $idusuario)
    {
        $data=request()->validate([
            'descripcion' => 'required'
        ],
        [
            'descripcion.required' => 'Ingrese area o puesto'
        ]);
        $organizacion = new Organizacion();
        $organizacion->ruc=$id;
        $organizacion->descripcion=$request->descripcion;
        $organizacion->save();
        $subprocesos=Subproceso::where('ruc','=',$id)->get();
        if (isset($subprocesos)) {
            foreach ($subprocesos as $item) {
                $detalle = new DetalleProceso();
                $detalle->idsubproceso=$item->idsubproceso;
                $detalle->idarea=$organizacion->idarea;
                $detalle->idresponsabilidad=4;
                $detalle->save();
            }
        }
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('organizacion.show', $id)->with('datos','Dato guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (strcmp($id,"ninguno") === 0) {
            return redirect()->route('empresa.index')->with('datos','Elija una empresa para trabajar');
        }
        $buscarpor=$request->get('buscarpor');
        $empresa=Empresa::findOrFail($id);
        $organizacion=Organizacion::where('ruc','=',$id)->where('descripcion','like','%'.$buscarpor.'%')->paginate($this::PAGINACION);
        return view('organizacion.index',compact('empresa','organizacion','buscarpor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organizacion=Organizacion::findOrFail($id);
        return view('organizacion.edit',compact('organizacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idusuario)
    {
        $data=request()->validate([
            'descripcion' => 'required'
        ],
        [
            'descripcion.required' => 'Ingrese un area o puesto'
        ]);
        $organizacion=Organizacion::findOrFail($id);
        $organizacion->descripcion=$request->descripcion;
        $organizacion->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('organizacion.show', $organizacion->ruc)->with('datos','Proceso Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizacion=Organizacion::findOrFail($id);
        DB::table('organizacion')->where('idarea','=',$id)->delete();
        DB::table('participacion')->where('idarea','=',$id)->delete();
        return redirect()->route('organizacion.show', $organizacion->ruc)->with('datos','Registro Eliminado...!');
    }

    public function confirmar($id)
    {
        $organizacion=Organizacion::findOrFail($id);
        return view('organizacion.confirmar',compact('organizacion'));
    }
}
