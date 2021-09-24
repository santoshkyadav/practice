@extends('layouts.admin')
<link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

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
          <i class="fas fa-table"></i>Payment Table
          <a href="{{url('admin_dashboard')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Payment Date</th>
                  <th>Subscription Tenure (In Months)</th>                
                  <th>StartDate</th>
                  <th>Expiry Date</th>
                  <th>Studio Id</th>
                  <th>Amount Paid</th>
                  <th>StudioMob.No.</th>
                  <th>Payment Methord</th>
                  <th>Payment Status</th>
                  <th>Remark</th>
                  <th>AmountPaidFor</th>
                  <th>Collection Place</th>
                  <th>Collected By</th>
                  <th>Delivery status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i= 1;
                @endphp
                @foreach($paymentdetails as $payment_val)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$payment_val->PaymentDate}}</td>
                  <td>{{$payment_val->SubscriptionTenure}}</td>
                  <td>{{$payment_val->StartDate}}</td>
                  <td>{{$payment_val->ExpiryDate}}</td>
                  <td>{{$payment_val->Studio_id}}</td>
                  <td>{{$payment_val->AmountPaid}}</td>
                  <td>{{$payment_val->StudioMobileNumber}}</td>
                   @if($payment_val->PaymentMethord == 1)
                  <td>Online</td>
                  @elseif($payment_val->PaymentMethord == 2)
                  <td>Bank Deposite</td>
                  @else
                  <td>At Counter(Cash)</td>
                  @endif
                  @if($payment_val->PaymentStatus == 0)
                  <td>Pending</td>
                  @elseif($payment_val->PaymentStatus == 1)
                  <td>Success</td>
                  @else
                  <td>Failed</td>
                  @endif
                  <td>{{$payment_val->Remark}}</td>
                  <td>{{$payment_val->AmountPaidFor}}</td>
                  @if($payment_val->CollectionPlace == 1)
                  <td>KD Surat</td>
                  @elseif($payment_val->CollectionPlace == 2)
                  <td>KD Lucknow</td>
                  @else
                  <td>ElationSoft</td>
                  @endif
                  <td>{{$payment_val->CollectedBy}}</td>
                  <td>{{$payment_val->Deliverystatus}}</td>
                  <td>
                  <a href="#" title="View customer">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="update_studio" data-id="{{$payment_val->Payment_Id}}" data-toggle="modal" data-target="{{'#newModel'.$payment_val->Payment_Id}}" title="Update payment">
                      <i class="far fa-edit"></i>
                    </a> 
                    <div class="modal fade" id="{{'newModel'.$payment_val->Payment_Id}}" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Update Payment</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button> 
                          </div>
                          <div class="modal-body">
                            <form method="post" action="{{url('admin/paymentdetails?update='.$payment_val->Payment_Id)}}">
                              {{csrf_field() }}
                              <div class="form-group">
                                <label for="paymentdate">Payment Date:</label>
                                <input type="text" class="form-control" name="paymentdate" value="{{$payment_val->PaymentDate}}">
                              </div>
                              <div class="form-group">
                                <label for="SubscriptionTenure">Subscription Tenure:</label>
                                <input type="text" class="form-control" name="SubscriptionTenure" value="{{$payment_val->SubscriptionTenure}}">
                              </div>
                              <div class="form-group">
                                <label for="StartDate">Start Date:</label>
                                <input type="text" class="form-control" name="StartDate" value="{{$payment_val->StartDate}}">
                              </div> 
                              <div class="form-group">
                                <label for="ExpiryDate">Expiry Date:</label>
                                <input type="text" class="form-control" name="ExpiryDate" value="{{$payment_val->ExpiryDate}}">
                              </div>
                              <div class="form-group">
                                <label for="Studio_id">Studio Id:</label>
                                <input type="text" class="form-control" name="Studio_id" value="{{$payment_val->Studio_id}}">
                              </div>
                              <div class="form-group">
                                <label for="AmountPaid">Amount Paid:</label>
                                <input type="text" class="form-control" name="AmountPaid" value="{{$payment_val->AmountPaid}}">
                              </div>
                              <div class="form-group">
                                <label for="StudioMobileNumber">Studio Mob.No.:</label>
                                <input type="text" class="form-control" name="StudioMobileNumber" value="{{$payment_val->StudioMobileNumber}}">
                              </div>
                               <div class="form-group">
                                <label for="PayMethod">Payment Option:</label>
                                @if($payment_val->PaymentMethord == 1)
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="1" checked>Online
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="2">Bank Deposite
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="3">At Counter(Cash)
                                </label>
                                @elseif($payment_val->PaymentMethord == 2)
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="1">Online
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="2" checked>Bank Deposite
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="3">At Counter(Cash)
                                </label>
                                @else
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="1">Online
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="2">Bank Deposite
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PayMethod" value="3" checked>At Counter(Cash)
                                </label>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="PaymentStatus">Status:</label>
                                @if($payment_val->PaymentStatus == 0)
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="0" checked>Pending
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="1">Success
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="2">Failed
                                </label>
                                @elseif($payment_val->PaymentStatus == 1)
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="0">Pending
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="1" checked>Success
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="2">Failed
                                </label>
                                @else
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="0">Pending
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="1">Success
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="PaymentStatus" value="2" checked>Failed
                                </label>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="functiondate">Remark:</label>
                                <textarea class="form-control" name="remark">{{$payment_val->Remark}}</textarea>
                              </div>
                               <div class="form-group">
                                <label for="status">Delivery Status:</label>
                                @if($payment_val->Deliverystatus == 'pending')
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="pending" checked>Pending
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="websitedeliver">Website Delivered
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="softwaredeliver">Software Delivered
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="hosting">Hosting
                                </label>
                                @elseif($payment_val->Deliverystatus == 'websitedeliver')
                                <input type="radio" name="status" value="pending">Pending
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="websitedeliver" checked>Website Delivered
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="softwaredeliver">Software Delivered
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="hosting">Hosting
                                </label>
                                @elseif($payment_val->Deliverystatus == 'softwaredeliver')
                                <input type="radio" name="status" value="pending">Pending
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="websitedeliver">Website Delivered
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="softwaredeliver" checked>Software Delivered
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="hosting">Hosting
                                </label>
                                @elseif($payment_val->Deliverystatus == 'hosting')
                                <input type="radio" name="status" value="pending">Pending
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="websitedeliver">Website Delivered
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="softwaredeliver">Software Delivered
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="status" value="hosting" checked>Hosting
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