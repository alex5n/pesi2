@foreach($area as $item)
    <p>{{$item->idsubproceso}}: {{$item->descripcion}}</p>
@endforeach

@foreach($subproceso as $item)
    <p>{{$item->IdProceso->descripcion}}: {{$item->descripcion}}</p>
@endforeach
@foreach($proceso as $item)
    <p>{{$item->idproceso}}: {{$item->descripcion}}</p>
@endforeach