
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
        <link href="{{url('public/css/app.css')}}" rel="stylesheet">

    </head>

    <body id="page-top">
         @php
            $ref = @$_SERVER[HTTP_REFERER];
             $a= parse_url($ref, PHP_URL_HOST);
            @endphp
         <nav class="navbar navbar-expand navbar-dark  static-top">
            <div class="row">
                <div class="col-xl-9">
                    <a class="navbar-brand mr-1" href="#">{{$a}}</a>
                </div>
                <div class="col-xl-3">   
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row" style="margin-top: 150px;">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Login </div>
                            <div class="panel-body">
                                @if (session('error'))                            
                                <div class="alert alert-danger" role="alert">
                                <strong>{{ session('error') }}</strong>
                            </div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{ url('customer/user_giude') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('Cust_Username') ? ' has-error' : '' }}">
                                    <label for="Cust_Username" class="col-md-4 control-label">Username</label>
                                    <div class="col-md-6">
                                        <input id="Cust_Username" type="text" class="form-control" name="Cust_Username" value="{{ old('Cust_Username') }}" required autofocus>
                                        @if ($errors->has('Cust_Username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Cust_Username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                              <div class="form-group{{ $errors->has('Cust_Password') ? ' has-error' : '' }}">
                                    <label for="Cust_Password" class="col-md-4 control-label">Password </label>

                                    <div class="col-md-6">
                                        <input id="Cust_Password" type="password" class="form-control" name="Cust_Password" required>
                                        @if ($errors->has('Cust_Password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Cust_Password') }}</strong>
                                        </span>
                                        @endif                                       
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    


    </body>
</html>


