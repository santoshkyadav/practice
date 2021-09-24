
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
            

    <div class="panel panel-default panel_2">
                    <div class="panel-heading"><h4>Change Mobile Number </h4><a href="{{url('otp')}}" class="back_btn">Go Back</a></div> 
        <div class="panel-body">
                       

                        <div class="form-group{{ $errors->has('new_number') ? ' has-error' : '' }} new_number"> 

                           <label for="new_number" class="col-md-4 control-label">Mobile Number: </label>
                           <div class="col-md-6">

                            <input type="text" id="new_number" name="new_number" class="form-control" placeholder="Enter Mobile No.">
                            @if ($errors->has('new_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new_number')}}</strong>
                            </span>
                            @endif
                        </div>
                        </div>
                    <div class="form-group">    
                 <div class="col-md-8 col-md-offset-4">
                    <button class="mobile_update btn btn-primary">Update Mobile</button>
                </div>
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

$('.mobile_update').on('click', function(){
    var new_mobile = $('#new_number').val();
    $.ajax({
        type: 'POST',
        url: 'changeMobile',
        data: {'new_mobile': new_mobile},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(data){
            var response = $.parseJSON(data);
            console.log(response);
            if(response.status === 'error'){
                swal('Error', response.message, 'error');
            }else {
                swal('Success', response.message, 'success');
            }
        }
    });
});

</script>
</body>
</html>