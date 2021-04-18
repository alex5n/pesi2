@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
  <div>
    <p class="text-center fs-3 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <div style="margin-left: 10%; margin-right: 10%;">
      <p class="fs-4 fw-bolder">LISTA DE ÁREAS</p>
      <a href="{{route('organizacion.create',$empresa->ruc)}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>
      <form class="d-flex float-right">
        <input name="buscarpor" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{$buscarpor}}">
        <button name="buscar" class="btn btn-success" type="submit" value="buscar">Search</button>
      </form>
      @if(session('datos'))
          <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
              {{ session('datos')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif
      <table class="table table-bordered" style="margin-top: 10px;">
        <thead class="table-primary">
          <tr>
            <th scope="col" class="text-center" style="width: 10px;">N°</th>
            <th scope="col" class="text-center">Descripcion</th>
            <th scope="col" class="text-center" style="width: 180px;">Opciones</th>
          </tr>
        </thead>
        <tbody>
            @php
              $int=1;
            @endphp
            @foreach($organizacion as $item)
            <tr>
              <th class="table-light text-center" scope="row">{{$int}}</th>
              <td class="table-light text-break">{{$item->descripcion}}</td>
              <td class="table-light">
                <a href="{{route('organizacion.edit',$item->idarea)}}" class="btn btn-info btn-sm" ><i class="fas fa-edit"> </i>Editar</a>   
                <a href="{{route('organizacion.confirmar',$item->idarea)}}" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"> </i>Eliminar</a>   
              </td>
            </tr>
            @php
              $int=$int+1;
            @endphp
            @endforeach
        </tbody>
      </table>
      {{$organizacion->links()}}
    </div>
  </div>
@endsection