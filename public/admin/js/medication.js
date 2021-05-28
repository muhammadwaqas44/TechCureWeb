$(document).ready( function () {
    $('#dose_id').select2();
    $('#unit_id').select2();
    $('#frequency_id').select2();
    $('#duration_id').select2();
    $('#diagnosis_type_id').select2();

    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":9 },
        ]
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
                url: routes.medicationDelete,
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