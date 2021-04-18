<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title></title>
</head>
<body>
    <style>
        p{
            font-weight: bolder;
            text-transform: uppercase;
            text-align: center;
            font-size: 30px;
            word-spacing: 6px;
            letter-spacing: 2px;
        }
        th {
            border: black 1px solid;
        }
        tr {
            border: black 1px solid;
        }
        td {
            border: black 1px solid;
        }
        tbody {
            border: black 1px solid;
        }
        section{
            background-color: white;
        }
    </style>
    <p>PROCESOS VS ORGANIZACION ({{$empresa->nombre}})</p>
    <table class="table">
        <thead>
          <tr>
            <th colspan="2" rowspan="2" style="background-color: burlywood; width: 30%;"></th>
            <th colspan="{{$cantidad}}" class="text-center fw-normal" style="background-color: cornflowerblue; width: 70%;">ORGANIZACIÓN</th>
          </tr>
          <tr>
            @foreach($area as $item)
                <th class="text-center text-uppercase fw-normal text-center align-middle" style="background-color: rgba(52, 219, 219, 0.671); ">{{$item->descripcion}}</th>    
            @endforeach
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center fw-bolder" style="background-color: rgb(97, 182, 104); width: 14%;">PROCESOS</td>
            <td class="text-center fw-bolder" style="background-color: rgb(97, 182, 104); width: 16%;">SUBPROCESOS</td>
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
                            <td class="text-center align-middle" style="font-weight: bolder;">X</td>
                        @elseif ($detalle[$k]->idresponsabilidad == 2)
                            <td class="text-center align-middle" style="font-weight: italic;">X</td>
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
                                <td class="text-center align-middle" style="font-weight: bolder;">X</td>
                            @elseif ($detalle[$k]->idresponsabilidad == 2)
                                <td class="text-center align-middle" style="font-weight: italic;">X</td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>-->
</body>
</html>