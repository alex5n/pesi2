@php
  //session_start();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blank Page</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <link href="/fontawesome/css/all.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script defer src="/fontawesome/js/all.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{URL::to('home')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          
          <a class="d-block">{{$_SESSION['usuario_name']}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Gestionar Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('usuario.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registrar usuario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('usuario.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar usuario</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Gestionar Empresas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('empresa.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registrar empresa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('empresa.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar empresas</p>
                </a>
              </li>
            </ul>
          </li>
          @php
            if (!isset($_SESSION['ruc'])) {
              $_SESSION['ruc'] = "ninguno";
            }
          @endphp
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Registrar informacion
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('proceso.show', ['id' => $_SESSION['ruc'], 'valor' => 1])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Procesos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('organizacion.show', $_SESSION['ruc'])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Areas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('detalleproceso.show', $_SESSION['ruc'])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Detalle</p>
                </a>
              </li> 
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reporte.informe1', $_SESSION['ruc'])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Informe 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reporte.informe2', $_SESSION['ruc'])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Informe 2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reporte.informe3', $_SESSION['ruc'])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Informe 3</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reporte.matriz', $_SESSION['ruc'])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Matriz</p>
                </a>
              </li> 
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('reporte.auditoria')}}" class="nav-link">
              <p>
                Auditoria
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <!--
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Informacion Institucional
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Información general</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Elementos FODA</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Estrategias FODA</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Matriz FODA</p>
                </a>
              </li>-->
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper position-relative">
    <!-- Main content -->
    <section class="content">
      @yield('contenido')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>
</html>
