<!-- Navigation Menu lateral Izquierdo-->
@if ( Auth::user()->role == 'admin') 
  <h6 class="navbar-heading text-muted">Gestionar datos</h6>
@else
  <h6 class="navbar-heading text-muted">Menu</h6>
@endif
<ul class="navbar-nav">
  @if ( Auth::user()->role == 'admin')     
 
    <li class="nav-item">
      <a class="nav-link" href="/dashboard">
        <i class="ni ni-tv-2 text-blue"></i> Home
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/specialties">
        <i class="ni ni-favourite-28 text-green"></i> Especialidades
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/doctors">
        <i class="ni ni-single-02 text-green"></i> Medicos
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/patients">
        <i class="ni ni-satisfied text-green"></i> Pacientes
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-calendar-grid-58 text-green"></i> Horarios
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/doctors/seed">
        <i class="ni ni-button-play text-primary"></i> MySeeders
      </a>
    </li> 
  @elseif ( Auth::user()->role == 'doctor')
    <li class="nav-item">
      <a class="nav-link" href="/schedule">
        <i class="ni ni-calendar-grid-58 text-green"></i> Gestionar Horaros
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/patients">
        <i class="ni ni-satisfied text-green"></i> Mis Pacientes
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./examples/tables.html">
        <i class="ni ni-time-alarm text-green"></i> Mis turnos
      </a>
    </li>       
  @elseif ( Auth::user()->role == 'patien')
  <li class="nav-item">
    <a class="nav-link" href="/appointments/create">
      <i class="ni ni-laptop text-default"></i> Reservar turno
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/patients">
      <i class="ni ni-calendar-grid-58 text-default"></i> Mis turnos
    </a>
  </li>    
  @endif
  </ul>
  <hr class="my-3">
  <!-- Heading -->
  @if ( Auth::user()->role == 'admin') 
  <h6 class="navbar-heading text-muted">Reporte</h6>
  <!-- Navigation -->
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-time-alarm text-red"></i> Frecuencia de citas
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-user-run text-red"></i> Medicos mas activos
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-ui-04 text-red"></i> Components
      </a>
    </li> --}}
  </ul>
  @endif