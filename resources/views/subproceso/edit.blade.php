@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<h1>Modificar Proceso</h1>
<form method="POST" action="{{route('subproceso.update', ['id' => $subproceso->idsubproceso, 'idusuario' => $_SESSION['usuario_id']])}}">
    @method('put')  
    @csrf
    <select class="form-select" aria-label="Default select example" id="proceso" name="proceso">
        @foreach($proceso as $item)
            @if ($item->idproceso==$subproceso->idproceso)
              <option selected value="{{$item->idproceso}}">{{$item->descripcion}}</option>
            @else
              <option value="{{$item->idproceso}}">{{$item->descripcion}}</option>
            @endif      
        @endforeach
    </select>

    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Descripcion" value="{{$subproceso->descripcion}}">
        @error('descripcion')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
       @enderror
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
    <a href="{{route('cancelarsubproceso',$subproceso->ruc)}}" class="btn btn-danger" ><i class="fas fa-ban"></i>Cancelar</a>
</form>
@endsection