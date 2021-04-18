@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<div class="container">
  <h1>Registrar Subproceso</h1>
  <form method="POST" action="{{route('subproceso.store', ['id' => $empresa->ruc, 'idusuario' => $_SESSION['usuario_id']])}}">    
      @csrf
      <select class="form-select" aria-label="Default select example" id="proceso" name="proceso">
        @foreach($proceso as $item)
            @if ($item === reset($proceso))
              <option selected value="{{$item->idproceso}}">{{$item->descripcion}}</option>
            @endif
            <option value="{{$item->idproceso}}">{{$item->descripcion}}</option>
        @endforeach
      </select>

      <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Descripcion">
        @error('descripcion')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
      <a href="{{route('cancelarsubproceso',$empresa->ruc)}}" class="btn btn-danger" ><i class="fas fa-ban"> </i>Cancelar</a>
  </form>
</div>
@endsection