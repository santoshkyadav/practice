@extends('layouts.admin')
@section('content')
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
          <i class="fas fa-table"></i>Event Name&Type  Table
          <a href="{{url('admin/customers')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Studio Id</th>
                  <th>Customer Id</th>                
                  <th>Function Date</th>
                  <th>Function Type</th>
                  <th>Album Name</th>
                  <th>Image Count</th>
                  <th>Remark</th>
                  <th>No. Of Sheet</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i= 1;
                @endphp
                @foreach($functionName as $function)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$function->Studio_Id}}</td>
                  <td>{{$function->customer_id}}</td>
                  <td>{{$function->FunctionDate}}</td>
                  <td>{{$function->FunctionType}}</td>
                  <td>{{$function->AlbumName}}</td>
                  <td>{{$function->ImageCount}}</td>
                  <td>{{$function->Remark}}</td>
                  <td>{{$function->NumberOfSheet}}</td>
                  @if($function->status)
                  <td>Expired</td>
                  @else
                  <td>UnExpired</td>
                  @endif
                  <td>
                    <a href="{{url('admin/function/Images?function_id='.$function->id)}}" title="View customer">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{url('admin/eventname/delete='.$function->id)}}" title="Delete Customer">
                      <i class="fa fa-trash"></i>
                    </a>
                    <a href="#" class="update_studio" data-id="{{$function->id}}" data-toggle="modal" data-target="{{'#newModel'.$function->id}}" title="Update Customer">
                      <i class="far fa-edit"></i>
                    </a> 
                    <!-- model -->
                    <div class="modal fade" id="{{'newModel'.$function->id}}" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Update Function Name</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button> 
                          </div>
                          <div class="modal-body">
                            <form method="post" action="{{url('admin/eventname?update='.$function->id)}}">
                              {{csrf_field() }}
                              <div class="form-group">
                                <label for="functiondate">Function Date:</label>
                                <input type="text" class="form-control" name="functiondate" value="{{$function->FunctionDate}}">
                              </div>
                              <div class="form-group">
                                <label for="functiontype">Function Type:</label>
                                <input type="text" class="form-control" name="functiontype" value="{{$function->FunctionType}}">
                              </div>
                              <div class="form-group">
                                <label for="albumname">Album Name:</label>
                                <input type="text" class="form-control" name="albumname" value="{{$function->AlbumName}}">
                              </div> 
                              <div class="form-group">
                                <label for="imagecount">Image Count</label>
                                <input type="text" class="form-control" name="imagecount" value="{{$function->ImageCount}}">
                              </div>
                              <div class="form-group">
                                <label for="remark">Remark:</label>
                                <input type="text" class="form-control" name="remark" value="{{$function->Remark}}">
                              </div>
                              <div class="form-group">
                                <label for="noofsheet">No of Sheet:</label>
                                <input type="text" class="form-control" name="noofsheet" value="{{$function->NumberOfSheet}}">
                              </div>
                               <div class="form-group">
                                <label for="status">Status:</label>
                                @if($function->status)
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="0" checked>Expired
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="1">UnExpired
                                </label>
                                @else
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="0">Expired
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="1" checked>UnExpired
                                </label>
                                @endif
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