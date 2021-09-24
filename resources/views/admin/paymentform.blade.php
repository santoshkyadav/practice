@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="panel panel-default form_field">
      <div class="panel-heading"><h2>Payment Form</h2></div>
      <div class="panel-body">
       <!-- form -->
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
      <form id="payment_form" method="post" action="{{url('admin/formsubmit')}}">
        {{csrf_field()}}
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="studio_name">Studio Name </label>
            <input type="text" class="form-control" id="studio_name" name="studio_name" placeholder="Studio Name">
          </div>
          <div class="form-group col-md-6">
            <label for="mobile_no">Mobile Number</label>
            <input type="text-center" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile Number">
          </div>
        </div>
        <label for="paid_for">Select amount paid for</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="paidfor[]" value="photoselectsoft" checked>
          <label class="form-check-label" for="exampleRadios1">
            Photo Selection Software
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="paidfor[]" value="website">
          <label class="form-check-label" for="exampleRadios2">
            Website 
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="checkbox" name="paidfor[]"  value="designsoft">
          <label class="form-check-label" for="exampleRadios3">
            Design Software
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="checkbox" name="paidfor[]"  value="ebook">
          <label class="form-check-label" for="exampleRadios3">
            Ebook
          </label>
        </div>

        <label for="paid_for">Collection place</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="collection"  value="1" checked>
          <label class="form-check-label" for="collection">
            KD Surat
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="collection"  value="2">
          <label class="form-check-label" for="collection">
            KD Lucknow
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="collection"  value="3">
          <label class="form-check-label" for="collection">
            ElationSoft
          </label>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="collectedby">Collected By </label>
            <input type="text" class="form-control" id="collectedby" name="collectedby" placeholder="Name">
          </div>
          <div class="form-group col-md-6">
            <label for="remark">Remark</label>
            <input type="text-center" class="form-control" id="remark" name="remark" placeholder="Remark">
          </div>
        </div>
        <div class="form-group">
          <label for="payment_mode">Payment Mode: </label>
          <label class="radio-inline">
            <input type="radio" name="payment" value="1">Online
          </label>
          <label class="radio-inline">
            <input type="radio" name="payment" value="2">Bank Deposite
          </label>
          <label class="radio-inline">
            <input type="radio" name="payment" value="3" checked>At counter(Cash)
          </label>
        </div>
        <div class="form-group">
          <label for="payment_tenure">Payment tenure:</label>
          <select class="form-control" id="payment_tenure" name="payment_tenure">
            <option>Choose months</option>
            <option value="1">1 month</option>
            <option value="2">2 month</option>
            <option value="3">3 month</option>
            <option value="4">4 month</option>
            <option value="5">5 month</option>
            <option value="6">6 month</option>
            <option value="7">7 month</option>
            <option value="8">8 month</option>
            <option value="9">9 month</option>
            <option value="10">10 month</option>
            <option value="11">11 month</option>
            <option value="12">12 month</option>
          </select>
        </div>
        <div class="form-group">
          <label for="state">Amount Paid:</label>
          <input type="text" class="form-control" name="amount" id="amount" placeholder="0.00">
          @if ($errors->has('amount'))
          <span class="help-block">
            <strong>{{ $errors->first('amount') }}</strong>
          </span>
          @endif
        </div>
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </form>	
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