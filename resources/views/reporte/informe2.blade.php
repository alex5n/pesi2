@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container" style="min-height: 800px;">
    <p class="text-center fs-2 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <p class="fs-4 fw-bold">AREAS SIN PROCESOS RESPONSABLES</p>
    <style>
        thead{
            background-color: rgb(119, 96, 19);
            color: aliceblue;
        }
        tbody{
            background-color: rgb(248, 220, 183);
        }
        section{
            background-color: white;
        }
    </style>
    @if($valor != 0)
      <table class="table table-bordered">
        @php
          $i=1;
        @endphp
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 10px;">N°</th>
            <th scope="col" class="text-center" >AREA</th>
          </tr>
        </thead>
        <tbody>
          @foreach($areaNA as $item)
            <tr>
                <td class="text-break align-middle text-center">{{$i}}</td>
                <td class="text-break text-uppercase">{{$item->descripcion}}</td>
            </tr>
            @php
              $i++;
            @endphp
          @endforeach
        </tbody>
      </table>
    @else
      <p>Todas las áreas han sido asignadas a algún proceso</p>
    @endif
</div>
@endsection