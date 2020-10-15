
$(document).ready(function () {
  
  /*  $( function() {
        $( "#datepicker" ).datepicker();
      } );
*/
    jQuery('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        //endDate: new Date
    });
    jQuery('.monthpicker').datepicker({
        format: 'mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        minViewMode: "months"
    });
    jQuery('.datetimepicker').datetimepicker({
//language:  'fr',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    $('#monthpicker').datepicker({
        pickDate: false,
        format: "mm-yyyy",
        maxViewMode: "months",
        icons: {
            leftArrow: '<i class="fa fa-angle-right"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>',
        }
    });

    // $('#monthpicker').on('changeDate', function() {
    //     $('#my_hidden_input').val(
    //         $('#monthpicker').datepicker('getFormattedDate')
    //     );

    // });

});


function select_upload_file(id){
    $("#upload"+id).click();
}

function upload(id){
    $("#upload_data"+id).submit();
}

function readImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#img_div").show();
            $('#img_upload')
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function deleteImage(){
    $("#img_div").hide();
    $('#img_upload').attr('src',"");
    $("input[type='file']").val("");
}