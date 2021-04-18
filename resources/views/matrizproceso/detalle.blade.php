@extends('layout.plantilla')

@section('contenido')
@php
  session_start();
@endphp
  <div class="container">
    <p class="text-center fs-3 fw-bolder text-uppercase">{{$empresa->nombre}}</p>
    <form action="{{route('detalleproceso.update', $subproceso->idsubproceso)}}" method="POST">
      @csrf
      @method('put')
      <p class="fw-bolder" style="color: gray">{{$subproceso->descripcion}}</p>
      <table class="table table-bordered caption-top">
        <thead class="table-primary">
          <tr>
            <th scope="col" class="text-center" style="width: 10px;">N°</th>
            <th scope="col" class="text-center">AREA</th>
            <th scope="col" class="text-center" style="width: 50%;">PARTICIPACION</th>
          </tr>
        </thead>
        <tbody>
          @php
            $int=1;
          @endphp
          @foreach($area as $item1)
          <tr>
            <th class="table-light text-center align-middle" scope="row">{{$int}}</th>
            <td class="table-light text-break align-middle">{{$item1->descripcion}}</td>
            <td>
              <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="responsabilidad" name="responsabilidad[]">
                @php
                  $clave = $detalle[$int-1]->idresponsabilidad;         
                @endphp
                @foreach($responsabilidad as $item2)
                  <option value="{{$item2->idresponsabilidad}}" {{$clave == $item2->idresponsabilidad ? 'selected' : null}}>{{$item2->descripcion}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          @php
            $int=$int+1;
          @endphp
          @endforeach
        </tbody>
      </table>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
      <a href="{{route('cancelardetalle',$_SESSION['ruc'])}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
    </form>
  </div>
@endsection