<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ url('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS-->
    <!-- <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/sweetalert.css')}}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Studio Name') }}
                    </a>
                </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('admin_login') }}">
                            {{ csrf_field() }}
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ session('error') }}</strong>
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('success') }}</strong>
                            </div>
                            @endif
                            <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                                <label for="mobile_no" class="col-md-4 control-label">mobile_no</label>

                                <div class="col-md-6">
                                    <input id="mobile_no" type="text" class="form-control" name="mobile_no" value="{{ old('mobile_no') }}" required autofocus>

                                    @if ($errors->has('mobile_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_no') }}</strong> </span>
                                        @endif
                                        
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        @if (session('password'))
                                        <span class="help-block">
                                            <strong>{{ session('password') }}</strong>
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

                                        <a class="btn btn-link" href="{{ url('forgetPassword') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ url('public/js/app.js') }}"></script>
    <script type="text/javascript" src="{{url('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
    <!-- <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="{{url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <script type="text/javascript">
        $('#verify_number').on('click', function(){
            alert('okkk');
            $.ajax({
                type: 'POST',
                url: 'verifyStudio',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){

                    var res = $.parseJSON(response);
                    var message = res.MessageData[0].Number;
                    console.log(message);
                    var HTML = '<p>Your One Time Passcode has been sent to  <strong>Mobile No.: +' + message + '</strong></p>';
                    $('#confirm_message').append(HTML);
                }
            });
        });
        
    </script>

</body>
</html>