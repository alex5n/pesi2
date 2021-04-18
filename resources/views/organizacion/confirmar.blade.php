@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container">
  <h1>Desea eliminar registro? {{$organizacion->descripcion}}</h1>
  <form method="POST" action="{{ route('organizacion.destroy', ['id' => $organizacion->idarea, 'idusuario' => $_SESSION['usuario_id']])}}">
    @method ('delete')
    @csrf
    <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
    <a href="{{route('cancelarorganizacion',$_SESSION['ruc'])}}" class="btn btn-primary" ><i class="fas fa-times-circle"></button></i>NO</a>
  </form>
</div>
@endsection