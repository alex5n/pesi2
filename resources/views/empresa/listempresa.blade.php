@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<style>
  table tr:hover {
    background-color: whitesmoke;
    cursor: pointer;
  }
</style>
<div class="container">
  <p class="text-center fs-3 fw-bolder">LISTA DE EMPRESAS</p>
  @if (session('datos'))
    <div class="alert alert-warning alert-dismissible fade show mt3" role="alert">
        {{session('datos')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="span">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif
  <table class="table table-bordered">
    <thead>
      <tr class="table-primary">
        <th scope="col" class="text-center" style="width: 10px;">N°</th>
        <th scope="col">RUC</th>
        <th scope="col">Nombre</th>
        <th scope="col">Direccion</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @php
        $int=1;
      @endphp
      @foreach($empresa as $itemempresa)
      <tr>
        <th class="align-middle" scope="row">{{$int}}</th>
        <td class="align-middle">{{$itemempresa->ruc}}</td>
        <td class="align-middle"><a href="{{route('proceso.show',['id' => $itemempresa->ruc, 'valor' => 1])}}" class="link-dark">{{$itemempresa->nombre}}</a></td>
        <td class="align-middle">{{$itemempresa->direccion}}</td>
        <td class="align-middle">
          <a href="{{route('empresa.edit',$itemempresa->ruc)}}" class="btn btn-info btn-sm" ><i class="fas fa-edit"> </i>Editar</a>   
          <a href="{{route('empresa.confirmar',$itemempresa->ruc)}}" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"></i>Eliminar</a>   
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