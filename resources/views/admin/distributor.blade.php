@extends('layouts.admin')
@section('content')
<link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{url('/admin_dashboard')}}">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{url('admin/customers')}}">Customer</a>
      </li>
      <li class="breadcrumb-item active">Function</li>
    </ol>
  </div>
  <!-- /.container-fluid -->
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
  <div class="row">
    <div class="col-xl-12">
      <div class="card mb-12 xl-12">
        <div class="card-header">
          <i class="fas fa-table"></i>Distributor Table
          


              <a href="{{url('admin/customers')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a> 

              <a href="#" class="update_studio float-right btn btn-primary "  data-toggle="modal" data-target="#adddistributor" title="Update Customer" style="margin-right: 10%;background: #f3f3f3;color:blue;border:1px solid #f3f3f3;">
                      <i class="far fa-plus " ></i>Add Distributor
                    </a> 
          
        
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="text-align: center;">S.No.</th>
                  <th style="text-align: center;">Distributor Name</th>
                  <th style="text-align: center;">User Type</th>
                              
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i= 1;
                @endphp
                @foreach($users as $function)
                <tr>
                  <td style="text-align: center;">{{$i}}</td>
                  <td style="text-align: center;">{{$function->name}}</td>
                  <td style="text-align: center;">{{$function->type}}</td>
                  <td>
                    <a href="{{url('admin/function/Images?function_id='.$function->id)}}" title="View customer">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="delete_distributor?id={{$function->distributor_id}}" title="Delete Customer">
                      <i class="fa fa-trash"></i>
                    </a>
                    <a href="#" class="update_studio"  data-toggle="modal" data-target="{{'#newModel'.$function->distributor_id}}" title="Update Customer">
                      <i class="far fa-edit"></i>
                    </a> 
                    <!-- model -->
                    <div class="modal fade" id="{{'newModel'.$function->distributor_id}}" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Update Distributor Name</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button> 
                          </div>
                          <div class="modal-body">
                            <form method="post" action="{{url('update_distributor?id='.$function->distributor_id)}}">
                              {{csrf_field() }}
                              @php 
                              $res=DB::table('distributor')->where('distributor_id', $function->distributor_id)->get()->toArray();
                            //print_r($res[0]->distributor_id);

                              @endphp
                              <div class="form-group">
                                <label for="functiondate">User Type</label><br>
                                <input type="radio" name="type"  value="distributor">Distributor
                                
                                <input type="radio" name="type" value="user">Employee

                            </div>
                              <div class="form-group">
                                <label for="functiondate">Distributor Name</label>
                                <input type="text" class="form-control" name="distributorname" value="{{$res[0]->name}}">
                              </div>
                              
                              
                               
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end model -->

                  </td>
                </tr>
                @php
                $i++;
                @endphp
                @endforeach
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- model -->
                    <div class="modal fade" id="adddistributor" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Add Distributor </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button> 
                          </div>
                          <div class="modal-body">
                            <form method="post" action="{{url('insert_distributor')}}">
                              {{csrf_field() }}
                              <div class="form-group">
                                <label for="functiondate">User Type</label><br>
                                <input type="radio" name="type" value="distributor">Distributor
                                <input type="radio" name="type" value="user">Employee

                            </div>
                              <div class="form-group">
                                <label for="functiondate">Distributor Name</label>
                                <input type="text" class="form-control" name="distributorname">
                              </div>
                              
                              
                               
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" >Add</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end model -->

  <!-- Sticky Footer -->
  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright © Your Website 2018</span>
      </div>
    </div>
  </footer>
</div>
<!-- /.content-wrapper -->
@endsection
@section('js')
<script type="text/javascript">
  $(function () {
    $("#expirydate").datepicker({
        dateFormat: "yy-mm-dd",
        orientation: "bottom",
    });
});

</script>
@endsection