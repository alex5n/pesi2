@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container">
  <h1>Desea eliminar registro? RUC : {{$empresa->ruc}} - EMPRESA : {{$empresa->nombre}}</h1>
  <form method="POST" action="{{ route('empresa.destroy', ['id' => $empresa->ruc, 'idusuario' => $_SESSION['usuario_id']])}}">
    @method ('delete')
    @csrf
    <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
    <a href="{{route('cancelarempresa')}}" class="btn btn-primary" ><i class="fas fa-times-circle"></button></i>NO</a>
  </form>
</div>
@endsection