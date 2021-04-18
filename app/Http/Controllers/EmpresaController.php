<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Empresa;
use App\Elemento;
use App\Estrategia;
use App\Detalle;
use App\Usuario;
use App\Audit;

class EmpresaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa=Empresa::all()->where('estado','=','1');
        return view('empresa.listempresa',compact('empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.regempresa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idusuario)
    {
        $data=request()->validate([
            'nombre'=>'required',
            'RUC'=>['required','size:11'],
            'direccion' => 'required'
        ],
        [
            'nombre.required'=>'Ingrese nombre de la empresa',
            'RUC.required'=>'Ingrese RUC',
            'RUC.size'=>'Ingrese RUC completo',
            'direccion.required'=>'Ingrese Direccion'            
        ]);
        $empresa = new Empresa();
        $empresa->RUC=$request->RUC;
        $empresa->nombre=$request->nombre;
        $empresa->direccion=$request->direccion;
        $empresa->estado=1;
        $empresa->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('empresa.index')->with('datos','Registro Nuevo Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa=Empresa::findOrFail($id);
        return view('empresa.edit',compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $userid)
    {
        $data=request()->validate([
            'nombre'=>'required',
            'RUC'=>['required','size:11'],
            'direccion' => 'required'
        ],
        [
            'nombre.required'=>'Ingrese nombre de la empresa',
            'RUC.required'=>'Ingrese RUC',
            'RUC.size'=>'Ingrese RUC completo',
            'direccion.required'=>'Ingrese Direccion'            
        ]);
        $empresa=Empresa::findOrFail($id);
        $empresa->RUC=$request->RUC;
        $empresa->nombre=$request->nombre;
        $empresa->direccion=$request->direccion;
        $empresa->save();
        $usuario=Usuario::findOrFail($userid);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('empresa.index')->with('datos','Registro Actualizado');
    }

    public function confirmar($id)
    {
        $empresa=Empresa::findOrFail($id);
        return view('empresa.confirmar',compact('empresa'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idusuario)
    {
        $empresa=Empresa::findOrFail($id);
        $empresa->estado='0';
        $empresa->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('empresa.index')->with('datos','Registro Eliminado...!');
    }
}
