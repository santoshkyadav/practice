<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Studio Admin</title>

  <style type="text/css">
  #menu1
    {
      color:black;
    }
  </style>

<!-- Date picker CSS-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- Bootstrap core CSS-->
  <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">


  <!-- Custom styles for this template-->
  <link href="{{url('assets/css/sb-admin.css')}}" rel="stylesheet">
  <link href="{{url('public/css/menustyle.css')}}" rel="stylesheet" type="text/css">

</head>

<body id="page-top">
 <div class="row bg-dark">
  <div class="col-md-10">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="{{url('admin_dashboard')}}">Admin</a>


      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
    
      <ul class="nav navbar-nav">
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropmenu1">Master<span class="caret"></span></a>
        <ul class="dropdown-menu submenu_c">
          <li class="admin_page"><a href="{{url('distributor')}}">Distributor Master</a></li>
          <li class="admin_page"><a href="{{url('admin_dashboard')}}">Dashboard</a></li>
          

        </ul>
      </li>
      
    </ul>

      <ul class="nav navbar-nav">
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropmenu2">Customer<span class="caret"></span></a>
        <ul class="dropdown-menu submenu_c">
          <li class="admin_page"><a href="{{url('admin/studio/customers')}}">Customers Table</a></li>
          
          <li class="admin_page"><a href="#">Cash Payment Form</a></li>
          <li class="admin_page"><a href="#">Add Template</a></li>

        </ul>
      </li>
      
    </ul>

      <ul class="nav navbar-nav">
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropmenu3">Payment Details<span class="caret"></span></a>
        <ul class="dropdown-menu submenu_c" >
        
          <li class="admin_page"><a href="{{url('admin/paymentdetails')}}">Payment Details</a></li>
         <li class="admin_page"><a href="#">Function Type&Name</a></li>

        </ul>
      </li>
      
    </ul>




    </div>
    <!-- Navbar -->
    <div class="col-md-2">
      <ul class="navbar-nav ml-auto ml-md-0 bg-dark">
        <li class="nav-item dropdown no-arrow ">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
