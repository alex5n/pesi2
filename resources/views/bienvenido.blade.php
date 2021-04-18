@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
  if (isset($user)) {
    $_SESSION['usuario_id']=$user->idusuario;
    $_SESSION['usuario_name']=$user->fullname;
  }
@endphp
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
      <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/imagenes/1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Para cualquier emprendedor: si quieres hacerlo, hazlo ahora. Si no lo haces te vas a arrepentir</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="/imagenes/2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>No es sobre las ideas. Sino hacer que éstas se vuelvan realidad</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="/imagenes/3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Las ideas son fáciles, implementarlas es lo difícil</h5>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
</div>
@endsection