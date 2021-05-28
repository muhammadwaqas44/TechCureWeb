$(document).ready( function () {

    $('#specialty_id').select2();
    $('#allergies').select2();
    $('#drugs').select2();
    $('.dropify-image').dropify();
    // $('.dropify').dropify();
    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":8 },
        ]
    });

    $('#patientVisitTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":3 },
        ]
    });

    $('#patientPractitioner').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":5 },
        ]
    });

    $('#practitionerPatient').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":8 },
        ]
    });

    $('#lastValueDropify').val(0);
    var dropifyVal;

    $('.repeater-default').repeater({
        show: function () {
          $(this).slideDown();

          dropifyVal = $('#lastValueDropify').val();
          $(this).find('input.dropify').removeAttr('id').attr('id', 'dropify_'+dropifyVal);
          $('#lastValueDropify').val(parseInt(dropifyVal)+1);
          $('#dropify_'+dropifyVal).dropify();

        },
        hide: function (deleteElement) {
          if (confirm('Are you sure you want to delete this element?')) {
            $(this).slideUp(deleteElement);
          }
        },
        initEmpty: true,
        // isFirstItemUndeletable: true
    });

    $(':input').inputmask();

    $(".date").datepicker({
        autoclose: true,
        todayHighlight: true,
    });

});

// Change Password From Patient
function patientChangePassword() {

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

// Delete Previous Report By admin
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
              url: routes.patientReportDelete,
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

                      $(".del[data-id="+id+"]").fadeOut(function(){$(".del[data-id="+id+"]").remove()})
                  }
                  
              }
          });
          
      } else {
          swal("Cancelled", "It's safe.", "error");
      }
  });
}

// Delete Previous Report By Practitioner
function reportDeleteFunction(id) {
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
                url: routes.practitionerPatientReportDelete,
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
  
                        $(".del[data-id="+id+"]").fadeOut(function(){$(".del[data-id="+id+"]").remove()})
                    }
                    
                }
            });
            
        } else {
            swal("Cancelled", "It's safe.", "error");
        }
    });
}

// Delete Previous Report By Patient
function patientReportDeleteFunction(id) {
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
                url: routes.byPatientReportDelete,
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
  
                        $(".del[data-id="+id+"]").fadeOut(function(){$(".del[data-id="+id+"]").remove()})
                    }
                    
                }
            });
            
        } else {
            swal("Cancelled", "It's safe.", "error");
        }
    });
}

$('#currently_on_drug').change(function() {
    var currentlyOnDrug = $(this).val();
    if(currentlyOnDrug == 1)
    {
        $('#drugs_div').show();
        $('#drugs').prop('required', true);
    }
    else
    {
        $('#drugs_div').hide();
        $('#drugs').prop('required', false);
    }
});


$(document).ready( function () {
    var currentlyOnDrug = $('#currently_on_drug').val();
    if(currentlyOnDrug == 1)
    {
        $('#drugs_div').show();
        $('#drugs').prop('required', true);
    }
    else
    {
        $('#drugs_div').hide();
        $('#drugs').prop('required', false);
    }
});

$('#dob').change(function() {
    var dob = $('#dob').val();
    dob = new Date(dob);
    var today = new Date();
    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
    $('#age').val(age);
});

$('#vital_lbs').on('click', function() {
    var patientWeight = $('#weight_kgs').val();
    var weightInKgs = patientWeight * 2.20462262185;
    $('#weight_lbs_div').show();
    // $('#weight_lbs').prop('required', true);
    $('#weight_lbs').val(weightInKgs);
    $('#weight_kgs_div').hide();
    $('#weight_kgs').prop('required', false);
    $('#weight_kgs').val('');
    $('#vital_lbs').hide();
    $('#vital_kgs').show();
});

$('#vital_kgs').on('click', function() {
    var patientWeight = $('#weight_lbs').val();
    var weightInLbs = patientWeight / 2.20462262185;
    $('#weight_kgs_div').show();
    // $('#weight_kgs').prop('required', true);
    $('#weight_kgs').val(weightInLbs);
    $('#weight_lbs_div').hide();
    $('#weight_lbs').prop('required', false);
    $('#weight_lbs').val('');
    $('#vital_kgs').hide();
    $('#vital_lbs').show();
});

$('#vital_cms').on('click', function() {
    var patientHeightInFt = $('#height_ft').val();
    var patientHeightInInches = $('#height_in').val();
    var patientHeightInFtValue = patientHeightInFt * 30.48;
    var patientHeightInInchesValue = patientHeightInInches * 2.54;
    var heightInCMs = patientHeightInFtValue + patientHeightInInchesValue;
    $('#height_cms_div').show();
    // $('#height_cms').prop('required', true);
    $('#height_cms').val(heightInCMs);
    $('#vital_cms').hide();
    $('#height_ft_div').hide();
    $('#height_ft').prop('required', false);
    $('#height_ft').val('');
    $('#height_in_div').hide();
    $('#height_in').prop('required', false);
    $('#height_in').val('');
    $('#vital_ft').show();
});

$('#vital_ft').on('click', function() {
    var patientHeightInFt = $('#height_cms').val();
    var realFeet = ((patientHeightInFt * 0.393700) / 12);
    var feet = Math.floor(realFeet);
    var inches = Math.round((realFeet - feet) * 12);
    $('#height_ft_div').show();
    $('#height_in_div').show();
    $('#vital_cms').show();
    $('#height_ft').val(feet);
    // $('#height_ft').prop('required', true);
    $('#height_in').val(inches);
    // $('#height_in').prop('required', true);
    $('#height_cms_div').hide();
    $('#height_cms').prop('required', false);
    $('#height_cms').val('');
});

$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
       if (input.attr("type") == "password") {
          input.attr("type", "text");
       } else {
          input.attr("type", "password");
       }
});