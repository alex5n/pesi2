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
<br><br><br>
  <div class="card col-4" style="margin-left: 35%;">
    <div class="card-body register-card-body">
      <p class="login-box-msg text-uppercase fw-bolder fs-5">Registrar empresa</p>
      <form method="POST" action="{{route('empresa.store', $_SESSION['usuario_id'])}}">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('nombre') is-invalid @enderror" placeholder="Empresa" id="nombre" name="nombre" value="{{old('nombre')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-building"></span>
            </div>
          </div>
          @error('nombre')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('RUC') is-invalid @enderror" placeholder="RUC" id="RUC" name="RUC" value="{{old('RUC')}}" onkeypress="return soloNumeros(event)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
          @error('RUC')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('direccion') is-invalid @enderror" placeholder="direccion" id="direccion" name="direccion" value="{{old('direccion')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
          @error('direccion')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
          @enderror
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="submit">Registrar</button>
        </div>
      </form>
    </div>
  </div>
@endsection