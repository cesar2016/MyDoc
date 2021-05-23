<!DOCTYPE html>
<html>
<!-- 
    Para modificar plantilla de Jetstream:
    vendo/laravel/jetstream/resoure\views/components
 -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>MyDoc</title>
  <!-- Favicon -->
  <link href="{{asset('img/brand/favicon.png')}}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{asset('vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{asset('css/argon.css?v=1.0.0')}}" rel="stylesheet">
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="../index.html">
          <img src="{{asset('img/brand/white.png')}}" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="{{asset('img/brand/blue.png')}}">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">             
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{route('register')}}">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text">Registrate</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{route('login')}}">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">Ingresar</span>
              </a>
            </li>             
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">      
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-12">          
          @yield('content')         

        </div>       
      </div>
    </div>  
    
  </div>
  <!-- Footer   &copy; 2021 <a href="https://www.linkedin.com/in/cesar-sanchez-dev/" class="font-weight-bold ml-1" target="_blank">Developer Fullstack Desing Cesar R Sanchez</a>-->
  <footer class="text-muted py-2 mt-2 container-fluid p-1">
    <div class="row container-fluid justify-content-center">
       <div class="redes-sociales col-lg-4 col-md-12 justify-content-center p-2 mx-auto ">
        <a href="https://www.facebook.com/profile.php?id=100009990557167" class="facebook"  target=”_blank”><span class="fab fa-facebook"  target=”_blank”></span></a>
        <a href="https://www.instagram.com/cesars.sanchez/?fbclid=IwAR0d_KHQoXIGtibF1dMNsZDEDHNfWIpfJpMEJbTj9D715_vr78ALN1CzfCg" class="instagram"  target=”_blank”><span class="fab fa-instagram"  target=”_blank”></span></a>
        <a href="https://www.linkedin.com/in/cesar-sanchez-dev/" class="linkedin"  target=”_blank”><span class="fab fa-linkedin"></span></a>

      </div>

      <div class="col-lg-4 col-md-12 justify-content-center align-items-center d-flex pt-2">
        <p>&copy; 2021 <a href="https://www.linkedin.com/in/cesar-sanchez-dev/" class="font-weight-bold ml-1" target="_blank">Developer Fullstack Desing Cesar R Sanchez</a></p>
      </div>        
      <div class="col-lg-4 col-md-12 justify-content-center pt-2">
      
        <small class="text-ligth float-right" >I changin pasion for glory</small>
        
      </div>    
     
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{asset('js/argon.js?v=1.0.0')}}"></script>
</body>

</html>