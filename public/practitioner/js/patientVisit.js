$('#vital_lbs').on('click', function () {
    $('#weight_lbs').val('');
    var patientWeight = $('#weight_kgs').val();
    var weightInKgs = patientWeight * 2.20462262185;
    $('#weight_lbs').show();
    $('#weight_lbs').val(Math.round(weightInKgs * 10) / 10);
    $('#weight_kgs').hide();
    $('#weight_kgs').val('');
    $('#vital_lbs').hide();
    $('#vital_kgs').show();
    $('#weight_unit').text('Weight (Lbs)');
});

$('#vital_kgs').on('click', function () {
    $('#weight_kgs').val('');
    var patientWeight = $('#weight_lbs').val();
    var weightInLbs = patientWeight / 2.20462262185;
    $('#weight_kgs').show();
    $('#weight_kgs').val(Math.round(weightInLbs * 10) / 10);
    $('#weight_lbs').hide();
    $('#weight_lbs').val('');
    $('#vital_kgs').hide();
    $('#vital_lbs').show();
    $('#weight_unit').text('Weight (Kgs)');
});

$('#vital_cms').on('click', function () {
    var patientHeightInFt = $('#height_ft').val();
    var patientHeightInInches = $('#height_in').val();
    var patientHeightInFtValue = patientHeightInFt * 30.48;
    var patientHeightInInchesValue = patientHeightInInches * 2.54;
    var heightInCMs = patientHeightInFtValue + patientHeightInInchesValue;
    $('#height_cms').show();
    $('#height_cms').val(Math.round(heightInCMs));
    $('#vital_cms').hide();
    $('#height_ft').hide();
    $('#height_in').hide();
    $('#vital_ft').show();
    $('#height_unit').text('Height (Cms)');
});

$('#vital_ft').on('click', function () {
    var patientHeightInFt = $('#height_cms').val();
    var realFeet = ((patientHeightInFt * 0.393700) / 12);
    var feet = Math.floor(realFeet);
    var inches = Math.round((realFeet - feet) * 12);

    $('#height_ft').show();
    $('#height_ft').val(Math.round(feet));
    $('#vital_cms').show();
    $('#height_in').show();
    $('#height_in').val(Math.round(inches));
    $('#vital_ft').hide();
    $('#height_cms').hide();
    $('#height_unit').text('Height (Ft/In)');
});

$('#vital_lbs_2').on('click', function () {
    $('#weight_lbs_2').val('');
    var patientWeight = $('#weight_kgs_2').val();
    var weightInKgs = patientWeight * 2.20462262185;
    $('#weight_lbs_2').show();
    $('#weight_lbs_2').val(Math.round(weightInKgs * 10) / 10);
    $('#weight_kgs_2').hide();
    $('#weight_kgs_2').val('');
    $('#vital_lbs_2').hide();
    $('#vital_kgs_2').show();
    $('#weight_unit_2').text('Weight (Lbs)');
});

$('#vital_kgs_2').on('click', function () {
    $('#weight_kgs_2').val('');
    var patientWeight = $('#weight_lbs_2').val();
    var weightInLbs = patientWeight / 2.20462262185;
    $('#weight_kgs_2').show();
    $('#weight_kgs_2').val(Math.round(weightInLbs * 10) / 10);
    $('#weight_lbs_2').hide();
    $('#weight_lbs_2').val('');
    $('#vital_kgs_2').hide();
    $('#vital_lbs_2').show();
    $('#weight_unit_2').text('Weight (Kgs)');
});

$('#vital_cms_2').on('click', function () {
    var patientHeightInFt = $('#height_ft_2').val();
    var patientHeightInInches = $('#height_in_2').val();
    var patientHeightInFtValue = patientHeightInFt * 30.48;
    var patientHeightInInchesValue = patientHeightInInches * 2.54;
    var heightInCMs = patientHeightInFtValue + patientHeightInInchesValue;
    $('#height_cms_2').show();
    $('#height_cms_2').val(Math.round(heightInCMs));
    $('#vital_cms_2').hide();
    $('#height_ft_2').hide();
    $('#height_in_2').hide();
    $('#vital_ft_2').show();
    $('#height_unit_2').text('Height (Cms)');
});

$('#vital_ft_2').on('click', function () {
    var patientHeightInFt = $('#height_cms_2').val();
    var realFeet = ((patientHeightInFt * 0.393700) / 12);
    var feet = Math.floor(realFeet);
    var inches = Math.round((realFeet - feet) * 12);

    $('#height_ft_2').show();
    $('#height_ft_2').val(Math.round(feet));
    $('#vital_cms_2').show();
    $('#height_in_2').show();
    $('#height_in_2').val(Math.round(inches));
    $('#vital_ft_2').hide();
    $('#height_cms_2').hide();
    $('#height_unit_2').text('Height (Ft/In)');
});

// $('.physical_exams').select2();

// $('.physical_exams').selectpicker('refresh');

function uploadFile(input, id) {
    if (input.files && input.files[0]) {
        var fileName = input.files[0].name;
        var filesize = input.files[0].size;
        var extention = fileName.split('.').pop().toLowerCase();
        if (extention == 'png' || extention == 'jpg' || extention == 'jpeg' || extention == 'pdf') {
            console.log(filesize);
            if (filesize < 2100000) {
            } else {
                $('#' + id).val('');
                toastr.clear();
                window.toastr.error("Please upload a file less then 2MB");
            }
        } else {
            $('#' + id).val('');
            toastr.clear();
            window.toastr.error("Please upload only png/jpg/jpeg/pdf file");
        }
    }
}

// function isNumberKey(evt) {      //onkeypress="return isNumberKey(event)"
//     var charCode = (evt.which) ? evt.which : event.keyCode;
//     if (charCode > 31 && (charCode < 48 || charCode > 57)) {
//         return false;
//     } else {
//         return true;
//     }
// }

$('.number').keypress(function(event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
        ((event.which < 48 || event.which > 57) &&
            (event.which != 0 && event.which != 8))) {
        event.preventDefault();
    }

    var text = $(this).val();

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 1) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 1)) {
        event.preventDefault();
    }
});

$('form#physical_exams_form_model').on('submit', function (e) {
    e.preventDefault();
    var form = $('form#physical_exams_form_model').serialize();
    $.ajax({
        type: 'POST',
        url: routes.physicalExamsModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalPE').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$('form#patient_history_form_model').on('submit', function (e) {
    e.preventDefault();
    var form = $('form#patient_history_form_model').serialize();
    $.ajax({
        type: 'POST',
        url: routes.patientHistoryModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalhistory').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$('form#ros_form_model_post').on('submit', function (e) {
    e.preventDefault();
    var form = $('form#ros_form_model_post').serialize();
    $.ajax({
        type: 'POST',
        url: routes.rosModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalros').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$('form#past_medical_histories_form_model').on('submit', function (e) {
    e.preventDefault();
    var form = $('form#past_medical_histories_form_model').serialize();

    $.ajax({
        type: 'POST',
        url: routes.pastMedicalHistoriesModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalPMHx').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$('form#past_surgical_histories_form_model').on('submit', function (e) {
    e.preventDefault();
    var form = $('form#past_surgical_histories_form_model').serialize();

    $.ajax({
        type: 'POST',
        url: routes.pastSurgicalHistoriesModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalPSHx').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$('form#family_medical_histories_form_model').on('submit', function (e) {
    e.preventDefault();

    var form = $('form#family_medical_histories_form_model').serialize();

    $.ajax({
        type: 'POST',
        url: routes.familyMedicalHistoriesModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalFMHx').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$('form#patient_smoking_model_post').on('submit', function (e) {
    e.preventDefault();

    var form = $('form#patient_smoking_model_post').serialize();

    $.ajax({
        type: 'POST',
        url: routes.smokingModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalsmoking').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$('form#modaladr_form_post').on('submit', function (e) {
    e.preventDefault();

    var form = $('form#modaladr_form_post').serialize();

    $.ajax({
        type: 'POST',
        url: routes.adrModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modaladr').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

function onChangeDrug(ele) {
    var id = ele.val();
    fatchDropDownReactionData(id, ele);
}

function fatchDropDownReactionData(id, ele) {
    var adrClasses = ele.parent().get(0).className;
    var specificAdrClass = adrClasses.split(' ')[5];
    var adrClassFinal = specificAdrClass.replace(/[^\d.]/g, '');
    var adrClassFinalInt = parseInt(adrClassFinal);

    if (isNaN(adrClassFinalInt)) {
        var count = "";
    } else {
        var count = adrClassFinalInt;
    }
    if (id != undefined) {
        $.ajax({
            type: 'POST',
            url: routes.getReactionslist,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'drug_id': id,
            },
            success: function (response) {
                if (response.result == 'success') {
                    $('.reactions' + count).selectpicker('refresh');
                    $(".reactions" + count).prop("selectedIndex", -1);
                    $.each(response.reactions, function (key, value) {
                        var reactionID = value.id;
                        var reaction = value.title;
                        $("div.reactions" + count + " option[value=" + reactionID + "]").prop("selected", true);
                        $("div.reactions" + count + " .filter-option-inner-inner").text(reaction);
                    });
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            }
        });
    } else {
        alert('Drug Id is undefined.')
    }
}

function fetchTemplateDropDwon(ele) {
    var id = ele.value;
    if (id != undefined) {
        $.ajax({
            type: 'POST',
            url: routes.getPresciptionTemplate,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'template_id': id,
            },
            success: function (response) {
                if (response.result == 'success') {
                    // $('#visit_template').summernote('code', response.template.description);
                    var s = response.template.description;
                    if (s != null) {
                        tinymce.get('visit_template').setContent(s);
                    }
                    submitTextarea();
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            }
        });
    } else {
        alert('Template Id is undefined.');
    }
}

function fetchTemplateButton(ele) {
    var id = ele;
    if (id != undefined) {
        $.ajax({
            type: 'POST',
            url: routes.getPresciptionTemplate,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'template_id': id,
            },
            success: function (response) {
                if (response.result == 'success') {
                    // $('#visit_template').summernote('code', response.template.description);
                    var s = response.template.description;
                    if (s != null) {
                        tinymce.get('visit_template').setContent(s);
                    }
                    submitTextarea();
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            }
        });
    } else {
        alert('Template Id is undefined.')
    }
}

function startTimer(durationM, durationS, display) {
    var duration1 = parseInt(durationM * 60);
    var duration2 = parseInt(durationS);
    var duration = duration1 + duration2;
    var timer = duration, minutes, seconds;
    // alert(duration)
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (++timer < duration) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var saveDuration = $('#time').text();
    var splitTime = saveDuration.split(':');
    var minutes = splitTime[0];
    var seconds = splitTime[1];
    display = document.querySelector('#time');
    startTimer(minutes, seconds, display);
    setTimeout(showPage);
};

function showPage() {
    $('#loaderDiv').hide();
    $('#myDivPage').show();
}

window.onbeforeunload = confirmExit;

function confirmExit() {
    var runtime = $('#time').text();
    var patientVisitId = $('#patient_visit_id').val();
    $.ajax({
        type: 'POST',
        url: routes.saveDurationVisit,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_visit_id': patientVisitId,
            'run_time': runtime,
        },
        success: function (response) {
            if (response.result == 'success') {
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        }
    });
}

function submitTextarea() {
    var visitTemplate = $('#visit_template').val();
    var patientVisitId = $('#patient_visit_id').val();
    $.ajax({
        type: 'POST',
        url: routes.submitVisitPresciptionTemplateNOte,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'visit_template': visitTemplate,
            'patient_visit_id': patientVisitId,
        },
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        }
    });
}

function updatePatientStatus(ele) {
    var patientId = $(ele).data("id");
    var status = $(ele).data("status");
    if (status == 'black_list') {
        $(".black-list-flag").css("border", "5px solid black");
        $(".critical-flag").css("border", "");
    }
    if (status == 'critical_list') {
        $(".critical-flag").css("border", "5px solid darkred");
        $(".black-list-flag").css("border", "");
    }
    $.ajax({
        type: 'POST',
        url: routes.updatePatientStatusOnVisit,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientId,
            'status': status,
        },
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        }
    });
}

function getDays(x) {
    visit_input = $('#visit_days').val();


    added_days = 0;
    if (x == 1) {
        var n = visit_input.includes("days");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        var n = visit_input.includes("weeks");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        var n = visit_input.includes("months");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        added_days = visit_input;
        $('#visit_days').val(visit_input + " days");
        $("#days").css({
            'background-color': '#3bff4f',
            'color': 'black'
        });
        $("#weeks").css({
            'background-color': 'white',
            'color': 'blue'
        });
        $("#months").css({
            'background-color': 'white',
            'color': 'black'
        });
        var someDate = new Date();
        var duration = added_days; //In Days
        visit_date = someDate.toLocaleString(someDate.setTime(someDate.getTime() + (duration * 24 * 60 * 60 * 1000)));
        $('#visit_next_date').datepicker("setDate", new Date(visit_date));
        var followup_date = $('#visit_next_date').datepicker("getDate");
        var follow_up = $('#visit_days').val();
        const date = new Date(followup_date)
        const dateTimeFormat = new Intl.DateTimeFormat('en', {year: 'numeric', month: 'numeric', day: '2-digit'})
        const [{value: month}, , {value: day}, , {value: year}] = dateTimeFormat.formatToParts(date)
        followup_date = `${day}-${month}-${year}`;
        var patientId = $("#patient_id").val();
        var practitionerId = $("#practitioner_id").val();
        var patientVisitId = $("#patient_visit_id").val();
        var visitDay = $('#visit_days').val();
        var visitDate = $('#visit_next_date').val();
        var runtime = $('#time').text();
        $.ajax({
            type: 'POST',
            url: routes.saveNextVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'patient_id': patientId,
                'patient_visit_id': patientVisitId,
                'practitioner_id': practitionerId,
                'visit_days': visitDay,
                'visit_next_date': visitDate,
                'run_time': runtime,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            }
        });
    } else if (x == 2) {
        var n = visit_input.includes("days");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        var n = visit_input.includes("weeks");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        var n = visit_input.includes("months");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        added_days = visit_input;
        $('#visit_days').val(visit_input + " weeks");
        $("#days").css({
            'background-color': 'white',
            'color': 'blue'
        });
        $("#weeks").css({
            'background-color': '#3bff4f',
            'color': 'black'
        });
        $("#months").css({
            'background-color': 'white',
            'color': 'black'
        });
        var someDate = new Date();
        var duration = added_days * 7; //In Days
        visit_date = someDate.toLocaleString(someDate.setTime(someDate.getTime() + (duration * 24 * 60 * 60 * 1000)));
        $('#visit_next_date').datepicker("setDate", new Date(visit_date));
        var followup_date = $('#visit_next_date').datepicker("getDate");
        var follow_up = $('#visit_days').val();
        const date = new Date(followup_date)
        const dateTimeFormat = new Intl.DateTimeFormat('en', {year: 'numeric', month: 'numeric', day: '2-digit'})
        const [{value: month}, , {value: day}, , {value: year}] = dateTimeFormat.formatToParts(date)
        followup_date = `${day}-${month}-${year}`;

        var patientId = $("#patient_id").val();
        var practitionerId = $("#practitioner_id").val();
        var patientVisitId = $("#patient_visit_id").val();
        var visitDay = $('#visit_days').val();
        var visitDate = $('#visit_next_date').val();
        var runtime = $('#time').text();
        $.ajax({
            type: 'POST',
            url: routes.saveNextVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'patient_id': patientId,
                'patient_visit_id': patientVisitId,
                'practitioner_id': practitionerId,
                'visit_days': visitDay,
                'visit_next_date': visitDate,
                'run_time': runtime,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            }
        });
    } else {
        var n = visit_input.includes("days");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        var n = visit_input.includes("weeks");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        var n = visit_input.includes("months");
        if (n == true) {
            var array = visit_input.split(" ", 2);
            visit_input = array[0];
        }
        added_days = visit_input;
        $('#visit_days').val(visit_input + " months");
        $("#days").css({
            'background-color': 'white',
            'color': 'blue'
        });
        $("#weeks").css({
            'background-color': 'white',
            'color': 'black'
        });
        $("#months").css({
            'background-color': '#3bff4f',
            'color': 'black'
        });
        var someDate = new Date();
        var duration = added_days * 30; //In Days
        visit_date = someDate.toLocaleString(someDate.setTime(someDate.getTime() + (duration * 24 * 60 * 60 * 1000)));
        $('#visit_next_date').datepicker("setDate", new Date(visit_date));
        var followup_date = $('#visit_next_date').datepicker("getDate");
        var follow_up = $('#visit_days').val();
        const date = new Date(followup_date)
        const dateTimeFormat = new Intl.DateTimeFormat('en', {year: 'numeric', month: 'numeric', day: '2-digit'})
        const [{value: month}, , {value: day}, , {value: year}] = dateTimeFormat.formatToParts(date)
        followup_date = `${day}-${month}-${year}`;

        var patientId = $("#patient_id").val();
        var practitionerId = $("#practitioner_id").val();
        var patientVisitId = $("#patient_visit_id").val();
        var visitDay = $('#visit_days').val();
        var visitDate = $('#visit_next_date').val();
        var runtime = $('#time').text();
        $.ajax({
            type: 'POST',
            url: routes.saveNextVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'patient_id': patientId,
                'patient_visit_id': patientVisitId,
                'practitioner_id': practitionerId,
                'visit_days': visitDay,
                'visit_next_date': visitDate,
                'run_time': runtime,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            }
        });
    }
}

function fetchDoctorDropDown(ele) {
    var doctorId = $(ele).data('id');
    var patientId = $(ele).data('patient-id');
    var patientVisitId = $(ele).data('patient-visit-id');
    var practitionerId = $(ele).data('practitioner-id');

    if (doctorId == undefined) {
        var doctorId = $(ele).val();
    }
    if (doctorId != undefined) {
        $.ajax({
            type: 'POST',
            url: routes.savePatientReferalDoctor,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'patient_id': patientId,
                'patient_visit_id': patientVisitId,
                'refer_doctor_id': doctorId,
                'practitioner_id': practitionerId,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            }
        });
    } else {
        alert('Referal Doctor Id is undefined.')
    }
}

function sendNextVisit(ele) {
    var patientId = $(ele).data('patient-id');
    var patientVisitId = $(ele).data('patient-visit-id');
    var practitionerId = $(ele).data('practitioner-id');
    var visitDay = $('#visit_days').val();
    var visitDate = $('#visit_next_date').val();
    var runtime = $('#time').text();

    $.ajax({
        type: 'POST',
        url: routes.saveNextVisit,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientId,
            'patient_visit_id': patientVisitId,
            'practitioner_id': practitionerId,
            'visit_days': visitDay,
            'visit_next_date': visitDate,
            'run_time': runtime,
        },
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        }
    });
}

//
// $('#visit_template').on('summernote.blur.codeview', function () {
//     var visitTemplate = $('#visit_template').val();
//     var patientVisitId = $('#patient_visit_id').val();
//     $.ajax({
//         type: 'POST',
//         url: routes.submitVisitPresciptionTemplateNOte,
//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content'),
//             'visit_template': visitTemplate,
//             'patient_visit_id': patientVisitId,
//         },
//         success: function (response) {
//             if (response.result == 'success') {
//                 toastr.clear();
//                 window.toastr.success(response.message);
//             }
//             if (response.result == 'error') {
//                 toastr.clear();
//                 window.toastr.error(response.message);
//             }
//         }
//     });
// });

$('form#rx_medicines_form_model').on('submit', function (e) {
    e.preventDefault();
    var form = $('form#rx_medicines_form_model').serialize();

    $.ajax({
        type: 'POST',
        url: routes.rxMedicinesModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalrxm').modal('hide');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$("#bp_sys").blur(function () {
    var bpSys = $("#bp_sys").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (bpSys != null) {
        $.ajax({
            type: 'POST',
            url: routes.bpSysPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'bp_sys': bpSys,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#bp_sys").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#bp_sys").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#bp_sys").val('');
                }
            },
        });
    }
});

$("#bp_sys_2").blur(function () {
    var bpSys2 = $("#bp_sys_2").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (bpSys2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.bpSys2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'bp_sys_2': bpSys2,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#bp_sys_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#bp_sys_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#bp_sys_2").val('');
                }
            },
        });
    }
});

$("#bp_dias").blur(function () {
    var bpDias = $("#bp_dias").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (bpDias != null) {
        $.ajax({
            type: 'POST',
            url: routes.bpDiasPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'bp_dias': bpDias,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#bp_dias").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#bp_dias").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#bp_dias").val('');
                }
            },
        });
    }
});

$("#bp_dias_2").blur(function () {
    var bpDias2 = $("#bp_dias_2").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (bpDias2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.bpDias2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'bp_dias_2': bpDias2,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#bp_dias_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#bp_dias_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#bp_dias_2").val('');
                }
            },
        });
    }
});

$("#pulse").blur(function () {
    var pulse = $("#pulse").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (pulse != null) {
        $.ajax({
            type: 'POST',
            url: routes.pulsePatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'pulse': pulse,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#pulse").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#pulse").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#pulse").val('');
                }
            },
        });
    }
});

$("#pulse_2").blur(function () {
    var pulse2 = $("#pulse_2").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (pulse2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.pulse2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'pulse_2': pulse2,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#pulse_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#pulse_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#pulse_2").val('');
                }
            },
        });
    }
});

$("#weight_lbs").blur(function () {
    var weightLbs = parseFloat($("#weight_lbs").val());
    var num = weightLbs.toFixed(1);
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (weightLbs != null) {
        $.ajax({
            type: 'POST',
            url: routes.weightLbsPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'weight_lbs': num,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#weight_lbs").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#weight_lbs").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#weight_lbs").val('');
                }
            },
        });
    }
});

$("#weight_lbs_2").blur(function () {
    var weightLbs2 = parseFloat($("#weight_lbs_2").val());
    var num = weightLbs2.toFixed(1);
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (weightLbs2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.weightLbs2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'weight_lbs_2': num,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#weight_lbs_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#weight_lbs_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#weight_lbs_2").val('');
                }
            },
        });
    }
});

$("#weight_kgs").blur(function () {
    var weightKgs = parseFloat($("#weight_kgs").val());
    var num = weightKgs.toFixed(1);
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (weightKgs != null) {
        $.ajax({
            type: 'POST',
            url: routes.weightKgsPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'weight_kgs': num,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#weight_kgs").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#weight_kgs").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#weight_kgs").val('');
                }
            },
        });
    }
});

$("#weight_kgs_2").blur(function () {
    var weightKgs2 = parseFloat($("#weight_kgs_2").val());
    var num = weightKgs2.toFixed(1);
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (weightKgs2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.weightKgs2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'weight_kgs_2': num,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#weight_kgs_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    $("#weight_kgs_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#weight_kgs_2").val('');
                }
            },
        });
    }
});

$("#height_ft").blur(function () {
    var heightFt = $("#height_ft").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (heightFt != null) {
        $.ajax({
            type: 'POST',
            url: routes.heightFtPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'height_ft': heightFt,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#height_ft").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#height_ft").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#height_ft").val('');
                }
            },
        });
    }
});

$("#height_ft_2").blur(function () {
    var heightFt2 = $("#height_ft_2").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (heightFt2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.heightFt2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'height_ft_2': heightFt2,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#height_ft_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#height_ft_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#height_ft_2").val('');
                }
            },
        });
    }
});

$("#height_in").blur(function () {
    var heightFt = $("#height_ft").val();
    var heightIn = $("#height_in").val();
    var heightCms = $("#height_cms").val();
    var weightLbs = $("#weight_lbs").val();
    var weightKgs = $("#weight_kgs").val();

    if (heightFt != null && heightIn != null && weightKgs != null) {
        var heightFtToMeters = heightFt * 0.3048;
        var heightInToMeters = heightIn * 0.0254;
        var height = heightFtToMeters + heightInToMeters;
        var bmiValue = weightKgs / (height * height);
        $("#bmi").val(Math.round(bmiValue));
    }

    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (heightIn != null) {
        $.ajax({
            type: 'POST',
            url: routes.heightInPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'height_in': heightIn,
                'bmi': bmiValue,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#height_in").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#height_in").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#height_in").val('');
                }
            },
        });
    }
});

$("#height_in_2").blur(function () {
    var heightFt2 = $("#height_ft_2").val();
    var heightIn2 = $("#height_in_2").val();

    var heightCms2 = $("#height_cms_2").val();
    var weightLbs2 = $("#weight_lbs_2").val();
    var weightKgs2 = $("#weight_kgs_2").val();

    if (heightFt2 != null && heightIn2 != null && weightKgs2 != null) {
        var heightFtToMeters = heightFt2 * 0.3048;
        var heightInToMeters = heightIn2 * 0.0254;
        var height = heightFtToMeters + heightInToMeters;
        var bmiValue = weightKgs2 / (height * height);
        $("#bmi_2").val(Math.round(bmiValue));
    }
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (heightIn2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.heightIn2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'height_in_2': heightIn2,
                'bmi_2': bmiValue,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#height_in_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#height_in_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#height_in_2").val('');
                }
            },
        });
    }
});

$("#height_cms").blur(function () {
    var heightCms = $("#height_cms").val();
    var weightKgs = $("#weight_kgs").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();

    if (heightCms != null && weightKgs != null) {
        var heightToMeters = heightCms / 100;
        var bmiValue = weightKgs / (heightToMeters * heightToMeters);
        $("#bmi").val(Math.round(bmiValue));
    }
    if (heightCms != null) {
        $.ajax({
            type: 'POST',
            url: routes.heightCmsPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'height_cms': heightCms,
                'bmi': bmiValue,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#height_cms").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#height_cms").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#height_cms").val('');
                }
            },
        });
    }
});

$("#height_cms_2").blur(function () {
    var heightCms2 = $("#height_cms_2").val();
    var weightKgs = $("#weight_kgs").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();

    if (heightCms2 != null && weightKgs != null) {
        var heightToMeters = heightCms2 / 100;
        var bmiValue = weightKgs / (heightToMeters * heightToMeters);
        $("#bmi_2").val(Math.round(bmiValue));
    }
    if (heightCms2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.heightCms2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'height_cms_2': heightCms2,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
                'bmi_2': bmiValue,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#height_cms_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#height_cms_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#height_cms_2").val('');
                }
            },
        });
    }
});

$("#doctor_notes_internal").blur(function () {
    var doctorNoteInternal = $('#doctor_notes_internal').val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (doctorNoteInternal != null) {
        $.ajax({
            type: 'POST',
            url: routes.doctorNoteInternalPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'doctor_notes_internal': doctorNoteInternal,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            },
        });
    }
});

$("#doctor_notes_printed").blur(function () {
    var doctorNotePrinted = $('#doctor_notes_printed').val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (doctorNotePrinted != null) {
        $.ajax({
            type: 'POST',
            url: routes.doctorNotePrintedPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'doctor_notes_printed': doctorNotePrinted,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            },
        });
    }
});

function saveLabTest(ele) {
    var id = $(ele).data('id');
    var patientId = $(ele).data('patient-id');
    var patientVisitId = $(ele).data('patient-visit-id');
    var practitionerId = $(ele).data('practitioner-id');
    if (id == undefined) {
        var id = $(ele).val();
    }
    var elementHtml = '';
    $.ajax({
        type: 'POST',
        url: routes.saveLabTestPatientVisit,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientId,
            'patient_visit_id': patientVisitId,
            'practitioner_id': practitionerId,
            'lab_test_id': id,
        },
        success: function (response) {

            if (response.result == 'already') {
                toastr.clear();
                window.toastr.success(response.message);
            }
            if (response.result == 'added') {
                if (response.record.fasting == 1) {
                    var fastingCondition = 'Yes';
                } else {
                    var fastingCondition = 'No';
                }
                if (response.record.instructions == null) {
                    var instructionsRemarks = 'None';
                } else {
                    var instructionsRemarks = response.record.instructions;
                }
                if (response.record.recommended_lab == null) {
                    var recommendedName = '';
                } else {
                    var recommendedName = response.record.recommended_lab_test.title;
                }
                if (response.record.type_id == null) {
                    var labTestType = '';
                } else {
                    var labTestType = response.record.type_test.title;
                }
                var labTestId = response.record.lab_test_id;
                var labTestName = response.record.lab_test_name;
                var PatientId = response.record.id;
                // var labTestType = response.record.type;
                var fastingModel = response.record.fasting;
                if (response.record.instructions != null) {
                    var instructionsModel = response.record.instructions;
                } else {
                    var instructionsModel = " ";
                }
                var recommendedLabId = response.record.recommended_lab;
                var edit = image.edit;
                var delete1 = image.delete;
                var deleteLabTestPatientVisit = routes.deleteLabTestPatientVisit;
                toastr.clear();
                window.toastr.success(response.message);
                elementHtml = '<tr class="labtest' + labTestId + '">';
                elementHtml += '<td class="p-2">' + labTestName + '</td>';
                elementHtml += '<td class="text-center p-2">' + labTestType + '</td>';
                elementHtml += '<td class="text-center p-2">' + fastingCondition + '</td>';
                elementHtml += '<td class="p-2">' + instructionsRemarks + '</td>';
                elementHtml += '<td class="p-2">' + recommendedName + '</td>';
                elementHtml += '<td class="text-center p-2"><a type="button" data-id=' + PatientId + ' data-lab-test-id=' + labTestId + ' data-lab-test-name=' + encodeURIComponent(labTestName) + ' data-type=' + response.record.type_id + ' data-fasting=' + fastingModel + ' data-instructions=' + encodeURIComponent(instructionsModel) + ' data-recommended-lab=' + recommendedLabId + ' onclick="modalEditLabTestPopUp(this)"><img src=' + edit + ' class="mr-2"></a><a data-id=' + response.record.id + ' onclick="deleteLabTest(this)" type="button"><img src=' + delete1 + '></a></td>';
                elementHtml += '</tr>';
                $('#labtest_body').append(elementHtml);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        }
    });
}

function deleteLabTest(ele) {
    var id = $(ele).data('id');
    if (id != undefined && id != null) {
        $.ajax({
            type: 'POST',
            url: routes.deleteLabTestPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'id': id,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    window.toastr.success(response.message);
                    $(ele).parent().parent().hide();
                }
                if (response.result == 'error') {
                    toastr.clear();
                    window.toastr.error(response.message);
                }
            },
        });
    }
}

function modalEditLabTestPopUp(ele) {
    var id = $(ele).data('id');
    var labTestId = $(ele).data('lab-test-id');
    var labTestName = $(ele).data('lab-test-name');
    var decodeLabName = decodeURIComponent(labTestName);
    var type = $(ele).data('type');
    var fasting = $(ele).data('fasting');
    var instructions = $(ele).data('instructions');
    var decodeInstructions = decodeURIComponent(instructions);
    var recommendedLab = $(ele).data('recommended-lab');
    $('#edit_lab_test_form_post').find('#patient_lab_test_id').val(id);
    $('#edit_lab_test_form_post').find('#lab_test_id').val(labTestId);
    $('#edit_lab_test_form_post').find('#lab_test_name').val(decodeLabName);
    $('#edit_lab_test_form_post').find('#type_lab_test').val(type);
    $('#edit_lab_test_form_post').find('#fasting_lab_test').val(fasting);
    $('#edit_lab_test_form_post').find('#recommended_lab_test').val(recommendedLab);
    $('#edit_lab_test_form_post').find('#instructions_lab_test').val(decodeInstructions);
    $('#modalEditLabTest').modal('show');
}

$('form#edit_lab_test_form_post').on('submit', function (e) {
    e.preventDefault();

    var form = $('form#edit_lab_test_form_post').serialize();

    $.ajax({
        type: 'POST',
        url: routes.updatePatientLabTestModelPost,
        data: form,
        success: function (response) {
            // console.log(response.record)
            if (response.result == 'success') {
                var labTestId = response.record.lab_test_id;
                $(".labtest" + labTestId).last().remove();
                $('#modalEditLabTest').modal('hide');

                if (response.record.fasting == 1) {
                    var fastingCondition = 'Yes';
                } else {
                    var fastingCondition = 'No';
                }
                if (response.record.instructions == null) {
                    var instructionsRemarks = 'None';
                } else {
                    var instructionsRemarks = response.record.instructions;
                }
                if (response.record.recommended_lab == null) {
                    var recommendedName = '';
                } else {
                    var recommendedName = response.record.recommended_lab_test.title;
                }
                if (response.record.type_id == null) {
                    var labTestType = '';
                } else {
                    var labTestType = response.record.type_test.title;
                }
                var labTestName = response.record.lab_test_name;
                var PatientId = response.record.id;
                // var labTestType = response.record.type;
                var fastingModel = response.record.fasting;
                var instructionsModel = response.record.instructions;
                var recommendedLabId = response.record.recommended_lab;
                var edit = image.edit;
                var delete1 = image.delete;
                var deleteLabTestPatientVisit = routes.deleteLabTestPatientVisit;
                toastr.clear();
                window.toastr.success(response.message);
                elementHtml = '<tr class="labtest' + labTestId + '">';
                elementHtml += '<td class="p-2">' + labTestName + '</td>';
                elementHtml += '<td class="text-center p-2">' + labTestType + '</td>';
                elementHtml += '<td class="text-center p-2">' + fastingCondition + '</td>';
                elementHtml += '<td class="p-2">' + instructionsRemarks + '</td>';
                elementHtml += '<td class="p-2">' + recommendedName + '</td>';
                elementHtml += '<td class="text-center p-2"><a type="button" data-id=' + PatientId + ' data-lab-test-id=' + labTestId + ' data-lab-test-name=' + encodeURIComponent(labTestName) + ' data-type=' + response.record.type_id + ' data-fasting=' + fastingModel + ' data-instructions=' + encodeURIComponent(instructionsModel) + ' data-recommended-lab=' + recommendedLabId + ' onclick="modalEditLabTestPopUp(this)"><img src=' + edit + ' class="mr-2"></a><a data-id=' + response.record.id + ' onclick="deleteLabTest(this)" type="button"><img src=' + delete1 + '></a></td>';
                elementHtml += '</tr>';
                $('#labtest_body').append(elementHtml);
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$("#bsf").blur(function () {
    var bsf = $("#bsf").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (bsf != null) {
        $.ajax({
            type: 'POST',
            url: routes.bsfPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'bsf': bsf,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#bsf").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#bsf").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#bsf").val('');
                }
            },
        });
    }
});

$("#bsf_2").blur(function () {
    var bsf2 = $("#bsf_2").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (bsf2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.bsf2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'bsf_2': bsf2,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#bsf_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#bsf_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#bsf_2").val('');
                }
            },
        });
    }
});

$("#bsr").blur(function () {
    var bsr = $("#bsr").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (bsr != null) {
        $.ajax({
            type: 'POST',
            url: routes.bsrPatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'bsr': bsr,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#bsr").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#bsr").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#bsr").val('');
                }
            },
        });
    }
});

$("#bsr_2").blur(function () {
    var bsr2 = $("#bsr_2").val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (bsr2 != null) {
        $.ajax({
            type: 'POST',
            url: routes.bsr2PatientVisit,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'bsr_2': bsr2,
                'patient_id': patientID,
                'practitioner_id': practitionerID,
                'patient_visit_id': patientVisitID,
            },
            success: function (response) {
                if (response.result == 'success') {
                    toastr.clear();
                    $("#bsr_2").removeClass('error-response');
                    window.toastr.success(response.message);
                }
                if (response.result == 'error') {
                    toastr.clear();
                    $("#bsr_2").addClass('error-response');
                    window.toastr.error(response.message);
                    $("#bsr_2").val('');
                }
            },
        });
    }
});

function checkSugarChart(element, status, dataAttr) {
    $(element).closest('td').addClass('fill-bg');
    $(element).closest('td').attr("onclick", 'unCheckSugarChart(this, 0, \'' + dataAttr + '\')');
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (dataAttr == 'day1BeforeBreakfast') {
        var day1BeforeBreakfast = status;
    }
    if (dataAttr == 'day2BeforeBreakfast') {
        var day2BeforeBreakfast = status;
    }
    if (dataAttr == 'day3BeforeBreakfast') {
        var day3BeforeBreakfast = status;
    }
    if (dataAttr == 'day4BeforeBreakfast') {
        var day4BeforeBreakfast = status;
    }
    if (dataAttr == 'day5BeforeBreakfast') {
        var day5BeforeBreakfast = status;
    }
    if (dataAttr == 'day6BeforeBreakfast') {
        var day6BeforeBreakfast = status;
    }
    if (dataAttr == 'day7BeforeBreakfast') {
        var day7BeforeBreakfast = status;
    }
    if (dataAttr == 'day12HoursAfterBreakfast') {
        var day12HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day22HoursAfterBreakfast') {
        var day22HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day32HoursAfterBreakfast') {
        var day32HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day42HoursAfterBreakfast') {
        var day42HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day52HoursAfterBreakfast') {
        var day52HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day62HoursAfterBreakfast') {
        var day62HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day72HoursAfterBreakfast') {
        var day72HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day1BeforeLunch') {
        var day1BeforeLunch = status;
    }
    if (dataAttr == 'day2BeforeLunch') {
        var day2BeforeLunch = status;
    }
    if (dataAttr == 'day3BeforeLunch') {
        var day3BeforeLunch = status;
    }
    if (dataAttr == 'day4BeforeLunch') {
        var day4BeforeLunch = status;
    }
    if (dataAttr == 'day5BeforeLunch') {
        var day5BeforeLunch = status;
    }
    if (dataAttr == 'day6BeforeLunch') {
        var day6BeforeLunch = status;
    }
    if (dataAttr == 'day7BeforeLunch') {
        var day7BeforeLunch = status;
    }
    if (dataAttr == 'day12HoursAfterLunch') {
        var day12HoursAfterLunch = status;
    }
    if (dataAttr == 'day22HoursAfterLunch') {
        var day22HoursAfterLunch = status;
    }
    if (dataAttr == 'day32HoursAfterLunch') {
        var day32HoursAfterLunch = status;
    }
    if (dataAttr == 'day42HoursAfterLunch') {
        var day42HoursAfterLunch = status;
    }
    if (dataAttr == 'day52HoursAfterLunch') {
        var day52HoursAfterLunch = status;
    }
    if (dataAttr == 'day62HoursAfterLunch') {
        var day62HoursAfterLunch = status;
    }
    if (dataAttr == 'day72HoursAfterLunch') {
        var day72HoursAfterLunch = status;
    }
    if (dataAttr == 'day1BeforeDinner') {
        var day1BeforeDinner = status;
    }
    if (dataAttr == 'day2BeforeDinner') {
        var day2BeforeDinner = status;
    }
    if (dataAttr == 'day3BeforeDinner') {
        var day3BeforeDinner = status;
    }
    if (dataAttr == 'day4BeforeDinner') {
        var day4BeforeDinner = status;
    }
    if (dataAttr == 'day5BeforeDinner') {
        var day5BeforeDinner = status;
    }
    if (dataAttr == 'day6BeforeDinner') {
        var day6BeforeDinner = status;
    }
    if (dataAttr == 'day7BeforeDinner') {
        var day7BeforeDinner = status;
    }
    if (dataAttr == 'day12HoursAfterDinner') {
        var day12HoursAfterDinner = status;
    }
    if (dataAttr == 'day22HoursAfterDinner') {
        var day22HoursAfterDinner = status;
    }
    if (dataAttr == 'day32HoursAfterDinner') {
        var day32HoursAfterDinner = status;
    }
    if (dataAttr == 'day42HoursAfterDinner') {
        var day42HoursAfterDinner = status;
    }
    if (dataAttr == 'day52HoursAfterDinner') {
        var day52HoursAfterDinner = status;
    }
    if (dataAttr == 'day62HoursAfterDinner') {
        var day62HoursAfterDinner = status;
    }
    if (dataAttr == 'day72HoursAfterDinner') {
        var day72HoursAfterDinner = status;
    }
    if (dataAttr == 'day1BedTime') {
        var day1BedTime = status;
    }
    if (dataAttr == 'day2BedTime') {
        var day2BedTime = status;
    }
    if (dataAttr == 'day3BedTime') {
        var day3BedTime = status;
    }
    if (dataAttr == 'day4BedTime') {
        var day4BedTime = status;
    }
    if (dataAttr == 'day5BedTime') {
        var day5BedTime = status;
    }
    if (dataAttr == 'day6BedTime') {
        var day6BedTime = status;
    }
    if (dataAttr == 'day7BedTime') {
        var day7BedTime = status;
    }
    if (dataAttr == 'day1At3am') {
        var day1At3am = status;
    }
    if (dataAttr == 'day2At3am') {
        var day2At3am = status;
    }
    if (dataAttr == 'day3At3am') {
        var day3At3am = status;
    }
    if (dataAttr == 'day4At3am') {
        var day4At3am = status;
    }
    if (dataAttr == 'day5At3am') {
        var day5At3am = status;
    }
    if (dataAttr == 'day6At3am') {
        var day6At3am = status;
    }
    if (dataAttr == 'day7At3am') {
        var day7At3am = status;
    }

    $.ajax({
        type: 'POST',
        url: routes.checkSugarChart,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientID,
            'patient_visit_id': patientVisitID,
            'practitioner_id': practitionerID,
            'day_1_before_breakfast': day1BeforeBreakfast,
            'day_2_before_breakfast': day2BeforeBreakfast,
            'day_3_before_breakfast': day3BeforeBreakfast,
            'day_4_before_breakfast': day4BeforeBreakfast,
            'day_5_before_breakfast': day5BeforeBreakfast,
            'day_6_before_breakfast': day6BeforeBreakfast,
            'day_7_before_breakfast': day7BeforeBreakfast,
            'day_1_2_hours_after_breakfast': day12HoursAfterBreakfast,
            'day_2_2_hours_after_breakfast': day22HoursAfterBreakfast,
            'day_3_2_hours_after_breakfast': day32HoursAfterBreakfast,
            'day_4_2_hours_after_breakfast': day42HoursAfterBreakfast,
            'day_5_2_hours_after_breakfast': day52HoursAfterBreakfast,
            'day_6_2_hours_after_breakfast': day62HoursAfterBreakfast,
            'day_7_2_hours_after_breakfast': day72HoursAfterBreakfast,
            'day_1_before_lunch': day1BeforeLunch,
            'day_2_before_lunch': day2BeforeLunch,
            'day_3_before_lunch': day3BeforeLunch,
            'day_4_before_lunch': day4BeforeLunch,
            'day_5_before_lunch': day5BeforeLunch,
            'day_6_before_lunch': day6BeforeLunch,
            'day_7_before_lunch': day7BeforeLunch,
            'day_1_2_hours_after_lunch': day12HoursAfterLunch,
            'day_2_2_hours_after_lunch': day22HoursAfterLunch,
            'day_3_2_hours_after_lunch': day32HoursAfterLunch,
            'day_4_2_hours_after_lunch': day42HoursAfterLunch,
            'day_5_2_hours_after_lunch': day52HoursAfterLunch,
            'day_6_2_hours_after_lunch': day62HoursAfterLunch,
            'day_7_2_hours_after_lunch': day72HoursAfterLunch,
            'day_1_before_dinner': day1BeforeDinner,
            'day_2_before_dinner': day2BeforeDinner,
            'day_3_before_dinner': day3BeforeDinner,
            'day_4_before_dinner': day4BeforeDinner,
            'day_5_before_dinner': day5BeforeDinner,
            'day_6_before_dinner': day6BeforeDinner,
            'day_7_before_dinner': day7BeforeDinner,
            'day_1_2_hours_after_dinner': day12HoursAfterDinner,
            'day_2_2_hours_after_dinner': day22HoursAfterDinner,
            'day_3_2_hours_after_dinner': day32HoursAfterDinner,
            'day_4_2_hours_after_dinner': day42HoursAfterDinner,
            'day_5_2_hours_after_dinner': day52HoursAfterDinner,
            'day_6_2_hours_after_dinner': day62HoursAfterDinner,
            'day_7_2_hours_after_dinner': day72HoursAfterDinner,
            'day_1_bed_time': day1BedTime,
            'day_2_bed_time': day2BedTime,
            'day_3_bed_time': day3BedTime,
            'day_4_bed_time': day4BedTime,
            'day_5_bed_time': day5BedTime,
            'day_6_bed_time': day6BedTime,
            'day_7_bed_time': day7BedTime,
            'day_1_at_3_am': day1At3am,
            'day_2_at_3_am': day2At3am,
            'day_3_at_3_am': day3At3am,
            'day_4_at_3_am': day4At3am,
            'day_5_at_3_am': day5At3am,
            'day_6_at_3_am': day6At3am,
            'day_7_at_3_am': day7At3am,
        },
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        }
    });

}

function unCheckSugarChart(element, status, dataAttr) {
    $(element).closest('td').removeClass('fill-bg');
    $(element).closest('td').attr("onclick", 'checkSugarChart(this, 1, \'' + dataAttr + '\')');
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    if (dataAttr == 'day1BeforeBreakfast') {
        var day1BeforeBreakfast = status;
    }
    if (dataAttr == 'day2BeforeBreakfast') {
        var day2BeforeBreakfast = status;
    }
    if (dataAttr == 'day3BeforeBreakfast') {
        var day3BeforeBreakfast = status;
    }
    if (dataAttr == 'day4BeforeBreakfast') {
        var day4BeforeBreakfast = status;
    }
    if (dataAttr == 'day5BeforeBreakfast') {
        var day5BeforeBreakfast = status;
    }
    if (dataAttr == 'day6BeforeBreakfast') {
        var day6BeforeBreakfast = status;
    }
    if (dataAttr == 'day7BeforeBreakfast') {
        var day7BeforeBreakfast = status;
    }
    if (dataAttr == 'day12HoursAfterBreakfast') {
        var day12HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day22HoursAfterBreakfast') {
        var day22HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day32HoursAfterBreakfast') {
        var day32HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day42HoursAfterBreakfast') {
        var day42HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day52HoursAfterBreakfast') {
        var day52HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day62HoursAfterBreakfast') {
        var day62HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day72HoursAfterBreakfast') {
        var day72HoursAfterBreakfast = status;
    }
    if (dataAttr == 'day1BeforeLunch') {
        var day1BeforeLunch = status;
    }
    if (dataAttr == 'day2BeforeLunch') {
        var day2BeforeLunch = status;
    }
    if (dataAttr == 'day3BeforeLunch') {
        var day3BeforeLunch = status;
    }
    if (dataAttr == 'day4BeforeLunch') {
        var day4BeforeLunch = status;
    }
    if (dataAttr == 'day5BeforeLunch') {
        var day5BeforeLunch = status;
    }
    if (dataAttr == 'day6BeforeLunch') {
        var day6BeforeLunch = status;
    }
    if (dataAttr == 'day7BeforeLunch') {
        var day7BeforeLunch = status;
    }
    if (dataAttr == 'day12HoursAfterLunch') {
        var day12HoursAfterLunch = status;
    }
    if (dataAttr == 'day22HoursAfterLunch') {
        var day22HoursAfterLunch = status;
    }
    if (dataAttr == 'day32HoursAfterLunch') {
        var day32HoursAfterLunch = status;
    }
    if (dataAttr == 'day42HoursAfterLunch') {
        var day42HoursAfterLunch = status;
    }
    if (dataAttr == 'day52HoursAfterLunch') {
        var day52HoursAfterLunch = status;
    }
    if (dataAttr == 'day62HoursAfterLunch') {
        var day62HoursAfterLunch = status;
    }
    if (dataAttr == 'day72HoursAfterLunch') {
        var day72HoursAfterLunch = status;
    }
    if (dataAttr == 'day1BeforeDinner') {
        var day1BeforeDinner = status;
    }
    if (dataAttr == 'day2BeforeDinner') {
        var day2BeforeDinner = status;
    }
    if (dataAttr == 'day3BeforeDinner') {
        var day3BeforeDinner = status;
    }
    if (dataAttr == 'day4BeforeDinner') {
        var day4BeforeDinner = status;
    }
    if (dataAttr == 'day5BeforeDinner') {
        var day5BeforeDinner = status;
    }
    if (dataAttr == 'day6BeforeDinner') {
        var day6BeforeDinner = status;
    }
    if (dataAttr == 'day7BeforeDinner') {
        var day7BeforeDinner = status;
    }
    if (dataAttr == 'day12HoursAfterDinner') {
        var day12HoursAfterDinner = status;
    }
    if (dataAttr == 'day22HoursAfterDinner') {
        var day22HoursAfterDinner = status;
    }
    if (dataAttr == 'day32HoursAfterDinner') {
        var day32HoursAfterDinner = status;
    }
    if (dataAttr == 'day42HoursAfterDinner') {
        var day42HoursAfterDinner = status;
    }
    if (dataAttr == 'day52HoursAfterDinner') {
        var day52HoursAfterDinner = status;
    }
    if (dataAttr == 'day62HoursAfterDinner') {
        var day62HoursAfterDinner = status;
    }
    if (dataAttr == 'day72HoursAfterDinner') {
        var day72HoursAfterDinner = status;
    }
    if (dataAttr == 'day1BedTime') {
        var day1BedTime = status;
    }
    if (dataAttr == 'day2BedTime') {
        var day2BedTime = status;
    }
    if (dataAttr == 'day3BedTime') {
        var day3BedTime = status;
    }
    if (dataAttr == 'day4BedTime') {
        var day4BedTime = status;
    }
    if (dataAttr == 'day5BedTime') {
        var day5BedTime = status;
    }
    if (dataAttr == 'day6BedTime') {
        var day6BedTime = status;
    }
    if (dataAttr == 'day7BedTime') {
        var day7BedTime = status;
    }
    if (dataAttr == 'day1At3am') {
        var day1At3am = status;
    }
    if (dataAttr == 'day2At3am') {
        var day2At3am = status;
    }
    if (dataAttr == 'day3At3am') {
        var day3At3am = status;
    }
    if (dataAttr == 'day4At3am') {
        var day4At3am = status;
    }
    if (dataAttr == 'day5At3am') {
        var day5At3am = status;
    }
    if (dataAttr == 'day6At3am') {
        var day6At3am = status;
    }
    if (dataAttr == 'day7At3am') {
        var day7At3am = status;
    }

    $.ajax({
        type: 'POST',
        url: routes.unCheckSugarChart,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientID,
            'patient_visit_id': patientVisitID,
            'practitioner_id': practitionerID,
            'day_1_before_breakfast': day1BeforeBreakfast,
            'day_2_before_breakfast': day2BeforeBreakfast,
            'day_3_before_breakfast': day3BeforeBreakfast,
            'day_4_before_breakfast': day4BeforeBreakfast,
            'day_5_before_breakfast': day5BeforeBreakfast,
            'day_6_before_breakfast': day6BeforeBreakfast,
            'day_7_before_breakfast': day7BeforeBreakfast,
            'day_1_2_hours_after_breakfast': day12HoursAfterBreakfast,
            'day_2_2_hours_after_breakfast': day22HoursAfterBreakfast,
            'day_3_2_hours_after_breakfast': day32HoursAfterBreakfast,
            'day_4_2_hours_after_breakfast': day42HoursAfterBreakfast,
            'day_5_2_hours_after_breakfast': day52HoursAfterBreakfast,
            'day_6_2_hours_after_breakfast': day62HoursAfterBreakfast,
            'day_7_2_hours_after_breakfast': day72HoursAfterBreakfast,
            'day_1_before_lunch': day1BeforeLunch,
            'day_2_before_lunch': day2BeforeLunch,
            'day_3_before_lunch': day3BeforeLunch,
            'day_4_before_lunch': day4BeforeLunch,
            'day_5_before_lunch': day5BeforeLunch,
            'day_6_before_lunch': day6BeforeLunch,
            'day_7_before_lunch': day7BeforeLunch,
            'day_1_2_hours_after_lunch': day12HoursAfterLunch,
            'day_2_2_hours_after_lunch': day22HoursAfterLunch,
            'day_3_2_hours_after_lunch': day32HoursAfterLunch,
            'day_4_2_hours_after_lunch': day42HoursAfterLunch,
            'day_5_2_hours_after_lunch': day52HoursAfterLunch,
            'day_6_2_hours_after_lunch': day62HoursAfterLunch,
            'day_7_2_hours_after_lunch': day72HoursAfterLunch,
            'day_1_before_dinner': day1BeforeDinner,
            'day_2_before_dinner': day2BeforeDinner,
            'day_3_before_dinner': day3BeforeDinner,
            'day_4_before_dinner': day4BeforeDinner,
            'day_5_before_dinner': day5BeforeDinner,
            'day_6_before_dinner': day6BeforeDinner,
            'day_7_before_dinner': day7BeforeDinner,
            'day_1_2_hours_after_dinner': day12HoursAfterDinner,
            'day_2_2_hours_after_dinner': day22HoursAfterDinner,
            'day_3_2_hours_after_dinner': day32HoursAfterDinner,
            'day_4_2_hours_after_dinner': day42HoursAfterDinner,
            'day_5_2_hours_after_dinner': day52HoursAfterDinner,
            'day_6_2_hours_after_dinner': day62HoursAfterDinner,
            'day_7_2_hours_after_dinner': day72HoursAfterDinner,
            'day_1_bed_time': day1BedTime,
            'day_2_bed_time': day2BedTime,
            'day_3_bed_time': day3BedTime,
            'day_4_bed_time': day4BedTime,
            'day_5_bed_time': day5BedTime,
            'day_6_bed_time': day6BedTime,
            'day_7_bed_time': day7BedTime,
            'day_1_at_3_am': day1At3am,
            'day_2_at_3_am': day2At3am,
            'day_3_at_3_am': day3At3am,
            'day_4_at_3_am': day4At3am,
            'day_5_at_3_am': day5At3am,
            'day_6_at_3_am': day6At3am,
            'day_7_at_3_am': day7At3am,
        },
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        }
    });

}

$('form#patient_edit_profile_form_model').on('submit', function (e) {
    e.preventDefault();

    var form = $('form#patient_edit_profile_form_model').serialize();

    $.ajax({
        type: 'POST',
        url: routes.patientEditProfileModelPost,
        data: form,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                $('#modalPatientEditProfile').modal('hide');
                $(".patientInfoDetail").load(location.href + " .patientInfoDetail");

            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

$('form#patient_report_upload_form_model').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type: 'POST',
        url: routes.patientReportUploadModelPost,
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);

                $('#modalPatientReportUpload').modal('hide');
                window.location.reload();
                // // $(".reload_for_div").load(location.href + " .reload_for_div");
                // // $(".reload_for_div").load(location.href + " .reload_for_div");
                // var tt = $('.owl-wrapper-outer .owl-wrapper').html();
                // // alert(tt);
                // var HTMLText = '<div class="owl-item" style="width: 203px;"><div class="item text-center">\
                //                 <a type="button" data-toggle="modal" data-target="#reportsPopupModal9">\
                //                 <div class="lab-img">\
                //                 <img src="http://localhost/eon/storage/app/public/reportImages/wKSghxOVzKJFncDTxXEj6ndB6gdoEa0nuwxtRClL.png" style="height: 90px;\
                //                 width: 131px;">\
                //                 <i class="fa fa-search"></i>\
                //                 </div>\
                //                 <p class="lab-rep m-0">Qaiser</p>\
                //                 <p class="rep-date m-0">2020</p>\
                //                 </a>\
                // //                 </div></div>';
                // var HTMLText = '<div class="item text-center">\
                //         <a type="button" data-toggle="modal"\
                //            data-target="#reportsPopupModal{{$report->id}}">\
                //             <div class="lab-img">\
                //                 <img src="http://localhost/eon/storage/app/public/reportImages/wKSghxOVzKJFncDTxXEj6ndB6gdoEa0nuwxtRClL.png"\
                //                      style="height: 90px;\
                //                 width: 131px;">\
                //                 <i class="fa fa-search"></i>\
                //             </div>\
                //             <p class="lab-rep m-0">waqas</p>\
                //             <p class="rep-date m-0">2020</p>\
                //         </a>\
                //     </div>';
                // // var owl = $('.owl-carousel');
                // owl.owlCarousel();
                // $('.owl-wrapper').append(HTMLText);
                // window.dispatchEvent(new Event('resize'));
                // var $owl = $('.owl-carousel').owlCarousel({
                //     items: 10,
                //     loop:true
                // });
                // $owl.trigger('refresh.owl.carousel');
                // $('.owl-carousel').owlCarousel();
                // myCarousel.trigger("remove.owl.carousel");
                // $(".my-carousel").html(HTMLText);
                // myCarouselStart();
                // $('.owl-carousel')
                //     .trigger('add.owl.carousel', [$(HTMLText), 0])
                //     .trigger('rebuild.owl.carousel');
                // $('.owl-carousel').owlCarousel('add', HTMLText).owlCarousel('refresh')

                // owl.owlCarousel();
                // $('.owl-carousel').append(HTMLText);
                // $('.owl-carousel').owlCarousel('add', HTMLText).owlCarousel('update');
                // $('.owl-wrapper').append(HTMLText);
                // $('.owl-carousel').append(tt);
                // owl.trigger('refresh.owl.carousel');
            }
        },
        error: function (data) {
            $.each(data.responseJSON.errors, function (key, value) {
                window.toastr.error(value);
            });
        }
    });
});

function copyPreviousVisits(patientId, practitionerId, patientVisitId) {
    // console.log(patientId, practitionerId,patientVisitId);
    $.ajax({
        type: 'POST',
        url: routes.getPreviousVisitDetails,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientId,
            'practitioner_id': practitionerId,
            'patient_visit_id': patientVisitId,
        },
        success: function (response) {
            if (response.result == 'success') {
                console.log(response);
                //
                // $('#bmi').val(response.patientVisit.patient_vital.bmi);
                // $('#bsf').val(response.patientVisit.patient_vital.bsf);
                // $('#bsr').val(response.patientVisit.patient_vital.bsr);
                // $('#height_cms').val(response.patientVisit.patient_vital.height_cms);
                // $('#height_ft').val(response.patientVisit.patient_vital.height_ft);
                // $('#height_in').val(response.patientVisit.patient_vital.height_in);
                // $('#pulse').val(response.patientVisit.patient_vital.pulse);
                // $('#weight_kgs').val(response.patientVisit.patient_vital.weight_kgs);
                // $('#weight_lbs').val(response.patientVisit.patient_vital.weight_lbs);
                // $('#bp_dias').val(response.patientVisit.patient_vital.bp_dias);
                // $('#bp_sys').val(response.patientVisit.patient_vital.bp_sys);

                // if (response.patientVisitPrescription != null) {
                //     $('#visit_template').summernote('code', response.patientVisitPrescription.prescription);
                // }

                var s = response.patientVisitPrescription;
                if (s != null) {
                    tinymce.get('visit_template').setContent(response.patientVisitPrescription.prescription);
                }
                // if (response.patientVisit.patient_vital.bmi_2 != null || response.patientVisit.patient_vital.bsf_2 != null || response.patientVisit.patient_vital.height_in_2 != null || response.patientVisit.patient_vital.height_cms_2 != null || response.patientVisit.patient_vital.height_ft_2 != null || response.patientVisit.patient_vital.bp_sys_2 != null || response.patientVisit.patient_vital.bp_dias_2 != null || response.patientVisit.patient_vital.pulse_2 != null || response.patientVisit.patient_vital.weight_lbs_2 != null || response.patientVisit.patient_vital.weight_kgs_2 != null) {
                //     $('.vitals-row2').css("display", "block");
                //     $('#bmi_2').val(response.patientVisit.patient_vital.bmi_2);
                //     $('#bsf_2').val(response.patientVisit.patient_vital.bsf_2);
                //     $('#height_in_2').val(response.patientVisit.patient_vital.height_in_2);
                //     $('#bsr_2').val(response.patientVisit.patient_vital.bsr_2);
                //     $('#height_cms_2').val(response.patientVisit.patient_vital.height_cms_2);
                //     $('#height_ft_2').val(response.patientVisit.patient_vital.height_ft_2);
                //     $('#bp_sys_2').val(response.patientVisit.patient_vital.bp_sys_2);
                //     $('#bp_dias_2').val(response.patientVisit.patient_vital.bp_dias_2);
                //     $('#pulse_2').val(response.patientVisit.patient_vital.pulse_2);
                //     $('#weight_lbs_2').val(response.patientVisit.patient_vital.weight_lbs_2);
                //     $('#weight_kgs_2').val(response.patientVisit.patient_vital.weight_kgs_2);
                // }

                savePreviousVisitData(patientId, practitionerId, patientVisitId);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        },
    });
}

function savePreviousVisitData(patientId, practitionerId, patientVisitId) {
    $.ajax({
        type: 'POST',
        url: routes.savePreviousVisitDetails,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientId,
            'practitioner_id': practitionerId,
            'patient_visit_id': patientVisitId,
            'patient_visit_id_current': $("#patient_visit_id").val(),
        },
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        },
    });
}

function viewPreviousVisit(patientId, practitionerId, patientVisitId) {
    var HtmlElementView = '';
    $.ajax({
        type: 'POST',
        url: routes.getPreviousVisitDetails,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientId,
            'practitioner_id': practitionerId,
            'patient_visit_id': patientVisitId,
        },
        success: function (response) {
            if (response.result == 'success') {
                console.log(response);
                if (response.patientVisit.patient_vital != null) {
                    if (response.patientVisit.patient_vital.weight_kgs == null) {
                        var weight = response.patientVisit.patient_vital.weight_lbs;
                    } else {
                        var weight = response.patientVisit.patient_vital.weight_kgs;
                    }
                    if (response.patientVisit.patient_vital.weight_kgs_2 == null) {
                        var weight_2 = response.patientVisit.patient_vital.weight_lbs_2;
                    } else {
                        var weight_2 = response.patientVisit.patient_vital.weight_kgs_2;
                    }

                    if (response.patientVisit.patient_vital.height_cms == null) {
                        var height = response.patientVisit.patient_vital.height_ft + ', ' + response.patientVisit.patient_vital.height_in;
                    } else {
                        var height = response.patientVisit.patient_vital.height_cms;
                    }
                    if (response.patientVisit.patient_vital.height_cms_2 == null) {
                        var height_2 = response.patientVisit.patient_vital.height_ft_2 + ', ' + response.patientVisit.patient_vital.height_in_2;
                    } else {
                        var height_2 = response.patientVisit.patient_vital.height_cms_2;
                    }
                    var bp = response.patientVisit.patient_vital.bp_sys + '/' + response.patientVisit.patient_vital.bp_dias;
                    var bp_2 = response.patientVisit.patient_vital.bp_sys_2 + '/' + response.patientVisit.patient_vital.bp_dias_2;

                    if (response.patientVisit.patient_vital.bmi != null) {
                        var bmi = response.patientVisit.patient_vital.bmi;
                    } else {
                        var bmi = '';
                    }
                    if (response.patientVisit.patient_vital.bmi_2 != null) {
                        var bmi_2 = response.patientVisit.patient_vital.bmi_2;
                    } else {
                        var bmi_2 = '';
                    }
                    if (response.patientVisit.patient_vital.pulse != null) {
                        var pulse = response.patientVisit.patient_vital.pulse;
                    } else {
                        var pulse = '';
                    }
                    if (response.patientVisit.patient_vital.pulse_2 != null) {
                        var pulse_2 = response.patientVisit.patient_vital.pulse_2;
                    } else {
                        var pulse_2 = '';
                    }
                    if (response.patientVisit.patient_vital.bsf != null) {
                        var bsf = response.patientVisit.patient_vital.bsf;
                    } else {
                        var bsf = '';
                    }
                    if (response.patientVisit.patient_vital.bsf_2 != null) {
                        var bsf_2 = response.patientVisit.patient_vital.bsf_2;
                    } else {
                        var bsf_2 = '';
                    }
                    if (response.patientVisit.patient_vital.bsr != null) {
                        var bsr = response.patientVisit.patient_vital.bsr;
                    } else {
                        var bsr = '';
                    }
                    if (response.patientVisit.patient_vital.bsr_2 != null) {
                        var bsr_2 = response.patientVisit.patient_vital.bsr_2;
                    } else {
                        var bsr_2 = '';
                    }
                } else {
                    var weight = '';
                    var weight_2 = '';
                    var height = '';
                    var height_2 = '';
                    var bp = '';
                    var bp_2 = '';
                    var bmi = '';
                    var bmi_2 = '';
                    var pulse = '';
                    var pulse_2 = '';
                    var bsr = '';
                    var bsf = '';
                    var bsf_2 = '';
                    var bsr_2 = '';
                }
                if (response.patientVisitPrescription != null) {
                    var prescription = response.patientVisitPrescription.prescription;
                } else {
                    var prescription = '';
                }

                $('.view-previous-visit-append').remove();

                HtmlElementView = '<div class="view-previous-visit-append">'
                HtmlElementView += '<b class="sidebar-b">Vital Signs</b>';
                HtmlElementView += '<table class="table"><tbody><tr><td><b> Weight </b></td><td>' + weight + '</td>' +
                    '<td><b> Height </b></td><td>' + height + '</td></tr>' +
                    '<tr><td><b> BMI </b></td><td>' + bmi + ' </td><td><b> BP(Sys/Dais) </b></td><td> ' + bp + ' </td></tr><tr><td><b> Pulse Rate </b></td><td>' + pulse + '</td><td><b> BSF </b></td><td>' + bsf + '</td></tr><tr><td><b> BSR </b></td><td>' + bsr + '</td></tr></tbody></table>';
                HtmlElementView += '<hr>';
                if (bmi_2 != null || weight_2 != null || height_2 != null || bp_2 != null || pulse_2 != null || bsf_2 != null || bsr_2 != null) {
                    HtmlElementView += '<b class="sidebar-b">Vital Signs 2</b>';
                    HtmlElementView += '<table class="table"><tbody><tr><td><b> Weight </b></td><td>' + weight_2 + '</td>' +
                        '<td><b> Height </b></td><td>' + height_2 + '</td></tr>' +
                        '<tr><td><b> BMI </b></td><td>' + bmi_2 + ' </td><td><b> BP(Sys/Dais) </b></td><td> ' + bp_2 + ' </td></tr><tr><td><b> Pulse Rate </b></td><td>' + pulse_2 + '</td><td><b> BSF </b></td><td>' + bsf_2 + '</td></tr><tr><td><b> BSR </b></td><td>' + bsr_2 + '</td></tr></tbody></table>';
                    HtmlElementView += '<hr>';
                }
                HtmlElementView += '<b class="sidebar-b">Prescription</b>';
                HtmlElementView += '<p>' + prescription + '</p>';
                HtmlElementView += '</div>';

                $('#view-previous-visit-details').append(HtmlElementView);
                $('#viewPreviousVisit').modal('show')


            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        },
    });
}

function revisePatientVisit(patientId, practitionerId, patientVisitId) {
    // console.log(patientId, practitionerId, patientVisitId);
    $.ajax({
        type: 'POST',
        url: routes.revisePatientVisit,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'patient_id': patientId,
            'practitioner_id': practitionerId,
            'patient_visit_id': patientVisitId,
            'patient_visit_id_current': $("#patient_visit_id").val(),
        },
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        },
    });
}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    window.toastr.success('Link Copied!');
    toastr.clear();
    $temp.remove();
}

function saveAsTemplate(ele) {
    var visitTemplate = $('#visit_template').val();
    var patientID = $("#patient_id").val();
    var practitionerID = $("#practitioner_id").val();
    var patientVisitID = $("#patient_visit_id").val();
    $.ajax({
        type: 'POST',
        url: routes.saveVisitPresciptionTemplate,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            'visit_template': visitTemplate,
            'patient_id': patientID,
            'practitioner_id': practitionerID,
            'patient_visit_id': patientVisitID,
        },
        success: function (response) {
            if (response.result == 'success') {
                toastr.clear();
                window.toastr.success(response.message);
            }
            if (response.result == 'error') {
                toastr.clear();
                window.toastr.error(response.message);
            }
        }
    });
}

