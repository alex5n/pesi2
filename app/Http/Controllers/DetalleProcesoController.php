<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Proceso;
use App\Subproceso;
use App\Organizacion;
use App\DetalleProceso;
use App\Responsabilidad;

class DetalleProcesoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $subproceso=Subproceso::where('ruc','=',$id)->where('descripcion','like','%'.$buscarpor.'%')->paginate($this::PAGINACION);
        return view('matrizproceso.index',compact('empresa','subproceso','buscarpor'));
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
        $empresa=Empresa::findOrFail($subproceso->ruc);
        $area=Organizacion::where('ruc','=',$subproceso->ruc)->orderBy('idarea')->get();
        $detalle=DetalleProceso::where('idsubproceso','=',$subproceso->idsubproceso)->orderBy('idarea')->get();
        $responsabilidad=Responsabilidad::all();
        return view('matrizproceso.detalle',compact('subproceso','empresa','area','responsabilidad','detalle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subproceso=Subproceso::findOrFail($id);
        $area=Organizacion::where('ruc','=',$subproceso->ruc)->orderBy('idarea')->get();
        $detalle=DetalleProceso::where('idsubproceso','=',$subproceso->idsubproceso)->orderBy('idarea')->get();
        $select=$request->get('responsabilidad');
        $i=0;
        foreach ($detalle as $item) {
            $participacion=DetalleProceso::findOrFail($item->idparticipacion);
            $participacion->idresponsabilidad=$select[$i];
            $i=$i+1;
            $participacion->save();
        }
        return redirect()->route('detalleproceso.show', $subproceso->ruc)->with('datos','Registros Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
