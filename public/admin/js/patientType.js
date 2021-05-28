$(document).ready( function () {
    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":6 },
        ]
    });

    $(".date").datepicker({
        autoclose: true,
        todayHighlight: true,
        startDate: new Date(),
        todayBtn: "linked",
    });
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
                url: routes.patientTypeDelete,
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