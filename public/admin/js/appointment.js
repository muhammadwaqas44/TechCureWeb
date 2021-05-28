$(document).ready( function () {
    $('#patient_id').select2();
    $('#patient_type_id').select2();
    $('#practitioner_id').select2();
    $('#clinic_id').select2();
    $('#time_slot').select2();

    // $('#myTable').DataTable({
    //     "columnDefs": [
    //         { "orderable": false, "targets":8 },
    //     ]
    // });

    $(".date").datepicker({
        autoclose: true,
        todayHighlight: true,
        startDate: new Date(),
        todayBtn: "linked",
    })
    .on('changeDate',function(e){
        $('#overlay').css("display","block");

        let selected_date = $('#date').val();
        let selected_patient = $('#patient_id').val();
        let selected_practitioner = $('#practitioner_id').val();
        let selected_clinic = $('#clinic_id').val();

        $.ajax({
            method: "POST",
            url: routes.getTimeSlots,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'selected_date': selected_date,
                'patient_id': selected_patient,
                'practitioner_id': selected_practitioner,
                'clinic_id': selected_clinic,
                'appointment_id': $('#appointment_id').val(),
            },
            success: function (response) {
                if( response.status == 0 ){
                    let error = response.error;
                    swal({
                        text : error,
                        icon : "error",
                    })
                    $('#date').val('');
                    $('#time_slot').empty();
                    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');
                    $('#overlay').css("display","none");
                }
                else if( response.status == 1 ){

                    $('#time_slot').empty();
                    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');

                    response.time_slots.forEach(function (item, index) {
                        option = "<option value='" + item.key + "'>" + item.value + "</option>"
                        $('#time_slot').append(option);
                    });

                    $('#overlay').css("display","none");
                }
                
            }
        });

    });

});

// get clinics for selected Practitioner
$('#practitioner_id').on('change', function () {
    $('#overlay').css("display","block");
    $('#date').val('');
    $('#time_slot').empty();
    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');

    var practitioner_id = $('#practitioner_id').find(":selected").val();
    var option = '';
    $('#edit_category_id').prop('disabled', false);

    $.ajax({
        method: "POST",
        url: routes.getClinics,
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

// clear date and slot box
$('#patient_id').on('change', function(){
    $('#date').val('');
    $('#time_slot').empty();
    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');
});

// clear date and slot box
$('#clinic_id').on('change', function(){
    $('#date').val('');
    $('#time_slot').empty();
    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');
});
