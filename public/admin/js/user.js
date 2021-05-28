$(document).ready( function () {
    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":5 },
        ]
    });
    $('#permissions').select2();
});

// Change Password From Admin
function adminChangePassword() {

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
                url: routes.userDelete,
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

// Change User Status
function changeUserStatus(id, status) {
    swal({
        title: "Are you Sure",
        text: "You want to change the status of user?",
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
                url: routes.changeUserStatus,
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