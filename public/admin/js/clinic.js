$(document).ready( function () {
    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":9 },
        ]
    });
    $('#specialties').select2();
    $('#facilities').select2();
    $('#lab_tests').select2();
    $('#medications').select2();
    $('#departments').select2();
    $('.dropify').dropify();
    $(':input').inputmask();
    $('#opening_time').datetimepicker({
        format: 'LT',
        pickDate: false,
        pickTime: true,
        stepping: 10
    })
    $('#closing_time').datetimepicker({
        format: 'LT',
        pickDate: false,
        pickTime: true,
        stepping: 10
    })
});

// Change Password From Clinic
function clinicChangePassword() {

    var checkBox = document.getElementById("change_password");
    var password = document.getElementById("password_box");
    var confirm_password = document.getElementById("confirm_password");

    if (checkBox.checked == true) {
        password.style.display = "block";
        confirm_password.style.display = "block";
        $("#password").attr('required',true);
        $("#confirm_password").attr('required',true);
    }
    else {
        password.style.display = "none";
        confirm_password.style.display = "none";
        $("#password").removeAttr('required');
        $("#confirm_password").removeAttr('required');
    }
}

// Change timing
$('#all_day').on('change', function(){
    if($('#all_day').val()==0){
        $('#timing_div').css("display","block");
        $("#from_day").attr('required',true);
        $("#to_day").attr('required',true);
        $("#opening_time_input").attr('required',true);
        $("#closing_time_input").attr('required',true);
    }

    else if($('#all_day').val()==1){
        $('#timing_div').css("display","none");
        $("#from_day").removeAttr('required');
        $("#to_day").removeAttr('required');
        $("#opening_time_input").removeAttr('required');
        $("#closing_time_input").removeAttr('required');
    }
});
