@extends('layouts.user_dashboard')
@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
         <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{url('user_dashboard')}}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Softwares</li>
                </ol>

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-12 xl-12">
                    <div class="card-header">
                        <i class="fas fa-table"></i>Softwares
                        <a href="{{url('user_dashboard')}}"class="back-icon float-right">Back <i class="fa fa-undo" aria-hidden="true"></i></a>
                       </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Software Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- <tfoot>
                                  <tr>
                                    <th>ID</th>
                                    <th>Event Name</th>
                                    <th>Created date</th>
                                  </tr>
                                </tfoot> -->
                                <tbody>
                                    @php
                                    $software_path = Config::get('app.SOFTWARE_PATH');
                                    @endphp
                                    @foreach($software as $item)
                                    <tr>
                                        <td>{{$item->sw_name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>
                                            <a href="{{$software_path.$item->file_name}}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Software Download">
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