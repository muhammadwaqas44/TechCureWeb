<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Eon Health | Patient Check In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row" style="width: 100%;margin: 0 auto;max-width: 20%;margin-top: 5%;">
    <img src="https://myeonhealth.com/public/images/favicon.ico">
</div>
<div class="container">
    <br>
    <br>
    <h2 style="text-align:center">Please Wait. Doctor Will Join You in 5 - 10 Minutes</h2>
    <br>
    <br>
    <div style="width:100%; max-width:50%;margin:0 auto;text-align:center">
        <div class="spinner-grow text-primary"></div>
        <div class="spinner-grow text-success"></div>
        <div class="spinner-grow text-info"></div>
        <div class="spinner-grow text-warning"></div>
        <div class="spinner-grow text-danger"></div>
        <div class="spinner-grow text-secondary"></div>
        <div class="spinner-grow text-dark"></div>
        <div class="spinner-grow text-light"></div>
    </div>
</div>
<input type="hidden" name="appointmentId" id="appointmentId" value="{{$appointment->id}}">
<script src="https://myeonhealth.com/public/admin/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        setInterval(checkAppointment, 5000);
    });

    function checkAppointment() {
        var appointmentId = $('#appointmentId').val();
        $.ajax({
            method: "GET",
            url: "{{url('/checkAppointmentStatus')}}/" + appointmentId,
            data: {
                'appointmentId': appointmentId
            },
            success: function (response) {
                if (response.status == 0) {
                    // alert(response.message);
                    return false;
                }
                if (response.status == 1) {
                    location.reload();
                }

            }
        });
    }
</script>
</body>
</html>
