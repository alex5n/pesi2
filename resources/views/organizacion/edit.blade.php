@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container">
  <h1>MODIFICAR ÁREA</h1>
  <form method="POST" action="{{route('organizacion.update', ['id' => $organizacion->idarea, 'idusuario' => $_SESSION['usuario_id']])}}">
      @method('put')  
      @csrf
      <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Descripcion" value="{{$organizacion->descripcion}}">
        @error('descripcion')
            <span class="invalid-feedback" role="alert">
              <strong>{{$message}}</strong>
            </span>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
      <a href="{{route('cancelarorganizacion',$_SESSION['ruc'])}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
  </form>
</div>
@endsection