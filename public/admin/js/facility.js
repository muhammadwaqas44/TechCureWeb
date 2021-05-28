$(document).ready( function () {
    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":3 },
        ]
    });

    $('.dropify').dropify();

});

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
                url: routes.facilityDelete,
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
function changeFacilityStatus(id, status) {
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
                url: routes.changeFacilityStatus,
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
