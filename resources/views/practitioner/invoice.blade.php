<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--        <link rel="stylesheet" href="style.css">--}}
    <title>Appointment Receipt</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        body {
            font-size: 12px;
            font-family: 'Roboto', sans-serif;
        }

        /*.logo {*/
        /*    width: 400px;*/
        /*    margin: auto;*/
        /*    display: block;*/
        /*}*/

        td,
        th,
        tr,
        table {
            border-top: 0;
            border-collapse: collapse;
        }

        td.quantity,
        th.quantity {
            width: 210px;
            word-break: break-all;
        }

        td.price,
        th.price {
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 100%;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        table {
            width: 100%;
            align-content: center;
        }

        .table-content {
            width: 80%;
            margin: auto;
        }

    </style>
</head>
<body>
<div class="ticket">
    <div style="margin: auto; width: 300px;">
        <img src="{{asset('public/images/logoEon.png')}}" alt="logo">
    </div>
    {{--    <h2 class="centered" style="font-size: 30px"><b>{{$dataInvoice['patient_name']}}</b></h2>--}}
    <h2 class="centered" style="font-size: 26px"><b>Receipt Voucher</b></h2>
    <div class="table-content">
        <table>
            <tbody>
            <tr>
                <td class="quantity"><b>Receipt</b></td>
                <td class="description " colspan="2">{{$dataInvoice['id']}}</td>
            </tr>
            <tr>
                <td class="quantity"><b>Receipt Date & Time</b></td>
                <td class="description" colspan="2">{{$dataInvoice['date']}}</td>
            </tr>
            <tr>
                <td class="quantity"><b>Appointment</b></td>
                <td class="description" colspan="2">{{$dataInvoice['date']}}</td>
            </tr>
            <tr>
                <td class="quantity"><b>Patient Name</b></td>
                <td class="description" colspan="2">{{$dataInvoice['patient_name']}}</td>
            </tr>
            <tr>
                <td class="quantity"><b>Gender</b></td>
                <td class="description" colspan="2">{{$dataInvoice['patient_gender']}}</td>
            </tr>
            <tr>
                <td class="quantity"><b>Age</b></td>
                <td class="description" colspan="2">{{$dataInvoice['patient_age']}}</td>
            </tr>
            <tr>
                <td class="quantity"><b>Sr#</b></td>
                <td class="description"><b>Particulars</b></td>
                <td class="price" style="text-align: right"><b>Amount PRS</b></td>
            </tr>
            <tr>
                <td class="quantity">1</td>
                <td class="description">Consultation Fee</td>
                <td class="price" style="text-align:right ">{{$dataInvoice['amount']}}</td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr style="border: solid 1px #ccc;">
                    <br>
                </td>
            </tr>
            <tr>
                <td class="quantity"></td>
                <td class="description"><b>Total</b></td>
                <td class="price" style="text-align: right">{{$dataInvoice['amount']}}</td>
            </tr>
            <tr>
                <td class="quantity"><b>Total Receivable</b></td>
                <td class="description" colspan="2">{{$dataInvoice['amount']}}</td>
                <td class="price"></td>
            </tr>
            <tr>
                <td class="quantity"><b>Amount Received</b></td>
                <td class="description" colspan="2">{{$dataInvoice['amount']}}</td>
            </tr>
            <tr>
                <td class="quantity"><b>Change</b></td>
                <td class="description" colspan="2">0</td>
            </tr>
            <tr>
                <td class="quantity"><b>Mode</b></td>
                <td class="description" colspan="2">{{$dataInvoice['mod']}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <p class="centered">Powered By EON Health</p>
</div>
</body>
</html>
