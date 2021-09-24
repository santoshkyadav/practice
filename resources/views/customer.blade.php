@extends('layouts.customer')
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
    @php
    $imageselect = DB::table('tblfunctiondetail')
    ->where(['Customer_id' => $customer_id, 'Studio_Id' => $studio_id, 'Function_id' => $customer_details->id, 'Status' => '1'])->get();
    $countimg = count($imageselect); 
    @endphp
    <div class="cont_images row" style="background-color: #8e204e; color: #fff; height:45px;" >
      <h3 class="col-sm-9 image_name">Images </h3><span class="total_image float-right col-sm-3" style="text-align: right; padding-top: 10px; font-weight: 600;">Selected Images: {{$countimg}}/{{$customer_details->ImageCount}} </span>
    </div>
    @else
    <div class="cont_images row" style="background-color: #8e204e; color: #fff;">
      <h3 class="col-sm-9 image_name">Images </h3><span class="total_image float-right col-sm-3" style="text-align: right; padding-top: 10px; font-weight: 600;">Total Images: 0</span>
    </div>
    @endif

    <div class="row" id="photo_Div" style="margin-top: 30px;">

    </div>
    <!-- <div class="pagination"><a href="#" class="prev paging"><i class="fas fa-angle-double-left"></i> Prev</a>
      <a href="#" class="next paging">Next <i class="fas fa-angle-double-right"></i></a></div> -->

      <!-- Final selection Modal-->
      <div class="modal fade" id="finalselectedModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Final Submission of Selected Images.</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body"><h3>Are you Sure?</h3><p>Your selected images are saved for further process. If you want to select more images click Cancel button. </p></div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary final_select" data-dismiss="modal" data-id="{{$customer_details->customer_id}}" data-studio_id="{{$customer_details->Studio_Id}}" href="#">Selected</a>
            </div>
          </div>
        </div>
      </div>
      <!-- --------------Model end------------------ -->
    </div>
   
  </div>

   <!-- comment Modal-->
      <div class="modal fade" id="finalselectedModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Final Submission of Selected Images.</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body"><h3>Are you Sure?</h3><p>Your are no longer eligible to  login again. And your selected images are saved for further process. </p></div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary final_select" href="{{url('customer/logout')}}">Selected</a>
            </div>
          </div>
        </div>
      </div>
      <!-- --------------Model end------------------ -->
      <!-- The Image Modal -->
<div id="myModal" class="modal">
  <span class="close1">&times;</span>
  <img class="modal-content" id="img01" src="">
  <div id="caption"></div>
</div>
<!-- end model  -->
  
  @php
  $session = Session::all();
  $customer_mobile = $session['username'];
  $studio_id = $session['studio_id'];
  $mob_no = DB::table('studio')->select('mobile_no')->where('id', '=', $studio_id)->get();
  $mobile_studio = $mob_no[0]->mobile_no;
  @endphp

  @endsection
  @section('js')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
    //=========DISPLAY IMAGES ACCORDING TO EVENT======= //
    $('.event_Photos').on('click', function () {
      var folder_name = $(this).data('name');

//        alert(folder_name);
$.ajax({
  type: 'POST',
  url: 'functionPhotos',
  data: {
    'event_name': folder_name
  },
  headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
  },
  success: function (data) {
    var res = $.parseJSON(data);
            // console.log(res);
            if (res.status === 'error') {
              swal('Error', res.message, 'error');
              $('#photo_Div').html('');
            } else {
              var result = res.result;
              console.log(result);
              $('#photo_Div').html('');
              $.each(result, function (i, item)
              {
                var studio_mob = '{{$mobile_studio}}';
                var customer_username = '{{$customer_mobile}}';
                function pad (str, max) {
                  str = str.toString();
                  return str.length < max ? pad("0" + str, max) : str;
                }
                var function_id = pad(item.Function_id, 6);
                var val = '{{Config::get('app.image_path')}}';
                var src = val + studio_mob +'/'+ customer_username +'/'+ function_id +'/'+ item.FolderName ;


                if (item.Status === '1') {
                  var html = '<div class="col-md-3 sm-10" style="margin-top:10px;"><div id="card_' + item.ImageId + '" class="card cancel_card"><img class="card-img-top" id="image_' + item.ImageId + '" src="' + src + '/' + item.FileName + '" alt="Card image cap" onclick=showImage(' + item.ImageId + ')><div class="card-body"><div class="photo_sel_btn" data-id="' + item.ImageId + '"><button type="button" data-toggle="modal" data-target="#commentbtn_' + item.ImageId + '" data-placement="bottom" class="comment_btn" ><i class="far fa-comments"></i></button><button class="select_btn selected_btn" id="select_btn_' + item.ImageId + '" onclick=selectPhoto(' + item.ImageId + ')><i class="fa fa-times"></i></button></div></div></div> <div class="modal fade" id="commentbtn_' + item.ImageId + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Comment</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body" id="comment_Div' + item.ImageId + '"><label>Comment:</label><input type="text" class="form-control add_comment" placeholder="Add Comment" value="' + item.Comment + '" aria-label="Search" aria-describedby="basic-addon2"></div><div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button><button class="btn btn-primary comment_done" data-dismiss="modal" onclick=commentPhoto(' + item.ImageId + ')>OK</button></div></div></div></div>';
    //$('#select_btn_' + item.FunctionId).addClass('selected_btn');
  } else {
    var html = '<div class="col-md-3 sm-10" style="margin-top:10px;"><div class="card" id="card_' + item.ImageId + '"><img class="card-img-top" id="image_' + item.ImageId + '" src="' + src + '/' + item.FileName + '" alt="Card image cap" onclick=showImage(' + item.ImageId + ')><div class="card-body"><div class="photo_sel_btn" data-id="' + item.ImageId + '"><button type="button" data-toggle="modal" data-target="#commentbtn_' + item.ImageId + '" data-placement="bottom" class="comment_btn"><i class="far fa-comments"></i></button><button class="select_btn" id="select_btn_' + item.ImageId + '" onclick=selectPhoto(' + item.ImageId + ')><i class="fa fa-check"></i></button></div></div></div> <div class="modal fade" id="commentbtn_' + item.ImageId + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Comment</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body" id="comment_Div' + item.ImageId + '"><label>Comment:</label><input type="text" class="form-control add_comment" placeholder="Add Comment" value="' + item.Comment + '" aria-label="Search" aria-describedby="basic-addon2"></div><div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button><button class="btn btn-primary comment_done" data-dismiss="modal" onclick=commentPhoto(' + item.ImageId + ') >OK</button></div></div></div></div>';
  }
  $('#photo_Div').append(html);
});
                //swal('Success',res.message,'success');
                // pagination();
              }
            },
            error: function (data) {
              swal('Error', data, 'error');
            }
          }).done(function(){
            $('.final_submit').css('display', 'block');
            $('#photo_Div').easyPaginate({
    paginateElement: '.sm-10',
    elementsPerPage: 48,
    effect: 'climb'
});
            $('.easyPaginateNav').not(':first').remove();
            // var count = $('.page').length;
            // $('.page').click(function(){
            //   var cd = $(this).text();
            //   if(cd == count){
            //     $('.final_submit').css('display', 'block');
            //   }
              
            // });
          });
        });

//========= datepicker in input type:text==== //
$(function () {
  $("#functiondate").datepicker({
    dateFormat: "yy-mm-dd",
    orientation: "bottom",
  });
});

//=========  block right click on images==== //
$(function () {
   $(this).bind("contextmenu", function (e) {
       e.preventDefault();
   });
});



//=========Tooltip=======//
$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

$('.function_data').on('click', function () {
    var functiondate = $('#functiondate').val();
    var functiontype = $('#functiontype').val();
    var functionname = $('#functionname').val();
    var otherremark = $('#otherremark').val();
    var function_id = $(this).data('id');
    // alert(function_id);
    $.ajax({
        type: 'POST',   
        url: 'customer_function_update',
        data: {
            function_date: functiondate, function_type: functiontype, function_name: functionname, other_remark: otherremark, function_id: function_id 
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function (data) {
            var res = $.parseJSON(data);
            console.log(res);
            if (res.status === 'error') {
                swal('Error', res.message, 'error');
                $('#photoDiv').html('');
            } else {
                var result = res.result;
                console.log(result);
//                $('#functiondate').val(result[0].function_date);
//                $('#functiontype').val(result[0].function_type);
//                $('#functionname').val(result[0].function_name);
//                $('#otherremark').val(result[0].other_remark);
                swal('Success', res.message, 'success');

            }
        },
        error: function (data) {
            swal('Error', data, 'error');
        }
    });
});


//=========COMMENT ON PICS==== //
function commentPhoto(id)
{
  var comment = $('#comment_Div' + id + ' input').val();
  var path = "Comment_photo";
  $.ajax({
    type: 'POST',
    url: path,
    data: {
      id: id,
      comment: comment,
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    success: function (data) {
      var res = $.parseJSON(data);
      if (res.status === 'error') {
        // swal('Error', res.message, 'error');
      } else {
//                $('#lastComment'+id+' span').html('Last Comment :'+comment);
$('#comment_Div' + id + ' input').val(comment);
$('#select_btn_' + id).addClass('selected_btn');
        $('#card_' + id).addClass('cancel_card');
        $("#select_btn_ " + id + "> i").removeClass('fa-check');
        $("#select_btn_" + id + " > i").addClass('fa-times'); 

        // swal('Success', res.message, 'success');
                //setTimeout(function(){ location.reload(); }, 3000);
              }
            },
            error: function (data) {
              swal('Error', data, 'error');
            }
          });
}

//=========SELECT PICS==== //
function selectPhoto(id)
{
  var path = "Select_photo";
  $.ajax({
    type: 'POST',
    url: path,
    data: {
      id: id,
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    success: function (data) {
      var res = $.parseJSON(data);
      if (res.status === 'error') {
        swal('Error', res.message, 'error');

      } else if (res.status === 'success') {
        $('#select_btn_' + id).addClass('selected_btn');
        $('#card_' + id).addClass('cancel_card');
        $("#select_btn_ " + id + "> i").removeClass('fa-check');
        $("#select_btn_" + id + " > i").addClass('fa-times');
        // swal('Success', res.message, 'success');
                //setTimeout(function(){ location.reload(); } , 3000);
              } else {
                $('#select_btn_' + id).removeClass('selected_btn');
                $('#card_' + id).removeClass('cancel_card');
                $("#select_btn_ " + id + "> i").removeClass('fa-times');
                $("#select_btn_" + id + " > i").addClass('fa-check');
                // swal('Warning', res.message, 'warning');
              }
            },
            error: function (data) {
              swal('Error', data, 'error');
            }
          });
}

function copyToClipboard() {
  // Create a "hidden" input
  var aux = document.createElement("input");
  // Assign it the value of the specified element
  aux.setAttribute("value", "Print Screen is not allowed.");
  // Append it to the body
  document.body.appendChild(aux);
  // Highlight its content
  aux.select();
  // Copy the highlighted text
  document.execCommand("copy");
  // Remove it from the body
  document.body.removeChild(aux);
  alert("Print screen disabled.");
}

$(window).keyup(function(e){
  if(e.keyCode == 44){
    copyToClipboard();
  }
}); 

//====================pagination==============//
// function pagination(){
//   var start = 0;
//   var nb = 20;
//   var end = start + nb;
//   var length = $('#photo_Div > div').length;
//   var list = $('#photo_Div > div');
//   list.hide().filter(':lt('+(end)+')').show();


//   $('.prev, .next').click(function(e){
//    e.preventDefault();
   
//    if( $(this).hasClass('prev') ){
//      start -= nb;
//    } else {
//      start += nb;
//    }

//    if( start < 0 || start >= length ) start = 0;
//    end = start + nb;       

//    if( start == 0 ) list.hide().filter(':lt('+(end)+')').show();
//    else list.hide().filter(':lt('+(end)+'):gt('+(start-1)+')').show();
//  });
// }

//==============Image heading change=================//
$('.sidebar_menu').click(function(){
  var event = $(this).text();
  $('.image_name').text('Images of ').append(event);
});

//==============Final selection of images=================//
// $('.final_select').click(function(){
//   $.ajax({
//    type:'POST',
//    url: 'finalsubmitmsg',
//    headers: {
//     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//   },
//   success: function(response){
//     console.log(response);
//   }
// });
// });

//==============Final selection of images msg to studio=================//
$('.final_select').click(function(){
  var id = $('.final_select').data('id');
  var studio_id = $('.final_select').data('studio_id');
  $.ajax({
   type:'POST',
   url: '../finalsubmitsync',
   data:{'id': id, 'studio_id': studio_id},
   headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
  },
  success: function(response){
    console.log(response);
  }
});
});

function showImage(id){
  
  // var a = $('#image_'+ id).attr('src'); 
  // alert(a);
  $('#myModal').css('display', 'block');
  var simg = $('#image_'+ id).attr('src');
  $('#img01').attr('src', simg); 
}
$('.close1').click(function(){
  $('#myModal').css('display', 'none');
});

</script>
@endsection
