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
    background-color: rgb(4, 90, 18);
    color: whitesmoke;
  }
  tbody{
    background-color: rgb(191, 238, 172);
  }
</style>
<div class="container" style="min-height: 800px;">
    <p class="text-center fs-2 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <p class="fs-4 fw-bold">PROCESOS SIN AREAS RESPONSABLES</p>
    
    @if($valor != 0)
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 50%;">PROCESOS</th>
            <th scope="col" class="text-center" style="width: 50%;">SUBPROCESOS</th>
          </tr>
        </thead>
        <tbody>
          @foreach($subprocesoNA as $item)
            <tr>
              <td class="text-break align-middle">{{$item->IdProceso->descripcion}}</td>
              <td class="text-break">{{$item->descripcion}}</td>
            </tr>
          @endforeach  
        </tbody>
      </table>
    @else
      <p>Todos los subprocesos han sido asignados a algún area de la empresa</p>
    @endif
</div>
@endsection