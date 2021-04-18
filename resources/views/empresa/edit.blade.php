@extends('layout.plantilla')
@section('contenido')
@php
  session_start();
@endphp
<script>
  function soloNumeros(e) {
    var key = e.keyCode || e.which,
      tecla = String.fromCharCode(key).toLowerCase(),
      letras = "0123456789",
      especiales = [8, 37, 39, 46],
      tecla_especial = false;

    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      return false;
    }
    var val = document.getElementById("RUC").value;
    var tam = val.length;
    if (tam == 11) {
      return false;
    }
  }
</script>
<div class="container">
    <h1>Editar Empresa</h1>
    <form method="POST" action="{{ route('empresa.update',['id' => $empresa->ruc, 'iduser' => $_SESSION['usuario_id']])}}">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre de la empresa: </label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{$empresa->nombre}}" >
        @error('nombre')
            <span class="invalid-feedback" role="alert">
              <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="RUC">RUC: </label>
        <input type="text" class="form-control @error('RUC') is-invalid @enderror" id="RUC" name="RUC" value="{{$empresa->ruc}}" onkeypress="return soloNumeros(event)">
        @error('RUC')
            <span class="invalid-feedback" role="alert">
              <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="direccion">Direccion: </label>
        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{$empresa->direccion}}">
        @error('direccion')
            <span class="invalid-feedback" role="alert">
              <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>      
    <button type="submit" class="btn btn-primary">Grabar</button>
    <a href="{{route('cancelarempresa')}}" class="btn btn-danger" ><i class="fas fa-ban"> </i>Cancelar</a>
    </form>
</div>

@endsection