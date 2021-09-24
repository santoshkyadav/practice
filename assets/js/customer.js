(function($) {
  "use strict"; // Start of use strict

//========= datepicker in input type:text==== //
$(function () {
    $("#functiondate").datepicker({
        dateFormat: "yy-mm-dd",
        orientation: "bottom",
    });
});

//=========  block right click on images==== //
//$(function () {
//    $(this).bind("contextmenu", function (e) {
//        e.preventDefault();
//    });
//});



// //=========Tooltip=======//
// $(document).ready(function () {
//     $('[data-toggle="tooltip"]').tooltip();
// });

// $('.function_data').on('click', function () {
//     var functiondate = $('#functiondate').val();
//     var functiontype = $('#functiontype').val();
//     var functionname = $('#functionname').val();
//     var otherremark = $('#otherremark').val();
//     var function_id = $(this).data('id');
//     // alert(function_id);
//     $.ajax({
//         type: 'POST',   
//         url: 'customer_function_update',
//         data: {
//             function_date: functiondate, function_type: functiontype, function_name: functionname, other_remark: otherremark, function_id: function_id 
//         },
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//         },
//         success: function (data) {
//             var res = $.parseJSON(data);
//             console.log(res);
//             if (res.status === 'error') {
//                 swal('Error', res.message, 'error');
//                 $('#photoDiv').html('');
//             } else {
//                 var result = res.result;
//                 console.log(result);
// //                $('#functiondate').val(result[0].function_date);
// //                $('#functiontype').val(result[0].function_type);
// //                $('#functionname').val(result[0].function_name);
// //                $('#otherremark').val(result[0].other_remark);
//                 swal('Success', res.message, 'success');

//             }
//         },
//         error: function (data) {
//             swal('Error', data, 'error');
//         }
//     });
// });

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
                swal('Success', res.message, 'success');
                //setTimeout(function(){ location.reload(); } , 3000);
            } else {
                $('#select_btn_' + id).removeClass('selected_btn');
                $('#card_' + id).removeClass('cancel_card');
                $("#select_btn_ " + id + "> i").removeClass('fa-times');
                $("#select_btn_" + id + " > i").addClass('fa-check');
                swal('Warning', res.message, 'warning');
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



  })(jQuery); // End of use strict

