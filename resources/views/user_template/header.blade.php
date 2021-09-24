<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Studio APP</title>

  <!-- Bootstrap core CSS-->
  <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- fontawesome core CSS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom fonts for this template-->
  <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!----webfonts--->
  <link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
  <!---//webfonts--->   

  <!-- Page level plugin CSS-->
  <link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">


  <!-- Custom styles for this template-->
  <link href="{{url('assets/css/sb-admin.css')}}" rel="stylesheet">


  <!-- Custom CSS for template -->
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!-- Bootstrap Core CSS -->
  <link href="{{url('assets/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
  <!-- Custom CSS -->
  <link href="{{url('assets/css/style.css')}}" rel='stylesheet' type='text/css' />
  <!-- Graph CSS -->
  <link href="{{url('assets/css/lines.css')}}" rel='stylesheet' type='text/css' />
  <link href="{{url('assets/css/font-awesome.css')}}" rel="stylesheet"> 
  <!-- jQuery -->
  <script src="{{url('assets/js/jquery.min.js')}}"></script>
  <!----webfonts--->
  <link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
  <!---//webfonts--->    
  <!-- Nav CSS -->
  <link href="{{url('assets/css/custom.css')}}" rel="stylesheet">
  <!-- Metis Menu Plugin JavaScript -->
  <script src="{{url('assets/js/metisMenu.min.js')}}"></script>
  <script src="{{url('assets/js/custom.js')}}"></script>
  <!-- Graph JavaScript -->
  <script src="{{url('assets/js/d3.v3.js')}}"></script>
  <script src="{{url('assets/js/rickshaw.js')}}"></script>
  <script src="{{url('assets/js/bootstrap.min.js')}}"></script>

</head>

<body id="page-top">
  <div class="row header_studio">

   <div class="col-md-9"> <nav class="navbar navbar-expand navbar-dark  static-top">
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    @php
    $session = Session::all();
    @endphp
    <a class="navbar-brand mr-1" href="{{url('/user_dashboard')}}">{{$session['studio_name']}}</a>
    <ul class="nav navbar-nav downlods_nav">
      <li class="active"><a href="{{url('user_dashboard/templatesummary')}}">Download Template</a></li>
      <li><a href="{{url('user_dashboard/software')}}">Download Software</a></li>
      <li><a href="{{url('user_dashboard/clientdetail')}}">Client Details</a></li>
    </ul>
    
  </div>

  <!-- Navbar Search -->
    <div class="col-md-2">
      <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal1">Make Payment</button>
    </div>
      <!-- Navbar -->
      <div class="col-md-1">
        <ul class="navbar-nav ml-auto ml-md-0 nevbar-right">
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <!-- <div class="dropdown-divider"></div> -->
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

