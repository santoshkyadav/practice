@extends('layouts.admin')
  @section('content')
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Events</a>
          </li>
          <li class="breadcrumb-item active">Photos</li>
        </ol>
      </div>
      <div class="row">
        @foreach($allPhotos as $item)
        <div class="col-xl-4 sm-12 md-6" style="margin-top:10px;">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{url('storage/app/eventImages').'/'.$item->image }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$item->image}}</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="javascript:void(0);" class="btn btn-primary" title="Delete Photo" onclick=deletPhoto({{$item->id}})>Delete
              </a>
            </div>
          </div>
        </div>
        @endforeach
    </div>
      <!-- /.container-fluid -->
    @endsection
    @section('js')
    <script type="text/javascript">
    function deletPhoto(id)
    {
      var path = "../../photo_delete";
        var _this = $(this);
        swal({
          title: "Are you sure to delete this Photo?",
          text: "Your will lost all records of this Photo",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(isConfirm) {
          if (isConfirm) {
            var data = id;
            $.ajax({
              type: 'POST',
              url: path,
              data: {
                id: data,
              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
              success: function(data) {
                var res = $.parseJSON(data);
                if(res.status == 'error'){
                  swal('Error',res.message,'error');
                }else{
                   $('.sweet-overlay').remove();
                   $('.showSweetAlert ').remove();
                   swal('Success',res.message,'success');
                   setTimeout(function(){ location.reload(); }, 3000);
                   
                   
                    //$("#ResponseSuccessModal").modal('show');
                    //$("#ResponseSuccessModal #ResponseHeading").text(res.message);
                } 
              },
              error: function(data) {
                swal('Error',data,'error');
              }
            });
          } else {

          }
        });
    }
    </script>
    @endsection