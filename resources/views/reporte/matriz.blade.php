@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<style>
    th {
        border: black 3px solid;
    }
    tr {
        border: black 3px solid;
    }
    td {
        border: black 3px solid;
    }
    tbody {
        border: black 3px solid;
    }
    section{
        background-color: white;
    }
</style>
<div class="container" style="min-height: 800px;">
    <p class="text-center fs-2 fw-bolder text-uppercase">PROCESOS VS ORGANIZACION ({{$empresa->nombre}})</p>
    <table class="table">
        <thead>
          <tr>
            <th colspan="2" rowspan="2" style="background-color: burlywood; width: 30%;"></th>
            <th colspan="{{$cantidad}}" class="text-center fw-normal" style="background-color: cornflowerblue; width: 70%;">ORGANIZACIÓN</th>
          </tr>
          <tr>
            @foreach($area as $item)
                <th class="text-center text-uppercase fw-normal text-center align-middle" style="background-color: rgba(52, 219, 219, 0.671); width: {{70.0/$cantidad}}%;">{{$item->descripcion}}</th>    
            @endforeach
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center fw-bolder" style="background-color: rgb(97, 182, 104)">PROCESOS</td>
            <td class="text-center fw-bolder" style="background-color: rgb(97, 182, 104)">SUBPROCESOS</td>
            @foreach($area as $item)
                <td style="background-color: rgb(97, 182, 104)"></td>    
            @endforeach
          </tr>

          @php
            $i=0;
            $j=0;
            $k=0;
          @endphp
          @foreach($proceso as $item)
          @php
              $j=0;
          @endphp
          <tr>
            <td rowspan="{{$array[$i]}}" class="text-center align-middle fs-5" style="background-color: chocolate">{{$item->descripcion}}</td>
            @foreach($subproceso as $item2)
                @if($item2->idproceso==$proceso[$i]->idproceso)
                    @if($j==0)
                        <td class="fst-normal text-break fs-6 align-middle" style="background-color: goldenrod">{{$item2->descripcion}}</td>
                        @for($a = 0; $a < $cantidad; $a++)
                        @if($detalle[$k]->idresponsabilidad == 1)
                            <td class="text-center fw-bolder align-middle">X</td>
                        @elseif ($detalle[$k]->idresponsabilidad == 2)
                            <td class="text-center fw-light align-middle">X</td>
                        @elseif($detalle[$k]->idresponsabilidad == 3)
                            <td class="text-center align-middle">/</td>
                        @else
                            <td></td>
                        @endif
                        @php
                            $k++;
                        @endphp
                        @endfor
                        </tr>
                        @php
                        $j=1;
                        @endphp
                    @else
                        <tr>
                            <td class="fst-normal text-break fs-6 align-middle" style="background-color: goldenrod">{{$item2->descripcion}}</td>
                            @for($a = 0; $a < $cantidad; $a++)
                            @if($detalle[$k]->idresponsabilidad == 1)
                                <td class="text-center fw-bolder align-middle">X</td>
                            @elseif ($detalle[$k]->idresponsabilidad == 2)
                                <td class="text-center fw-light align-middle">X</td>
                            @elseif($detalle[$k]->idresponsabilidad == 3)
                                <td class="text-center align-middle">/</td>
                            @else
                                <td></td>
                            @endif
                            @php
                                $k++;
                            @endphp
                            @endfor
                        </tr>
                    @endif
                    
                @endif
            @endforeach
            @if($j==0)
            <td style="background-color: goldenrod"></td>   
            @foreach($area as $item)
                <td></td>    
            @endforeach
            </tr>
            @endif
          @php
              $i=$i+1;
          @endphp  
          @endforeach
        </tbody>
    </table>
    <div>
        <a href="{{route('descargapdf',$_SESSION['ruc'])}}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> DESCARGAR PDF</a>
        <a href="{{route('descargaword',$_SESSION['ruc'])}}" class="btn btn-primary"><i class="fas fa-file-word"></i> DESCARGAR WORD</a>
    </div><br>
</div>
@endsection