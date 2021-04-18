@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
  <div>
    <p class="text-center fs-3 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <div style="margin-left: 10%; margin-right: 10%;">
      <p class="fs-4 fw-bolder">LISTA DE SUBPROCESOS</p>
      @if(session('datos'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
          {{ session('datos')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <form class="d-flex float-right mb-2">
        <input name="buscarpor" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{$buscarpor}}">
        <button name="buscar" class="btn btn-success" type="submit" value="buscar">Search</button>
      </form>
      <table class="table table-bordered" style="margin-top: 10px;">
        <thead class="table-primary">
          <tr>
            <th scope="col" class="text-center" style="width: 10px;">N°</th>
            <th scope="col" class="text-center">Descripcion</th>
          </tr>
        </thead>
        <tbody>
            @php
              $int=1;
            @endphp
            @foreach($subproceso as $item)
            <tr>
              <th class="table-light text-center" scope="row">{{$int}}</th>
              <td class="table-light text-break"><a href="{{route('detalleproceso.edit',$item->idsubproceso)}}" class="link-dark">{{$item->descripcion}}</a></td>
            </tr>
            @php
              $int=$int+1;
            @endphp
            @endforeach
        </tbody>
      </table>
      {{$subproceso->links()}}
    </div>
  </div>
@endsection