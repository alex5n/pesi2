@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
<br><br><br>
  <div class="card col-4" style="margin-left: 35%;">
    <div class="card-body register-card-body">
      <p class="login-box-msg text-uppercase fw-bolder fs-5">Registrar Usuario</p>

      <form method="POST" action="{{route('usuario.store', $_SESSION['usuario_id'])}}">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control  @error('full_name') is-invalid @enderror" placeholder="Apellidos y nombres" id="full_name" name="full_name" value="{{old('full_name')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('full_name')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control  @error('usuario') is-invalid @enderror" placeholder="Usuario" id="usuario" name="usuario" value="{{old('usuario')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-tie"></span>
            </div>
          </div>
          @error('usuario')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('contraseña') is-invalid @enderror" placeholder="Contraseña" id="contraseña" name="contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('contraseña')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
          @enderror
        </div>
        <label for="inputPassword5" class="form-label">Permiso</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" value='usuario' checked>
          <label class="form-check-label" for="flexRadioDefault2">
            Usuario
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" value="administrador">
          <label class="form-check-label" for="flexRadioDefault1">
            Administrador
          </label>
        </div>  
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="submit">Registrar</button>
        </div>
      </form>
    </div>
  </div>
@endsection