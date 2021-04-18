@extends('layout.plantilla')
@section('contenido')
@php
  session_start();
@endphp
<div class="container">
    <h1>Editar Usuario</h1>
    <form method="POST" action="{{ route('usuario.update', ['id' => $usuario->idusuario, 'idusuario' => $_SESSION['usuario_id']])}}">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="fullname">Nombre completo: </label>
        <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" value="{{$usuario->fullname}}" name="fullname">
        @error('fullname')
            <span class="invalid-feedback" role="alert">
              <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="usuario">usuario: </label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="{{$usuario->usuario}}" disabled>
    </div>
    <div class="form-group">
        <label for="contraseña">Contraseña: </label>
        <input type="password" class="form-control @error('contraseña') is-invalid @enderror" id="contraseña" value="{{$usuario->contraseña}}" name="contraseña">
        @error('contraseña')
            <span class="invalid-feedback" role="alert">
              <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>
    <label for="inputPassword5" class="form-label">Permiso</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" value='usuario' 
        @if ($usuario->permiso==0)
            checked>
        @else
            >
        @endif
        <label class="form-check-label" for="flexRadioDefault2">
            Usuario
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" value="administrador"
        @if ($usuario->permiso==1)
            checked>
        @else
            >
        @endif
        <label class="form-check-label" for="flexRadioDefault1">
            Administrador
        </label>
    </div>           
    <button type="submit" class="btn btn-primary">Grabar</button>
    <a href="{{route('cancelarusuario')}}" class="btn btn-danger" ><i class="fas fa-ban"> </i>Cancelar</a>
    </form>
</div>

@endsection