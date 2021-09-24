@extends('layouts.user_dashboard')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <!--Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('user_dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Customers</li>
        </ol>

        <!-- Icon Cards-->

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-12 xl-12">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        All Customers<a href="{{url('user_dashboard')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>CustomerName</th>
                                            <th>FunctionDate</th>
                                            <th>FunctionType</th>
                                            <th>AlbumName</th>
                                            <th>ImageCount</th>
                                            <th>ExpiryDate</th>
                                            <th>CustomerId</th>
                                            <th>CustomerKey</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allEvents as $item)
                                        <tr>
                                            <td>{{$item->CustomerName}}</td>
                                            <td>{{$item->FunctionDate}}</td>
                                            <td>{{$item->FunctionType}}</td>
                                            <td>{{$item->AlbumName}}</td>
                                            <td>{{$item->ImageCount}}</td>
                                            <td>{{$item->ExpiryDate}}</td>    
                                            <td>{{$item->Cust_Username}}</td>
                                            <td>{{$item->Cust_Password}}</td>
                                            <td>
                                                <a href="{{url('user_dashboard/customer/viewCustomer?id='.$item->id)}}" title="View customer">
                                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      @endsection
      @section('js')
      <script type="text/javascript">
        $('#addBtn').click(function () {
            //alert('asdasda');
            $('#event_name').val('');
        });
        $('#addEvent').click(function () {
            var id = $('#AddEventModal').data('id');
            var event_name = $('#event_name').val();
            var path = 'add_event';
            if (event_name == '')
            {
                swal('Error', 'Please Enter Event Name', 'error');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: path,
                data: {
                    event_id: id,
                    event_name: event_name
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    var res = $.parseJSON(data);
                    if (res.status == 'error') {
                        $('#AddEventModal').modal('toggle');
                        swal('Error', res.message, 'error');
                        $('#event_name').val('');
                    } else {
                        $('#AddEventModal').modal('toggle');
                        $('#event_name').val('');
                        swal('Success', res.message, 'success');
                    }
                },
                error: function (data) {
                    swal('Error', data, 'error');
                }
            });
        });
        function geteventDetails(id) {
            var path = "event_details";
            $.ajax({
                type: "POST",
                url: path,
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    //console.log(result);
                    var res = $.parseJSON(result);
                    if (res.status == 'error') {

                    } else {
                        var data = $.parseJSON(JSON.stringify(res.message));
                        $('#AddEventModal').data('id', data.id);
                        $('#AddEventModal').find('.modal-title').html('Edit Event');
                        $('#event_name').val(data.event_name);
                        $('#AddEventModal').modal('show');
                        //datatable.reload();
                    }
                },
                error: function () {
                    alert("Error");
                }
            });
        }
        /*---------DELETE CUSTOMER--------*/
        function deleteCustomer(id) {

            var path = "deleteCustomer";
            var _this = $(this);
            swal({
                title: "Are you sure to delete this Customer?",
                text: "Your will lost all records of this Customer",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    var data = id;
                    $.ajax({
                        type: 'POST',
                        url: path,
                        data: {
                            id: data,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            var res = $.parseJSON(data);
                            if (res.status == 'error') {
                                swal('Error', res.message, 'error');
                            } else {
                                $('.sweet-overlay').remove();
                                $('.showSweetAlert ').remove();
                                swal('Success', res.message, 'success');
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                                        //$("#ResponseSuccessModal").modal('show');
                                        //$("#ResponseSuccessModal #ResponseHeading").text(res.message);
                                    }
                                },
                                error: function (data) {
                                    swal('Error', data, 'error');
                                }
                            });
                } else {

                }
            });
        }
    </script>
    @endsection