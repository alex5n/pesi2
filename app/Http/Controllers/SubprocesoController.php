<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Empresa;
use App\Proceso;
use App\Subproceso;
use App\Organizacion;
use App\DetalleProceso;
use App\Usuario;
use App\Audit;

class SubprocesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    CONST valor=2;
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $empresa=Empresa::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$id)->where('estado','=','1')->get();
        return view('subproceso.create',compact('empresa','proceso'));
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
            'descripcion.required' => 'Ingrese subproceso'
        ]);
        $subproceso = new Subproceso();
        $subproceso->ruc=$id;
        $subproceso->descripcion=$request->descripcion;
        $subproceso->idproceso=$request->get('proceso');
        $subproceso->save();
        $organizacion=Organizacion::where('ruc','=',$id)->get();
        if (isset($organizacion)) {
            foreach ($organizacion as $item) {
                $detalle = new DetalleProceso();
                $detalle->idsubproceso=$subproceso->idsubproceso;
                $detalle->idarea=$item->idarea;
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
        return redirect()->route('proceso.show', ['id' => $id, 'valor' => $this::valor])->with('datoss','Subroceso agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subproceso=Subproceso::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$subproceso->ruc)->get();
        return view('subproceso.edit',compact('subproceso','proceso'));
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
            'descripcion.required' => 'Ingrese subproceso'
        ]);
        $subproceso=Subproceso::findOrFail($id);
        $subproceso->idproceso=$request->get('proceso');
        $subproceso->descripcion=$request->descripcion;
        $subproceso->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('proceso.show', ['id' => $subproceso->ruc, 'valor' => $this::valor])->with('datoss','Subproceso Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idusuario)
    {
        $subproceso=Subproceso::findOrFail($id);
        $subproceso->delete();
        DB::table('participacion')->where('idsubproceso','=',$id)->delete();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('proceso.show', ['id' => $subproceso->ruc, 'valor' => $this::valor])->with('datoss','SubProceso Eliminado...!');
    }

    public function confirmar($id)
    {
        $subproceso=Subproceso::findOrFail($id);
        return view('subproceso.confirmar',compact('subproceso'));
    }
}
