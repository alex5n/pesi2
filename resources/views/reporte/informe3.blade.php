@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container" style="min-height: 800px;">
    <p class="text-center fs-2 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <p class="fs-4 fw-bold">AREAS SIN PROCESO ASIGNADOS</p>
    <style>
        thead{
            background-color: rgb(24, 11, 100);
            color: aliceblue;
        }
        tbody{
            background-color: rgb(140, 204, 247);
        }
        section{
            background-color: white;
        }
    </style>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" class="text-center fs-4" style="width: 50%;">AREA</th>
            <th scope="col" class="text-center fs-4" style="width: 50%;">SUBPROCESOS</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
            $k=0;
            $expand;
          @endphp
          @foreach($area as $item)
          @php
              $j=0;
              if ($array[$i] == 0) {
                $expand=1;
              }
              else {
                $expand=$array[$i];
              }
          @endphp
          <tr>
            <td rowspan="{{$expand}}" class="text-center align-middle fs-4 fw-bolder text-uppercase">{{$item->descripcion}}</td>
              @for($l = 0; $l < $array[$i]; $l++)
                @if ($j==0)
                  <td class="fst-normal text-break fs-6">{{$subprocesoNA[$k]->descripcion}}</td>
                  </tr>
                  @php
                    $j=1;
                  @endphp
                @else
                  <tr>
                    <td class="fst-normal text-break fs-6">{{$subprocesoNA[$k]->descripcion}}</td>
                  </tr>
                @endif
                @php
                  $k++;
                @endphp
              @endfor
            @if($j==0)
                <td></td></tr>
            @endif
            @php
              $i++;
            @endphp
          @endforeach
        </tbody>
    </table>
</div>
@endsection