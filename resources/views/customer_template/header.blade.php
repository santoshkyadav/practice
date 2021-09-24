<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Studio APP</title>

        <!-- datepicker CSS-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Bootstrap core CSS-->
        <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- fontawesome core CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Custom fonts for this template-->
        <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">


        <!-- Custom styles for this template-->
        <link href="{{url('assets/css/sb-admin.css')}}" rel="stylesheet">


    </head>

    <body>
        @php
        
            $customer_id = Session::get('customer_id');
            $studio_id = Session::get('studio_id');
            $customer_details = DB::table('mstcustomer')
            ->where(['Customer_id' => $customer_id,
            'Studio_Id' => $studio_id ])
            ->get()->toArray();
            $studio_name = DB::table('studio')->select('studio_name')
            ->where(['id' => $studio_id ])
            ->get()->toArray();
            $studio_name = $studio_name[0]->studio_name;
            $customer_name = $customer_details[0]->CustomerName;
        
        @endphp
        <nav class="navbar navbar-expand navbar-dark  static-top">
            <div class="row">
                <div class="col-xl-9">
                    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="navbar-brand mr-1" href="#">{{$studio_name}}</a>
                </div>
            <div class="col-xl-3">
            <span class="clint-name">Welcome, {{$customer_name}}</span>

            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('/customer')}}" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>