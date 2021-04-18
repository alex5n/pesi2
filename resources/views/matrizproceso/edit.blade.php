@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<h1>Modificar Organizacion</h1>
<form method="POST" action="{{route('organizacion.update', $organizacion->idarea)}}">
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
@endsection