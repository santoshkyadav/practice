
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
    <div class="container">
        <div class="row" style="margin-top: 70px;">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default panel_1">
                    <div class="panel-heading"><h4>Validate OTP (One Time Passcode) </h4><a href="{{url('/studio_Register')}}" class="back_btn">Go Back</a></div>
                    <div class="panel-body">
                        @php
                        $session = Session::all();
                        @endphp
                        @if(session('status'))
                        
                        <p>{{ session('status') }}<strong>Mobile No.: {{ $session['mobile']}}</strong></p>
                        @endif 

                        @if(session('error')) 
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ session('error') }}</strong>
                        </div>
                        @endif

                        <div id="confirm_message"></div>
                        <p>Please enter the OTP below to verify your Mobile number. If you want to change your number <a href="{{url('change_mobileNumber')}}" class="change_mob">Click Here</a></p>
                        <form  method="post" action="{{url('/verifyOtp')}}">
                          {{ csrf_field() }}
                          
                          <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">	

                             <label for="otp" class="col-md-4 control-label">OTP: </label>
                             <div class="col-md-6">

                                <input type="text" name="otp" class="form-control" placeholder="Enter code">
                                @if ($errors->has('otp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('otp')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   Validate OTP
                               </button>
                           </div> 
                       </div>
                   </form>
                   <div class="col-md-12    ">
                    <button class="resent_otp">Resend OTP</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{ url('public/js/app.js') }}"></script>
<script type="text/javascript" src="{{url('assets/js/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('assets/css/sweetalert.css')}}">
<script type="text/javascript">

   $('.resent_otp').on('click', function(){
    $.ajax({
        type: 'POST',
        url: 'resendOtp',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            var HTML = '<p>Your One Time Passcode has been sent to  <strong>Mobile No.: </strong></p>';
            $('#confirm_message').append(HTML);
        }
    });
});

</script>
</body>
</html>