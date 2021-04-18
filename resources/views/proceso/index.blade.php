@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
  $_SESSION['ruc']=$empresa->ruc;
@endphp
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="background-color: rgb(78, 23, 23);">
  <li class="nav-item" role="presentation">
    <a class="nav-link {{$valor==1 ? 'active' : null}}" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" style="color: white">
      Procesos
    </a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link {{$valor==2 ? 'active' : null}}" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: white">
      Subprocesos
    </a>
  </li>
</ul>

<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade {{$valor==1 ? 'show active' : null}}" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <p class="text-center fs-3 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <div style="margin-left: 10%; margin-right: 10%;">
      <p class="fs-4 fw-bolder">LISTA DE PROCESOS</p>
      <a href="{{route('proceso.create',$empresa->ruc)}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>
      <form class="d-flex float-right">
        <input name="buscarpor1" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{$buscarpor1}}">
        <button name="buscar1" class="btn btn-success" type="submit" value="buscar1">Search</button>
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
            @foreach($proceso as $item)
            <tr>
              <th class="table-light text-center" scope="row">{{$int}}</th>
              <td class="table-light text-break">{{$item->descripcion}}</td>
              <td class="table-light">
                <a href="{{route('proceso.edit',$item->idproceso)}}" class="btn btn-info btn-sm" ><i class="fas fa-edit"> </i>Editar</a>   
                <a href="{{route('proceso.confirmar',$item->idproceso)}}" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"> </i>Eliminar</a>   
              </td>
            </tr>
            @php
              $int=$int+1;
            @endphp
            @endforeach
        </tbody>
      </table>
      {{$proceso->links()}}
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-info" href="{{route('proceso.general',$empresa->ruc)}}" role="button">GENERAL</a>
      </div><br>
    </div>
  </div>

  <div class="tab-pane fade {{$valor==2 ? 'show active' : null}}" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <p class="text-center fs-3 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <div style="margin-left: 10%; margin-right: 10%;">
      <p class="fs-4 fw-bolder">LISTA DE SUBPROCESOS</p>
      <a href="{{route('subproceso.create',$empresa->ruc)}}" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Registro</a>
      <form class="d-flex float-right">
        <input name="buscarpor2" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{$buscarpor2}}">
        <button name="buscar2" class="btn btn-success" type="submit" value="buscar2">Search</button>
      </form>
      @if(session('datoss'))
          <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
              {{ session('datoss')}}
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
            @foreach($subproceso as $item)
            <tr>
              <th class="table-light text-center" scope="row">{{$int}}</th>
              <td class="table-light text-break">{{$item->descripcion}}</td>
              <td class="table-light">
                <a href="{{route('subproceso.edit',$item->idsubproceso)}}" class="btn btn-info btn-sm" ><i class="fas fa-edit"> </i>Editar</a>   
                <a href="{{route('subproceso.confirmar',$item->idsubproceso)}}" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"> </i>Eliminar</a>   
              </td>
            </tr>
            @php
              $int=$int+1;
            @endphp
            @endforeach
        </tbody>
      </table>
      {{$subproceso->links()}}
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-info" href="{{route('proceso.general',$empresa->ruc)}}" role="button">GENERAL</a>
      </div><br>
    </div>
  </div>
</div>
@endsection