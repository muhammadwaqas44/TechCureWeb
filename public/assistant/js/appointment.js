$(document).ready(function () {
    $('#patient_id').select2();
    $('#patient_type_id').select2();
    $('#type').select2();
    $('#clinic_id').select2();
    $('#practitioner_id').select2();
    $('#time_slot').select2();

    $('.date').datepicker({
        startDate: new Date(),
    });

    $("#date").change(function (e) {
        $('#overlay').css("display", "block");
        let selected_date = $('#date').val();
        let selected_patient = $('#patient_id').val();
        let selected_practitioner = $('#practitioner_id').val();
        let selected_clinic = $('#clinic_id').val();

        $.ajax({
            method: "POST",
            url: routes.assistantGetTimeSlots,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'selected_date': selected_date,
                'patient_id': selected_patient,
                'practitioner_id': selected_practitioner,
                'clinic_id': selected_clinic,
                'appointment_id': $('#appointment_id').val(),
            },
            success: function (response) {
                if (response.status == 0) {
                    let error = response.error;
                    swal({
                        text: error,
                        icon: "error",
                    })
                    $('#date').val('');
                    $('#time_slot').empty();
                    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');
                    $('#overlay').css("display", "none");
                } else if (response.status == 1) {

                    $('#time_slot').empty();
                    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');

                    response.time_slots.forEach(function (item, index) {
                        option = "<option value='" + item.key + "'>" + item.value + "</option>"
                        $('#time_slot').append(option);
                    });

                    $('#overlay').css("display", "none");
                }

            }
        });

    });

    $("#practitioner_id").change(function (e) {
        $('#overlay').css("display", "block");

        let selected_practitioner = $('#practitioner_id').val();

        $.ajax({
            method: "POST",
            url: routes.assistantGetClinics,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'practitioner_id': selected_practitioner,
                'appointment_id': $('#appointment_id').val(),
            },
            success: function (response) {
                if (response.status == 0) {
                    let error = response.error;
                    swal({
                        text: error,
                        icon: "error",
                    })
                    $('#practitioner_id').val('');
                    $('#clinic_id').empty();
                    $('#clinic_id').append(' <option value="" selected disabled>Select Clinic</option>');
                    $('#overlay').css("display", "none");
                } else if (response.status == 1) {

                    $('#clinic_id').empty();
                    $('#clinic_id').append(' <option value="" selected disabled>Select Clinic</option>');

                    // console.log(response.clinics);
                    response.clinics.forEach(function (item, index) {
                        // console.log(item);
                        option = "<option value='" + item.id + "'>" + item.name + "</option>"
                        $('#clinic_id').append(option);
                    });

                    $('#overlay').css("display", "none");
                }

            }
        });

    });

    $("#clinic_id").change(function (e) {
        $('#fee').val('');
        $('#type').val('');
    });

    $("#patient_type_id").change(function (e) {
        $('#fee').val('');
        $('#type').val('');
    });

    $("#type").change(function (e) {

        $('#fee').val('');
        var clinic_id = $('#clinic_id').val();
        var type = $('#type').val();
        var patient_type_id = $('#patient_type_id').val();
        var practitioner_id = $('#practitioner_id').val();

        $.ajax({
            method: "POST",
            url: routes.getAssistantFee,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'clinic_id': clinic_id,
                'type': type,
                'patient_type_id': patient_type_id,
                'practitioner_id': practitioner_id,
            },
            success: function (response) {
                if (response.status == 0) {
                    let error = response.error;
                    swal({
                        text: error,
                        icon: "error",
                    })
                } else if (response.status == 1) {
                    $('#fee').val('');
                    if (type == 0) {
                        $('#fee').val(response.fee);
                    } else if (type == 1) {
                        $('#fee').val(response.fee);
                    }
                }
            }
        });
    });
});


// clear date and slot box
$('#patient_id').on('change', function () {
    $('#date').val('');
    $('#time_slot').empty();
    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');
});

// clear date and slot box
$('#clinic_id').on('change', function () {
    $('#date').val('');
    $('#time_slot').empty();
    $('#time_slot').append(' <option value="" selected disabled>Select Time Slot</option>');
});


$(function () {
    $('.copy-to-clipboard input').click(function () {
        $(this).focus();
        $(this).select();
        document.execCommand('copy');
        window.toastr.success('Link Copied!');
    });
});

function copylink(element) {
    console.log($(element).next().val());
    $(element).next().select();
    document.execCommand('copy');
    window.toastr.success('Link Copied!');
}
