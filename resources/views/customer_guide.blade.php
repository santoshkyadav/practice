@extends('layouts.customer_guide')
@section('content')
<div class="container">
	<h1>User Guide</h1>
<a href="{{url('customer/home-page?studio_id='.$functiondetail[0]->Studio_Id.'&customer_id='.$functiondetail[0]->customer_id.'&function_id='.$functiondetail[0]->id)}}"><button class="homepage">Home page</button></a></div>
@endsection
