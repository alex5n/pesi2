<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Empresa;
use App\Proceso;
use App\Subproceso;
use App\Usuario;
use App\Audit;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    CONST PAGINACION=10;
    CONST PAGINACION2=10;
    CONST valor=1;

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $empresa=Empresa::findOrFail($id);
        return view('proceso.create',compact('empresa'));
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
            'descripcion.required' => 'Ingrese proceso'
        ]);
        $proceso = new Proceso();
        $proceso->ruc=$id;
        $proceso->descripcion=$request->descripcion;
        $proceso->estado=1;
        $proceso->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('proceso.show', ['id' => $id, 'valor' => $this::valor])->with('datos','Proceso agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $valor)
    {
        if (strcmp($id,"ninguno") === 0) {
            return redirect()->route('empresa.index')->with('datos','Elija una empresa para trabajar');
        }
        $buscarpor1=$request->get('buscarpor1');
        $buscarpor2=$request->get('buscarpor2');
        $empresa=Empresa::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$id)->where('estado','=','1')->where('descripcion','like','%'.$buscarpor1.'%')->paginate($this::PAGINACION);
        $subproceso=Subproceso::where('ruc','=',$id)->where('descripcion','like','%'.$buscarpor2.'%')->paginate($this::PAGINACION2);
        if (isset($_REQUEST['buscar1'])) {
            $valor=1;
        } else if (isset($_REQUEST['buscar2'])){
            $valor=2;
        }
        return view('proceso.index',compact('empresa','proceso','subproceso','buscarpor1','buscarpor2','valor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proceso=Proceso::findOrFail($id);
        return view('proceso.edit',compact('proceso'));
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
            'descripcion.required' => 'Ingrese proceso'
        ]);
        $proceso=Proceso::findOrFail($id);
        $proceso->descripcion=$request->descripcion;
        $proceso->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('proceso.show', ['id' => $proceso->ruc, 'valor' => $this::valor])->with('datos','Proceso Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idusuario)
    {
        $proceso=Proceso::findOrFail($id);
        $proceso->estado='0';
        $proceso->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('proceso.show', ['id' => $proceso->ruc, 'valor' => $this::valor])->with('datos','Proceso Eliminado...!');
    }

    public function confirmar($id)
    {
        $proceso=Proceso::findOrFail($id);
        return view('proceso.confirmar',compact('proceso'));
    }

    public function general($id)
    {
        $empresa=Empresa::findOrFail($id);
        $proceso=Proceso::where('ruc','=',$id)->distinct()->where('estado','=','1')->get();
        $subproceso=Subproceso::where('ruc','=',$id)->get();
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
        return view('proceso.general',compact('empresa','proceso','subproceso','array'));
    }
}
