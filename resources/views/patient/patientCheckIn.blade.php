<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Eon Health | Patient Check In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row" style="width: 100%;margin: 0 auto;max-width: 20%;margin-top: 5%;">
 <img src="https://myeonhealth.com/public/images/favicon.ico">
</div>
<div class="container" style="text-align:center">
  <h2>Patient Check In</h2>
  <small>Please Press Check In.</small>
  <br>
  <br>
  <form action="javascript:void(0);">
    <div class="form-group">
      <!--<label for="otp">OTP:</label>-->
      <input type="hidden" class="form-control" id="otp" placeholder="Enter OTP" name="otp" value="123456">
    </div>
    <input type="hidden" name="appointmentId" id="appointmentId" value="{{$appointment->id}}">
    <button onclick="checkOTP()" class="btn btn-default">Check In</button>
  </form>
</div>

<script src="https://myeonhealth.com/public/admin/plugins/jquery/jquery.min.js"></script>
<script>
    function checkOTP(){
        var otp = $('#otp').val();
        var appointmentId = $('#appointmentId').val();
        if(otp == "undefined" || otp == ""){
            alert('Please Enter Valid OTP');
            return false;
        }
        $.ajax({
            method: "GET",
            url: "{{url('/checkIn')}}/"+otp+'/'+appointmentId,
            data: {
                'otp': otp,
                'appointmentId': appointmentId
                },
            success: function (response) {
                if(response.status == 0){
                    alert(response.message);
                    return false;
                }
                if(response.status == 1){
                    location.reload();
                }

            }
        });
    }
</script>
</body>
</html>
