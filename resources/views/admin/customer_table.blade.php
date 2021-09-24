@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Customers</li>
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
          <i class="fas fa-table"></i>Customer Table
          <a href="{{url('admin_dashboard')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Customer Name</th>
                  <th>Customer Username</th>                
                  <th>Customer Password</th>
                  <th>Studio Id</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i= 1;
                @endphp
                @foreach($customers_list as $customer)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$customer->CustomerName}}</td>
                  <td>{{$customer->Cust_Username}}</td>
                  <td>{{$customer->Cust_Password}}</td>
                  <td>{{$customer->studio_id}}</td>
                  <td>{{$customer->City}}</td>
                  <td>{{$customer->State}}</td>
                  @if($customer->status)
                  <td>Verified</td>
                  @else
                  <td>UnVerified</td>
                  @endif
                  <td>
                    <a href="{{url('admin/customer/functions?customer_id='.$customer->Customer_id)}}" title="View customer">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{url('admin/customers/delete='.$customer->Customer_id)}}" title="Delete Customer">
                      <i class="fa fa-trash"></i>
                    </a>
                    <a href="#" class="update_studio" data-id="{{$customer->Customer_id}}" data-toggle="modal" data-target="{{'#newModel'.$customer->Customer_id}}" title="Update Customer">
                      <i class="far fa-edit"></i>
                    </a> 
                    <div class="modal fade" id="{{'newModel'.$customer->Customer_id}}" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Update Studio</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button> 
                          </div>
                          <div class="modal-body">
                            <form method="post" action="{{url('admin/customers?update='.$customer->Customer_id)}}">
                              {{csrf_field() }}
                              <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{$customer->CustomerName}}">
                              </div>
                              <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" value="{{$customer->Cust_Username}}">
                              </div>
                              <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" value="{{$customer->Cust_Password}}">
                              </div> 
                              <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" value="{{$customer->City}}">
                              </div>
                              <div class="form-group">
                                <label for="state">State:</label>
                                <input type="text" class="form-control" name="state" value="{{$customer->State}}">
                              </div>
                               <div class="form-group">
                                <label for="status">Status:</label>
                                @if($customer->status)
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="0" >UnVerified
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="1" checked>Verified
                                </label>
                                @else
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="0" checked>UnVerified
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="1">Verified
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