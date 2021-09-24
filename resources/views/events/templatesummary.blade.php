@extends('layouts.user_dashboard')
@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
         <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{url('user_dashboard')}}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Template Summary</li>
                </ol>


        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-12 xl-12">
                    <div class="card-header">
                        <i class="fas fa-table"></i>template Summary
                        <a href="{{url('user_dashboard')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a>
                       </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Upload Date</th>
                                        <th>Template Type</th>
                                        <th>No of Template</th>
                                        <th>Total FileSize</th>
                                        <th>View Files</th>
                                    </tr>
                                </thead>
                            
                                <tbody>

                                    @if($templatesummary[0]->UploadDate == '')
                                     <tr>
                                        <td colspan= '4' style="text-align: center;"><i>No templates found in Table</i></td>
                                        
                                    </tr>
                                    @else
                                    @foreach($templatesummary as $item)
                                    <tr>
                                        @php
                                    $old_date = date_create($item->UploadDate);
                                       $date =  date_format($old_date,"d M Y");
                                    @endphp
                                        <td>{{$date}}</td>
                                        <td>{{$item->TemplateType}}</td>
                                        <td>{{$item->NoOfTemplate}}</td>
                                        <td>{{$item->TotalFileSize}} MB</td>
                                        <td>
                                            <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Event Photos" href="{{url('user_dashboard/templatesummary/template/'.$item->TemplateType)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

