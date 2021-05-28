$(document).ready( function () {
    $('#myTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":6 },
        ]
    });

    $('#patientPrescription').DataTable({
        "columnDefs": [
            { "orderable": false, "targets":5 },
        ]
    });
    $('#medications').select2();
    $('#allergies').select2();


    $(".date").datepicker({
        autoclose: true,
        todayHighlight: true,
        startDate: new Date(),
    });

});

// get clinics for selected Practitioner
$('#practitioner_id').on('change', function () {
    $('#overlay').css("display","block");
    
    var practitioner_id = $('#practitioner_id').find(":selected").val();
    var option = '';

    $.ajax({
        method: "POST",
        url: routes.prescriptionGetClinics,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'practitioner_id': practitioner_id
        },
        success: function (response) {
            $('#clinic_id').empty();
            $('#clinic_id').append(' <option value="" selected disabled>Select Clinic</option>');

            response.clinics.forEach(function (item, index) {
                option = "<option value='" + item.id + "'>" + item.name + "</option>"
                $('#clinic_id').append(option);
            });
            $('#overlay').css("display","none");
        }
    });
});

