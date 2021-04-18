@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container" style="background-color: darkgreen; min-height: 800px;">
    <p class="text-center fs-2 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <p class="fs-4 fw-normal">PROCESOS Y SUBPROCESOS</p>
    <style>
        p{
            color: aliceblue;
        }
        td{
            color: aliceblue;
        }
        thead{
            background-color: brown;
            color: aliceblue;
        }
        tbody{
            background-color: rgb(158, 68, 26);
        }
        section{
            background-color: darkgreen;
        }
    </style>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 50%;">PROCESOS</th>
            <th scope="col" class="text-center" style="width: 50%;">SUBPROCESOS</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
            $j=0;
          @endphp
          @foreach($proceso as $item)
          @php
              $j=0;
          @endphp
          <tr>
            <td rowspan="{{$array[$i]}}" class="text-center align-middle fs-5">{{$item->descripcion}}</td>
            @foreach($subproceso as $item2)
                @if($item2->idproceso==$proceso[$i]->idproceso)
                    @if($j==0)
                        <td class="fst-normal text-break fs-6">{{$item2->descripcion}}</td>
                        </tr>
                        @php
                        $j=1;
                        @endphp
                    @else
                        <tr>
                            <td class="fst-normal text-break fs-6">{{$item2->descripcion}}</td>
                        </tr>
                    @endif
                @endif
            @endforeach
            @if($j==0)
                <td></td></tr>
            @endif
          @php
              $i=$i+1;
          @endphp  
          @endforeach
        </tbody>
    </table>
    <div class="d-grid gap-2 d-md-flex ms-4 bottom-0">
        <a class="btn btn-light" href="{{route('proceso.show',['id' => $empresa->ruc, 'valor' => 1])}}" role="button">Regresar</a>
    </div><br>
</div>
@endsection