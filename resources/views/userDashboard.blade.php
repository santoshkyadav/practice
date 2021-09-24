<!DOCTYPE HTML>
<html>
<head>
<title>japware.com</title>
 <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<meta name="keywords" content="Ultra Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="{{url('assets/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{url('assets/css/style (2).css')}}" rel='stylesheet' type='text/css' />
<!-- <link href="{{url('assets/css/style.css')}}" rel='stylesheet' type='text/css' /> -->
<link href="{{url('assets/css/sb-admin.css')}}" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="{{url('assets/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!--skycons-icons-->
<script src="{{url('assets/jss/skycons.js')}}"></script>
<!--//skycons-icons-->

 <!-- js-->
  <script src="{{url('assets/jss/bootstrap.js')}}"></script>
<script src="{{url('assets/jss/jquery-1.11.1.min.js')}}"></script>
<script src="{{url('assets/jss/modernizr.custom.js')}}"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Comfortaa:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Muli:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
<!--//webfonts-->  
<!-- Metis Menu -->
<script src="{{url('assets/jss/metisMenu.min.js')}}"></script>
<script src="{{url('assets/jss/custom.js')}}"></script>
<link href="{{url('assets/css/custom (2).css')}}" rel="stylesheet">
<!--//Metis Menu -->
<link href="{{url('assets/css/jquerysctipttop.css')}}" rel="stylesheet" type="text/css">
<script src="{{url('assets/jss/jquery.sparkline.min.js')}}"></script>

</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<div class="sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right dev-page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" id="cbp-spmenu-s1">
					<div class="scrollbar scrollbar1">
						<ul class="nav" id="side-menu">
							<li>
								<a href="{{url('/user_dashboard')}}" class="active"><i class="fa fa-home nav_icon"></i>Dashboard</a>
							</li>
							<li>
								<a href="{{url('user_dashboard/templatesummary')}}"><i class="fa fa-file-text-o nav_icon"></i>Download Template <span class="fa arrow"></span></a>
								<!-- /nav-second-level -->
							</li>
							
							<li>
								<a href="{{url('user_dashboard/software')}}" class="chart11-nav"><i class="fa fa-cogs nav_icon"></i>Download Software<span class="fa arrow"></span></a>
								<!-- //nav-second-level -->
							</li>
							<li>
								<a href="{{url('user_dashboard/clientdetail')}}" class="chart11-nav"><i class="fa fa-book nav_icon"></i>Client Details<span class="fa arrow"></span></a>
								<!-- //nav-second-level -->
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#myModal1" class="chart11-nav"><i class="fa fa-credit-card nav_icon"></i>Make Payment<span class="fa arrow"></span></a>
								<!-- //nav-second-level -->
							</li>
							
						</ul>
					</div>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--logo -->
				@php
    $session = Session::all();
    @endphp
				<div class="logo">
					<a href="{{url('/user_dashboard')}}"><h2>{{$session['studio_name']}}</h2></a>
				</div>
				<!--//logo-->
				<div class="user-right">
					<div class="profile_details_left"><!--notifications of menu start -->
						<div class="profile_details">		
							<ul>
								<li class="dropdown profile_details_drop">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<div class="profile_img">	
											<span class="prfil-img"><img src="{{url('assets/image/a.png')}}" alt=""> </span> 
											<div class="clearfix"></div>	
										</div>	
									</a>
									<ul class="dropdown-menu drp-mnu">
										<li> <a href="{{url('studioLogout')}}"><i class="fa fa-sign-out"></i> Logout</a> </li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="profile_medile"><!--notifications of menu start -->
				
			</div>
			<div class="header-right">
					<!--toggle button start-->
					<div class="search-box">
					<!-- <form class="input">
						<input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31">
					</form> -->
				</div>
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<div class="clearfix"> </div>
				<!--toggle button end-->
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		@if (session('error'))
	<div class="alert alert-danger" role="alert">
		<strong>{{ session('error') }}</strong>
	</div>
	@endif
		<div id="page-wrapper">
			<div class="main-page">
				<div class="four-grids">
				@php
							$session = Session::all();
							$customers = DB::table('mstcustomer')->where('studio_id', '=',$session['studio_id'])->get();
							$totalcustomer = count($customers);
							$total_images = DB::table('tblfunctiondetail')->where('Studio_Id', '=', $session['studio_id'])->get();
							$total_count = 0;
							foreach($total_images as $function_id){
							$total_count++;
						}
						@endphp
					<div class="col-md-3 four-grid">
						<div class="four-grid1">
							<div class="icon">
								<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Customer</h3>
								<h4> {{$totalcustomer}}  </h4>
								<p> <span class="inlinebar"></span> </p>
							</div>
							<a href="{{url('user_dashboard/clientdetail')}}">More Info</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid2">
							<div class="icon">
								<i class="glyphicon glyphicon-picture" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Images Sharing</h3>
								<h4>{{$total_count}}</h4>
								<p> <span class="inlinebar"></span> </p>
							</div>
							<a href="#">...</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid3">
							<div class="icon">
								<i class="glyphicon glyphicon-calendar" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Expiry Date</h3>
								<h4>Trial Period</h4>
								<p> <span class="inlinebar"></span> </p>
							</div>
							<a href="#">...</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid4">
							<div class="icon">
								<i class="glyphicon glyphicon-book" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>EBook Sharing</h3>
								<h4>0</h4>
								<p><span class="dynamicbar"></span></p>
							</div>
							<a href="#">More Info</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="four-grids" id="down">
				    <h2 class="temp_downloads">Downloads</h2>
				    <div class="clearfix"></div>
				</div>
				<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-grid2">
							<div class="icon">
								<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Ebook </h3>
								
								<p> <span class="inlinebar"></span> </p>
							</div>
							<a href="{{url('user_dashboard/templatesummary/template/CLIPART')}}">More Info</a>
						</div>
					</div>
					
					
					
					
					<div class="clearfix"></div>
				</div>
				<div class="four-grids">
				    <h2 class="temp_downloads">Supporting System</h2>
				    <div class="clearfix"></div>
				</div>
				<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-grid2">
							<div class="icon">
								<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>.Net Framework 3.5</h3>
								
								<p> <span class="inlinebar"></span> </p>
							</div>
							<a href="#">Download</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid3">
							<div class="icon">
								<i class="glyphicon glyphicon-align-justify" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<!--
							@php
						$template = DB::table('template')->get();
						$totalcount = count($template);
						@endphp
					-->
								<h3>.Net Framework 4.0</h3>
								
								<p> <span class="inlinebar"></span> </p>
							</div>
							<a href="#">Download</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid4">
							<div class="icon">
								<i class="glyphicon glyphicon-book" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>.Net Framework 4.5</h3>
								
								<p><span class="dynamicbar"></span></p>
							</div>
							<a href="#">Download</a>
						</div>
					</div>
					
					
					<div class="clearfix"></div>
				</div>
				
			<div class="copy-section">
		<p>Copyright © Japware.com</p>
		</div>
	</div>
			<!-- Classie -->
				<script src="{{url('assets/jss/classie.js')}}"></script>
				<script>
					var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
						showLeftPush = document.getElementById( 'showLeftPush' ),
						body = document.body;
						
					showLeftPush.onclick = function() {
						classie.toggle( this, 'active' );
						classie.toggle( body, 'cbp-spmenu-push-toright' );
						classie.toggle( menuLeft, 'cbp-spmenu-open' );
						disableOther( 'showLeftPush' );
					};
					

					function disableOther( button ) {
						if( button !== 'showLeftPush' ) {
							classie.toggle( showLeftPush, 'disabled' );
						}
					}
				</script>
			<!-- Bootstrap Core JavaScript --> 
				
				<script type="text/javascript" src="{{url('assets/jss/bootstrap.min.js')}}"></script>
				<!--scrolling js-->
				<script src="{{url('assets/jss/jquery.nicescroll.js')}}"></script>
				<script src="{{url('assets/jss/scripts.js')}}"></script>
				
				<!--//scrolling js-->
				<div class="modal fade" id="myModal1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Studio Details</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button> 
									</div>
									<div class="modal-body">
										@php
										$studio = DB::table('studio')->where('id', '=', $session['studio_id'])->get();

										@endphp
										<form method="post" action="{{url('payment')}}">
											{{csrf_field() }}
											<div class="form-group">
												<label for="studio_name">Studio Name:</label>
												<input type="text" class="form-control" name="studio_name" value="{{$studio[0]->studio_name}}">
											</div>
											<div class="form-group">
												<label for="mob_no">Mobile Number:</label>
												<input type="text" class="form-control" name="mob_no" value="{{$studio[0]->mobile_no}}">
											</div>
											
											<label for="paid_for">Select amount paid for:</label>
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
											
											<div class="form-group">
												<label for="paid_for">Collection place: </label>
												<label class="radio-inline">
													<input type="radio" name="collection" value="1" checked>KD Surat
												</label>
												<label class="radio-inline">
													<input type="radio" name="collection" value="2">KD Lucknow
												</label>
												<label class="radio-inline">
													<input type="radio" name="collection" value="3">ElationSoft
												</label>
											</div>
											<div class="form-group">
												<label for="collectedby">Collected By:</label>
												<input type="text" class="form-control" name="collectedby" placeholder="Name">
											</div>
											<div class="form-group">
												<label for="remark">Remark:</label>
												<input type="text" class="form-control" name="remark" placeholder="Remark">
											</div>
											<div class="form-group">
												<label for="payment_mode">Payment Mode: </label>
												<label class="radio-inline">
													<input type="radio" name="payment" value="1" checked>Online
												</label>
												<label class="radio-inline">
													<input type="radio" name="payment" value="2">Bank Deposite
												</label>
												<label class="radio-inline">
													<input type="radio" name="payment" value="3">At counter(Cash)
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
												<label for="state">Amount:</label>
												<input type="text" class="form-control" name="amount" id="amount" placeholder="0.00">
												@if ($errors->has('amount'))
												<span class="help-block">
													<strong>{{ $errors->first('amount') }}</strong>
												</span>
												@endif
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">MAKE PAYMENT</button>
										</form>
									</div>
								</div>
							</div>
						</div>

			<!-- //Register -->
<script type="text/javascript">
		$('#payment_tenure').on('change', function(){
			var selected_month = $('#payment_tenure').val();
			var moneytopay = '{{Config::get('app.payment_money')}}';
			var installment_money = moneytopay/selected_month;
			$('#amount').val(installment_money);

		});
	</script>

</body>
</html>
