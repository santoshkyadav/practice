@extends('layouts.user_dashboard')
@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
         <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{url('user_dashboard')}}">Dashboard</a>
                  </li>
                   <li class="breadcrumb-item">
                    <a href="{{url('user_dashboard/templatesummary')}}">Template Summary</a>
                  </li>
                  <li class="breadcrumb-item active">Templates</li>
                </ol>

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-12 xl-12">
                    <div class="card-header">
                        <i class="fas fa-table"></i>template
                        <a href="{{url('user_dashboard/templatesummary')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a>
                       </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Template Name</th>
                                        <th>Image</th>
                                        <th>File Size</th>
                                        <th>Template Type</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $template_path = Config::get('app.TEMPLATE_PATH');
                                    @endphp
                                    @foreach($template as $item)
                                    <tr>
                                        <td id="template_name">{{$item->template_name}}</td>
                                        <td id="template_image"><img src="{{$template_path.$item->imagename}}" class="img-thumbnail table_image" alt="Template image"></td>
                                        <td id="template_size">{{$item->size}} MB</td>
                                        <td>{{$item->template_type}}</td>
                                        <td>
                                            <a href="{{$template_path.$item->file_name}}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Template Download">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
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
