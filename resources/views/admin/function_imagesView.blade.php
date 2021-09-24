@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{url('admin_dashboard')}}">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{url('admin/customers')}}">Customer</a>
      </li>
      <li class="breadcrumb-item active">Images</li>
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
          <a href="{{url('admin/eventname')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Studio Id</th>
                  <th>Customer Id</th>                
                  <th>Function Id</th>
                  <th>Folder Name</th>
                  <th>File Name</th>
                  <th>Comment</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i= 1;
                @endphp
                @foreach($Image_list as $images)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$images->Studio_Id}}</td>
                  <td>{{$images->Customer_Id}}</td>
                  <td>{{$images->Functionname_id}}</td>
                  <td>{{$images->FolderName}}</td>
                  <td>{{$images->FileName}}</td>
                  <td>{{$images->Comment}}</td>
                  @if($images->Status)
                  <td>Selected</td>
                  @else
                  <td>Not Selected</td>
                  @endif
                  <td>
                    <a href="#" title="View customer">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{url('admin/function/deleteImages?function_id='.$images->Functionname_id.'&image_id='.$images->FunctionId)}}" title="Delete Customer">
                      <i class="fa fa-trash"></i>
                    </a>
                    <a href="#" class="update_studio" data-id="{{$images->FunctionId}}" data-toggle="modal" data-target="{{'#newModel'.$images->FunctionId}}" title="Update Customer">
                      <i class="far fa-edit"></i>
                    </a> 
                     <!-- model -->
                    <div class="modal fade" id="{{'newModel'.$images->FunctionId}}" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Update Image Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button> 
                          </div>
                          <div class="modal-body">
                            <form method="post" action="{{url('admin/function/updateImages?function_id='.$images->Functionname_id.'&image_id='.$images->FunctionId)}}">
                              {{csrf_field() }}
                              <div class="form-group">
                                <label for="foldername">Folder Name:</label>
                                <input type="text" class="form-control" name="foldername" value="{{$images->FolderName}}">
                              </div>
                              <div class="form-group">
                                <label for="filename">File Name:</label>
                                <input type="text" class="form-control" name="filename" value="{{$images->FileName}}">
                              </div>
                              <div class="form-group">
                                <label for="comment">Comment:</label>
                                <input type="text" class="form-control" name="comment" value="{{$images->Comment}}">
                              </div> 
                               <div class="form-group">
                                <label for="status">Status:</label>
                                @if($images->Status)
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="1" checked>Selected
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="0">Not Selected
                                </label>
                                @else
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="1">Selected
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="0" checked>Not Selected
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