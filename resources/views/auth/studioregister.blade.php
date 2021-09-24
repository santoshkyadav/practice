@extends('layouts.app')
@section('content')
<script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript">
     // alert("Ok");
      $(document).ready(function(){
        $("#input").hide();
         //alert("Ok");
       $("#rdo3").click(function(){
      
            //alert("Ok"):
            if($(this).is(":checked"))
            {
                
               $("#input").show();
          
            }
            else
            {
               $("#input").hide();
            }

         });
       $("#rdo1").click(function(){
            //alert("Ok"):
            if($(this).is(":checked"))
            {
                $("#input").hide();
            }
            
         });
       $("#rdo2").click(function(){
            //alert("Ok"):
            if($(this).is(":checked"))
            {
                $("#input").hide();
            }

            
         });
       



      });
  </script>

  

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registerStudio') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('studio_name') ? ' has-error' : '' }}">
                            <label for="studio_name" class="col-md-4 control-label">Studio Name</label>

                            <div class="col-md-6">
                                <input id="studio_name" type="text" class="form-control" name="studio_name" value="{{ old('studio_name') }}">

                                @if ($errors->has('studio_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('studio_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                            <label for="mobile_no" class="col-md-4 control-label">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="text" class="form-control" name="mobile_no">

                                @if ($errors->has('mobile_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div
                        
                        <div class="form-group{{ $errors->has('distributer') ? ' has-error' : '' }}">
                            <label for="distributer" class="col-md-4 control-label">Select Distributer</label>

                            <div class="col-md-6">
                                <select class="form-control" name="distributer" >
                                    <option value="">Select distributer</option>
                        
                            @foreach($users as $user)
                            <option value="{{$user->distributer_id}}">{{$user->name}}</option>
                            @endforeach
                                  
                                    

                                </select>

                                @if ($errors->has('distributer'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('distributer') }}</strong>
                                </span>
                                @endif
                            </div>

                        
                            
                        
                        
                        <div class="form-group{{ $errors->has('software') ? ' has-error' : '' }}" >
                            <label for="software" class="col-md-4 control-label">Meri Photo Book</label> 

                            <div class="col-md-6" >
                                <input type="radio" name="software" value="50book" id="rdo1" on check="radio1()"><b>50 Book</b>
                                <input type="radio" name="software" value="100book" id="rdo2"><b>100 Book</b>
                                <input type="radio" id="rdo3" name="software" value=""><b>Other</b>
                                
                                <input type="text" name="software" id="input" >
                                
                                 @if ($errors->has('50software'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('50software') }}</strong>
                                </span>
                                @endif
                                @if ($errors->has('100software'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('100software') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('collectedby') ? ' has-error' : '' }}">
                            <label for="collectedby" class="col-md-4 control-label">Collected By</label>

                            <div class="col-md-6">
                               
                                     <select class="form-control" name="collectedby" >
                                    <option value="">Select Employee</option>
                                     @php 
                              $res=DB::table('distributor')->where('type','=','user')->get();
                            //print_r($res[0]->name);


                              @endphp
                                  @foreach($res as $user)

                               <option value="{{$user->name}}">{{$user->name}}</option>     
                                   @endforeach
                                 </select>
                                    
                                @if ($errors->has('collectedby'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('collectedby') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div> 
                        

                        
                        <div class="form-group{{ $errors->has('remark') ? ' has-error' : '' }}">
                            <label for="remark" class="col-md-4 control-label">Remark</label>

                            <div class="col-md-6">
                                <input id="remark" type="text" class="form-control" name="remark">

                                @if ($errors->has('remark'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('remark') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount Paid</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount">

                                @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control" name="address"></textarea>
                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city">

                                @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">State</label>

                            <div class="col-md-6">
                                
                                <select class="form-control" name="state" >
                                    <option value="Selected">Select State</option> 
                                    <option value="andhrapradesh">Andhra Pradesh</option>
                                     <option value="arunachalpradesh">Arunachal Pradesh</option>
                                     <option value="assam">Assam</option>
                                      <option value="bihar">Bihar</option>
                                       <option value="chhattisgarh">Chhattisgarh</option>
                                       <option value="goa">Goa</option> 
                                    <option value="gujarat">Gujarat</option>
                                     <option value="haryana">Haryana</option>
                                     <option value="himachalpradesh">Himachal Pradesh</option>
                                      <option value="jammukashmir">Jammu and Kashmir</option>
                                       <option value="jharkhand">Jharkhand</option>
                                       <option value="karnataka">Karnataka</option> 
                                    <option value="kerala">Kerala</option>
                                     <option value="madhyapradesh">Madhya Pradesh</option>
                                     <option value="maharashtra">Maharashtra</option>
                                      <option value="manipur">Manipur</option>
                                       <option value="meghalaya">Meghalaya</option>
                                       <option value="mizoram">Mizoram</option> 
                                    <option value="nagaland">Nagaland</option>
                                     <option value="odisha">Odisha</option>
                                     <option value="Punjab">Punjab</option>
                                      <option value="Rajasthan">Rajasthan</option>
                                       <option value="Sikkim">Sikkim</option>
                                       <option value="tamilnadu">Tamil Nadu</option> 
                                    <option value="Telangana">Telangana</option>
                                     <option value="Tripura">Tripura</option>
                                     <option value="uttarakhand">Uttarakhand</option>
                                      <option value="uttarpradesh">Uttar Pradesh</option>
                                       <option value="Westbengal">West Bengal</option>
                                       <option value="Andaman">Andaman and Nicobar Islands</option> 
                                    <option value="Chandigarh">Chandigarh</option>
                                     <option value="dadra">Dadra and Nagar Haveli</option>
                                     <option value="daman">Daman and Diu</option>
                                      <option value="delhi">Delhi</option>
                                       <option value="Lakshadweep">Lakshadweep</option>
                                       <option value="Puducherry">Puducherry</option> 
                                </select>

                                @if ($errors->has('state'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="regbtn">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('customer_template.footer')
    @endsection

