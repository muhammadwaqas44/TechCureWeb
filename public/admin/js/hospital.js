$(document).ready( function () {
    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":3 },
        ]
    });

    $('.dropify').dropify();

});


$('#all_time').change(function () {

    var currentlyOnDrug = $(this).val();
    if (currentlyOnDrug == 0) {
        $('#timing_open_close').show();
    } else {
        $('#timing_open_close').hide();
        $('#from_time').val('');
        $('#to_time').val('');
    }
});
$(':input').inputmask();

$('#departments').select2();
$('#facilities').select2();
$('#days').select2();

$('#from_time').datetimepicker({
    format: 'LT',
    pickDate: false,
    pickTime: true,
    // useSeconds: false,
    // format: 'hh:mm',
    stepping: 15 //will change increments to 15m, default is 1m
})
$('#to_time').datetimepicker({
    format: 'LT',
    pickDate: false,
    pickTime: true,
    // useSeconds: false,
    // format: 'hh:mm',
    stepping: 15 //will change increments to 15m, default is 1m
})

function deleteFunction(id) {
    swal({
        title: "Are you Sure",
        text: "You want to delete?",
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
                url: routes.hospitalDelete,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
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
                            text : "Record Deleted Successfully",
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



// Change Practitioner Status
function changeHospitalStatus(id, status) {
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
                url: routes.changeHospitalStatus,
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
