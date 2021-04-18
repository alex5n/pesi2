@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container">
  <h1>Desea eliminar registro? {{$proceso->descripcion}}</h1>
  <form method="POST" action="{{ route('proceso.destroy', ['id' => $proceso->idproceso, 'idusuario' => $_SESSION['usuario_id']])}}">
    @method ('delete')
    @csrf
    <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
    <a href="{{route('cancelarproceso',$proceso->ruc)}}" class="btn btn-primary" ><i class="fas fa-times-circle"> </button></i>NO</a>
  </form>
</div>
@endsection