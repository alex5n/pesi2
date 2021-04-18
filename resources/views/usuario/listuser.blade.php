@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container">
  <p class="text-center fs-3 fw-bolder">LISTA DE USUARIOS</p>
  @if (session('datos'))
    <div class="alert alert-warning alert-dismissible fade show mt3" role="alert">
        {{session('datos')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif
  <table class="table table-bordered">
    <thead>
      <tr class="table-primary">
        <th scope="col" class="text-center" style="width: 10px;">N°</th>
        <th scope="col">Apellidos y Nombres</th>
        <th scope="col">Usuario</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @php
        $int=1;
      @endphp
      @foreach($usuarios as $itemu)
      <tr>
        <th class="table-light text-center" scope="row">{{$int}}</th>
        <td class="table-light">{{$itemu->fullname}}</td>
        <td class="table-light">{{$itemu->usuario}}</td>
        <td class="table-light">
          <a href="{{route('usuario.edit',$itemu->idusuario)}}" class="btn btn-info btn-sm" ><i class="fas fa-edit"></i>Editar</a>   
          <a href="{{route('usuario.confirmar',$itemu->idusuario)}}" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"></i>Eliminar</a>   
        </td>
      </tr>
      @php
        $int=$int+1;
      @endphp
      @endforeach
    </tbody>
  </table>
</div>

@endsection