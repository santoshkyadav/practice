<div id="wrapper" >
    <!-- Sidebar -->
    <div class="container-fluid sidebar1"> 

        <div class="form">
            @php
    $customer_id =$_REQUEST['customer_id'];
    $studio_id =$_REQUEST['studio_id'];
    $function_id = $_REQUEST['function_id'];
    $customer_details = DB::table('mstfunction')
    ->where(['Customer_id' => $customer_id, 'Studio_Id' => $studio_id])
    ->ORDERBY('FunctionDate', 'DESC')
    ->first();
    @endphp
    @if(!empty($customer_details))

            <label for="functiondate" class="col-md-6 col-form-label">Function Date:</label>
            
            <input type="text" class="form-control function_type" id="functiondate" placeholder="Function Date" value="{{$customer_details->FunctionDate}}">
            
            <label for="functiontype" class="col-md-6 col-form-label">Function Type:</label>
            
            <input type="text" class="form-control function_type" id="functiontype" placeholder="Function Type" value="{{$customer_details->FunctionType}}">

            <label for="functionname" class="col-md-6 col-form-label">Function Name:</label>

            <input type="text" class="form-control function_type" id="functionname" placeholder="Function Name" value="{{$customer_details->AlbumName}}">


            <label for="otherremark" class="col-md-6 col-form-label">Other Remark:</label>
            
            <input type="text" class="form-control function_type" id="otherremark" placeholder="Other Remark" value="{{$customer_details->Remark}}">

            <button type="submit" data-id="{{$customer_details->id}}" class="function_data">Update</button>
            @else

                <label for="functiondate" class="col-md-6 col-form-label">Function Date:</label>
            
            <input type="text" class="form-control function_type" id="functiondate" placeholder="Function Date">
            
            <label for="functiontype" class="col-md-6 col-form-label">Function Type:</label>
            
            <input type="text" class="form-control" id="functiontype" placeholder="Function Type">

            <label for="functionname" class="col-md-6 col-form-label">Function Name:</label>

            <input type="text" class="form-control" id="functionname" placeholder="Function Name">


            <label for="otherremark" class="col-md-6 col-form-label">Other Remark:</label>
            
            <input type="text" class="form-control" id="otherremark" placeholder="Other Remark">

            <button type="submit" data-id="{{$customer_details->id}}" class="function_data">Update</button>
     @endif

        </div>

     <div class="final_image_select"><button class="btn btn-primary final_submit" data-toggle="modal" data-target="#finalselectedModel">Upload All Selected Images</button></div>


    <div class="main_menu">
        <ul class="sidebar navbar-nav cust_sidebar" style="background-color: #8e204e  !important">
            <li class="nav-item user_nev"> Folders
                @php
                $customer_id = Session::get('customer_id');
                $studio_id = Session::get('studio_id');
                $function = DB::table('mstfunction')
                ->where(['Customer_id' => $customer_id, 'Studio_Id' => $studio_id])
                ->ORDERBY('FunctionDate', 'DESC')
                ->first();
                $photosummary = DB::table('customerphotosummary')
                ->where(['Customer_id' => $customer_id,
                'Studio_Id' => $studio_id, 'Function_id' => $function->id])
                ->get()->toArray();
                @endphp
                <ul>
                    @foreach($photosummary as $photocount)
                    @if($photocount->SelectedPhoto === 0)
                    <li class="nav-item user_nev event-names">
                        <a href="#" class="nav-link event_Photos" title="View Photos" data-name="{{$photocount->FolderName}}"> 
                            <img src="{{url('assets/image/Toma4025-Rumax-Folder.ico')}}" style="width: 60px;"><span class="sidebar_menu" style="padding-left: 10px;">{{ucfirst($photocount->FolderName)}}</span><span class="count_pics">{{$photocount->NoofPhoto}}</span> 
                        </a>
                    </li>
                    @else
                    <li class="nav-item user_nev event-names">
                        <a href="#" class="nav-link event_Photos" title="View Photos" data-name="{{$photocount->FolderName}}"> 
                            <img src="{{url('assets/image/Toma4025-Rumax-Folder.ico')}}" style="width: 60px;"><span class="sidebar_menu" style="padding-left: 10px;">{{ucfirst($photocount->FolderName)}}</span><span class="count_pics">{{$photocount->SelectedPhoto.'/'.$photocount->NoofPhoto}}</span> 
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>   
            </li> 
        </ul>
    </div>
</div>
<!-- end container -->