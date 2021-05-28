$(document).ready( function () {
    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":6 },
        ]
    });
    $('#appointmentTable').DataTable({
        "columnDefs": [
            { "orderable": false },
        ]
    });
    $('#patientTable').DataTable({
        "columnDefs": [
            { "orderable": false },
        ]
    });
    $('#assistantTable').DataTable({
        "columnDefs": [
            { "orderable": false },
        ]
    });
    $('#practitionerClinic').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":4 },
        ]
    });

    $('#clinicPractitioner').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":4 },
        ]
    });
    $('#specialties').select2();
    $('#qualification_id').select2();
    $('.clinic').select2();
    $('.dropify').dropify();


    if($('.online_clinic').length > 0)
    {
        $('#lastValueDays').val($('select.selectpicker.day').length);
        $('#lastValueToTime').val($('div.date.to_time').length);
        $('#lastValueFromTime').val($('div.date.to_time').length);
        $('#lastValueFromOnlineClinic').val($('.online_clinic').length);
    }

    var toTimeVal;
    var fromTimeVal;
    var dayVal;
    var onlineClinic;

    $('.repeater-default').repeater({
        show: function () {
          $(this).slideDown();

            toTimeVal = $('#lastValueToTime').val();
            fromTimeVal = $('#lastValueFromTime').val();
            dayVal = $('#lastValueDays').val();
            onlineClinic = $('#lastValueFromOnlineClinic').val();
            $(this).find('select.selectpicker.day').removeAttr('id').attr('id', 'day_'+dayVal);
            $(this).find('div.date.to_time').removeAttr('id').attr('id', 'to_time_'+toTimeVal);
            $(this).find('input[data-target="#to_time_0"]').removeAttr('data-target').attr('data-target', '#to_time_'+toTimeVal);
            $(this).find('div[data-target="#to_time_0"]').removeAttr('data-target').attr('data-target', '#to_time_'+toTimeVal);

            $(this).find('div.date.from_time').removeAttr('id').attr('id', 'from_time_'+fromTimeVal);
            $(this).find('input[data-target="#from_time_0"]').removeAttr('data-target').attr('data-target', '#from_time_'+fromTimeVal);
            $(this).find('div[data-target="#from_time_0"]').removeAttr('data-target').attr('data-target', '#from_time_'+fromTimeVal);

            if($('.online_clinic').length > 0)
            {
                $('.online_clinic').last().removeClass('online_clinic').addClass('online_clinic' + onlineClinic);
                $('.online-select-clinic').last().removeClass('online-select-clinic').addClass('online-select-clinic' + onlineClinic);
                $('.online-physical-fee-span').last().removeClass('online-physical-fee-span').addClass('online-physical-fee-span' + onlineClinic);
                $('.online-physical-fee').last().removeClass('online-physical-fee').addClass('online-physical-fee' + onlineClinic);
            }
            else
            {
                $('.online_clinic0').last().removeClass('online_clinic0').addClass('online_clinic' + onlineClinic);
                $('.online-select-clinic0').last().removeClass('online-select-clinic0').addClass('online-select-clinic' + onlineClinic);
                $('.online-physical-fee-span0').last().removeClass('online-physical-fee-span0').addClass('online-physical-fee-span' + onlineClinic);
                $('.online-physical-fee0').last().removeClass('online-physical-fee0').addClass('online-physical-fee' + onlineClinic);
            }


            $('#lastValueToTime').val(parseInt(toTimeVal)+1);
            $('#lastValueFromTime').val(parseInt(fromTimeVal)+1);
            $('#lastValueDays').val(parseInt(dayVal)+1);
            $('#lastValueFromOnlineClinic').val(parseInt(onlineClinic)+1);

            $('#day_'+dayVal).select2();

            $('#from_time_'+fromTimeVal).datetimepicker({
                format: 'LT',
                pickDate: false,
                pickTime: true,
                // useSeconds: false,
                // format: 'hh:mm',
                stepping: 10 //will change increments to 10m, default is 1m
            })
            $('#to_time_'+toTimeVal).datetimepicker({
                format: 'LT',
                pickDate: false,
                pickTime: true,
                // useSeconds: false,
                // format: 'hh:mm',
                stepping: 10 //will change increments to 10m, default is 1m
            });
        

        },
        hide: function (deleteElement) {
          if (confirm('Are you sure you want to delete this clinic timings?')) {
            $(this).slideUp(deleteElement);
          }
        },
        isFirstItemUndeletable: true
    });

   
    $(':input').inputmask();
    for(var i = 0; i < $('div.date.to_time').length; i++){
        $('#from_time_'+i).datetimepicker({
            format: 'LT',
            pickDate: false,
            pickTime: true,
            // useSeconds: false,
            // format: 'hh:mm',
            stepping: 10 //will change increments to 10m, default is 1m
        })
        $('#to_time_'+i).datetimepicker({
            format: 'LT',
            pickDate: false,
            pickTime: true,
            // useSeconds: false,
            // format: 'hh:mm',
            stepping: 10 //will change increments to 10m, default is 1m
        })
    }

    for(var j=0; j< $('select.selectpicker.day').length; j++){
        $('#days_'+j).select2();
    }
});

function onlineClinicCheckbox(element) {
    var onlineClinicClasses = element.get(0).className;
    var specificOnlineClinicClass = onlineClinicClasses.split(' ')[0];
    var onlineClinicClassFinal = specificOnlineClinicClass.replace(/[^\d.]/g, '');
    var onlineClinicClassFinalInt = parseInt(onlineClinicClassFinal);

    if (isNaN(onlineClinicClassFinalInt)) {
        var count = "";
    } else {
        var count = parseInt(onlineClinicClassFinalInt);
    }

    if ($('.'+onlineClinicClasses).is(':checked'))
    {
        $('.online-select-clinic'+count).val(1).attr('selected', 'true');
        $('.online-physical-fee'+count).prop('required', false);
        $('.online-physical-fee-span'+count).find("span").remove();
    }
    if (!$('.'+onlineClinicClasses).is(':checked'))
    {
        $('.online-select-clinic'+count).val(1).removeAttr('selected', 'true');
        $('.online-select-clinic'+count).val('').attr('selected', 'true');
        $('.online-physical-fee'+count).prop('required', true);
        $('.online-physical-fee-span'+count).append("<span style='color:red'>*</span");
    }
};

// Change Password From Practitioner
function practitionerChangePassword() {

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

// Change Practitioner Status
function changePractitionerStatus(id, status) {
    swal({
        title: "Are you Sure",
        text: "You want to change the status of practitioner?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "No, cancel please!",
                value: null,
                visible: true,
                className: "",
                closeModal: false,
            },
            confirm: {
                text: "Yes!!!",
                value: true,
                visible: true,
                className: "",
                closeModal: false
            }
        }
    }).then(isConfirm => {
        if (isConfirm) {
            $.ajax({
                method: "POST",
                url: routes.changePractitionerStatus,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    'status':status,
                },
                success: function (data) {
                    if(data.status == 0){
                        swal({
                            text : "Record Not Found",
                            icon : "error",
                        })
                    }
                    else{
                        swal({
                            text : "Status Changed Successfully",
                            icon : "success",
                        })

                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }

                }
            });

        } else {
            swal("Cancelled", "It's safe.", "error");
        }
    });
}

$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
       if (input.attr("type") == "password") {
          input.attr("type", "text");
       } else {
          input.attr("type", "password");
       }
});
