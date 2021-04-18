@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<style> 
  section{
    background-color: white;
  }
  thead{
    background-color: rgb(25, 112, 47);
    color: white;
  }
  tbody{
    background-color: rgb(68, 58, 25);
    color: white;
  }
</style>
<div class="container">
  <p class="text-center fs-3 fw-bolder">AUDITORIA</p>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" class="text-center" style="width: 10px;">N°</th>
        <th scope="col" class="text-center">Usuario</th>
        <th scope="col" class="text-center">Direccion IP</th>
        <th scope="col" class="text-center">Tipo</th>
        <th scope="col" class="text-center">Tabla</th>
        <th scope="col" class="text-center">Clave</th>
        <th scope="col" class="text-center">Fecha</th>
      </tr>
    </thead>
    <tbody>
      @php
        $int=1;
      @endphp
      @foreach($auditoria as $item)
      <tr>
        <th class="align-middle text-center" scope="row">{{$int}}</th>
        <td class="align-middle">{{$usuario->usuario}}</td>
        <td class="align-middle">{{$item->ip_address}}</td>
        <td class="align-middle">{{$item->event}}</td>
        @php
          if (strcmp($item->auditable_type,'App\Empresa') === 0) {
            $tabla='Empresa';
          } elseif (strcmp($item->auditable_type,'App\Organizacion') === 0) {
            $tabla='Organización';
          } elseif (strcmp($item->auditable_type,'App\Proceso') === 0) {
            $tabla='Proceso';
          } elseif (strcmp($item->auditable_type,'App\Subproceso') === 0) {
            $tabla='Subproceso';
          } else {
            $tabla='Usuario';
          }
        @endphp
        <td class="align-middle">{{$tabla}}</td>
        <td class="align-middle">{{$item->auditable_id}}</td>
        <td class="align-middle">{{$item->created_at}}</td>
      </tr>
      @php
        $int=$int+1;
      @endphp
      @endforeach
    </tbody>
  </table>
  {{$auditoria->links()}}
</div>
@endsection