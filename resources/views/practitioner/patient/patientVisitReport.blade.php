<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/admin/dist/img/favicon-32x32.png') }}">
    <style type="text/css">
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        header {
            border-bottom: solid #000;
        }

        .container {
            max-width: 1100px;
            width: 100%;
            margin: auto;
            padding: 0 15px;
        }

        .col-lg-6 {
            width: 50%;
            float: left;
            box-sizing: border-box;
        }

        .col-lg-4 {
            width: 33%;
            float: left;
            box-sizing: border-box;
        }

        h2,
        h3,
        h4 {
            margin: 0 0 10px;
        }

        p {
            margin: 0 0 10px;
        }

        .mt-31 {
            margin-top: 31px;
        }

        .number {
            border: solid 1px #000;
            text-align: center;
            font-size: 20px;
            padding: 0 31px;
            float: right;
            margin-right: 30px;
        }

        .three-col .align-left {
            display: inline-block;
            margin: 0 37px 0 0px;
            vertical-align: top;
        }

        .weight-list {
            width: 1000px;
        }

        .weight-list span {
            margin: 0 12px 0 0px;
        }

        .weight-list span b {
            margin: 0 7px 0 0px;
        }

        .table th {
            font-size: 20px;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            text-align: left;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05);
        }

        table {
            border: solid 1px rgba(0, 0, 0, .05);
            border-collapse: collapse;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .signature {
            max-width: 300px;
            text-align: center;
            width: 100%;
        }

        .signature p {
            border-top: solid 1px #000;
            padding-top: 10px;
        }

        .text-center {
            text-align: center;
        }

        .back-btn-custom {
            background: blue;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
            margin-top: 10px;
            text-decoration: none;
        }

        .back-btn-custom1 {
            background: Green;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
            margin-top: 10px;
            text-decoration: none;
        }

        .back-btn-custom2 {
            background: Gray;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
            margin-top: 10px;
            text-decoration: none;
        }

        .fill-bg {
            background: rgb(193, 193, 193);
        }

        .page_break {
            page-break-before: always;
        }

        @media (max-width: 600px) {

            /* .col-lg-6,
            .col-lg-4 {
                width: 100%;
            } */
            .weight-list {
                margin: 18px 0 0 0;
            }

            .weight-list span {
                line-height: 29px;
            }

            .number {
                padding: 0 12px;
            }

            .mobile-text-center {
                text-align: center;
            }
        }

        @media print {
            .back-btn-custom {
                display: none;
            }

            .back-btn-custom1 {
                display: none;
            }

            .back-btn-custom2 {
                display: none;
            }
        }

        @page {
            size: A4;
        }

        @media print {
            footer {
                position: fixed;
                bottom: 0;
            }

            /*.page_break  {*/
            /*    page-break-before: always;*/
            /*}*/
        }
    </style>
</head>

<body height="1000px">
<div class="col-lg-6 col-md-6 col-sm-6 " align="left"
     style="margin-top: 18px !important;margin-bottom: 18px !important;">

    <a type="button" class="back-btn-custom" href="{{route('practitionerAppointmentList')}}">Back</a>

</div>
<div class="col-lg-6 col-md-6 col-sm-6 " align="right"
     style="margin-top: 18px !important;margin-bottom: 18px !important;">
    <a type="button" class="back-btn-custom2" onclick="sendSms()"
       href="#" style="">Send</a>
    {{--    <a type="button" class="back-btn-custom1" href="#" onclick="window.print();">Print</a>--}}
</div>
{{--<div class="col-lg-12 col-md-12 col-sm-12" align="right" style="margin-top: 18px !important;">--}}
{{--    <a type="button" class="back-btn-custom" href="#" onclick="window.print();">Print</a>--}}
{{--</div>--}}

<iframe src="{{url('/') . '/reports/' . $patientVisit->pdf_report}}" width="100%" height="800px"></iframe>
<script>
    function sendSms() {
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "{{route('sendSMSOnVisit',['patientVisitId'=>$patientVisit->id])}}", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                alert(response);
            }
        };
        xhttp.send();
    }
</script>
</body>

</html>
