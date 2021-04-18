<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use App\Audit;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data=request()->validate([
            'name'=>'required',
            'password'=>'required'
        ],
        [
            'name.required'=>'Ingrese Usuario',
            'password.required'=>'Ingrese Contraseña'
        ]);
        $name=$request->name;
        $usuario=Usuario::where('usuario','=',$name)->get();
        $user=$usuario[0];
        if ($usuario->count() != 0) {
            $hashp=$usuario[0]->contraseña;
            $password=$request->password;
            if (strcmp($password,$hashp) === 0) {
                return view('bienvenido', compact('user'));
            } else {
                return back()->withErrors(['password' => 'Contraseña no valida'])->withInput([request('password')]);
            }
        } else {
            return back()->withErrors(['name' => 'Usuario no valido'])->withInput([request('name')]);
        }
    }

    public function index()
    {
        /*return view('usuario.useregister');*/
        //return view('usuario.registraruser');
        $usuarios=Usuario::all()->where('estado','=','1');
        return view('usuario.listuser', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.registraruser');
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
            'full_name'=>'required',
            'usuario'=>['required','unique:usuario,usuario'],
            'contraseña' => ['required','min:8']
        ],
        [
            'full_name.required'=>'Ingrese Nombres',
            'usuario.required'=>'Ingrese Usuario',
            'contraseña.required'=>'Ingrese Contraseña',
            'contraseña.min'=>'Ingrese 8 caracteres como mínimo',
            'usuario.unique'=>'El usuario ya existe'
        ]);
        $usuario = new Usuario();
        $usuario->fullname=$request->full_name;
        $usuario->usuario=$request->usuario;
        $usuario->contraseña=$request->contraseña;
        if ($request['flexRadioDefault']=='usuario') {
            $usuario->permiso=0;
        }
        else {
            $usuario->permiso=1;
        }
        $usuario->estado=1;
        $usuario->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('usuario.index')->with('datos','Registro Nuevo Guardado');
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
        $usuario=Usuario::findOrFail($id);
        return view('usuario.edit',compact('usuario'));
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
            'fullname'=>'required',
            'contraseña' => ['required','min:8']
        ],
        [
            'fullname.required'=>'Ingrese sus nombres',
            'contraseña.required'=>'contraseña',
            'contraseña.min'=>'Ingrese 8 caracteres como mínimo'
        ]);
        $usuario=Usuario::findOrFail($id);
        $usuario->fullname=$request->fullname;
        $usuario->contraseña=$request->contraseña;
        if ($request['flexRadioDefault']=='usuario') {
            $usuario->permiso=0;
        }
        else {
            $usuario->permiso=1;
        }
        $usuario->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('usuario.index')->with('datos','Registro Actualizado');
    }

    public function confirmar($id)
    {
        $usuario=Usuario::findOrFail($id);
        return view('usuario.confirmar',compact('usuario'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idusuario)
    {
        $usuario=Usuario::findOrFail($id);
        $usuario->estado='0';
        $usuario->save();
        $usuario=Usuario::findOrFail($idusuario);
        $auditorias = DB::table('audits')->where('user_id','=',null)->get();
        foreach ($auditorias as $item) {
            $auditoria=Audit::findOrFail($item->id);
            $auditoria->user_id=$usuario->idusuario;
            $auditoria->user_type="App\Usuario";
            $auditoria->save();
        }
        return redirect()->route('usuario.index')->with('datos','Registro Eliminado...!');
    }
}
