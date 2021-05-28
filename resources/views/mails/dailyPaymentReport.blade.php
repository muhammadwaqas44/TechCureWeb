
<div style="text-align: center; width: 100%;">
        <h1><a href="{{url('/')}}" title="Find Doctor"><img src="{{url('/').'/public/images/favicon.ico'}}">
            </a></h1>
</div>
@if($payments != null)
    <table style="text-align: center; border-collapse: collapse;
  width: 100%; border: 1px solid #ddd; padding: 15px;">
        <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 15px; background-color:#43425d; color: white" colspan="9">Today Payment Report</th>
        </tr>
        <tr>
            <th style="border: 1px solid #ddd; padding: 15px;"> Sr# </th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Patient </th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Date </th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Type </th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Time Slot </th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Fee </th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Payment Method </th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Payment Status </th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Appointment Status </th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr class="odd gradeX">
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$payment['appointment']['id']}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$payment['patient']['name']}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{date('D d M Y', strtotime($payment['date']))}}</td>
                @if(isset($payment['appointment']['type']))
                    @if($payment['appointment']['type'] == 0)
                        <td style="border: 1px solid #ddd; padding: 15px;"> Physical</td>
                    @elseif($payment['appointment']['type'] == 1)
                        <td style="border: 1px solid #ddd; padding: 15px;"> Online</td>
                    @else
                        <td style="border: 1px solid #ddd; padding: 15px;"></td>
                    @endif
                @endif
                @if(isset($payment['appointment']['time_slot']))
                    <td style="border: 1px solid #ddd; padding: 15px;"> {{$payment['appointment']['time_slot']}} </td>
                @else
                    <td style="border: 1px solid #ddd; padding: 15px;"></td>
                @endif
                <td style="border: 1px solid #ddd; padding: 15px;">{{$payment['amount']}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$payment['payment_method']}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{ $payment['payment_status']}}</td>
                @if(isset($payment['appointment']['status']))
                    @if($payment['appointment']['status'] == 0)
                        <td style="border: 1px solid #ddd; padding: 15px;"> Pending</td>
                    @elseif($payment['appointment']['status'] == 1)
                        <td style="border: 1px solid #ddd; padding: 15px;"> Under Process</td>
                    @elseif($payment['appointment']['status'] == 2)
                        <td style="border: 1px solid #ddd; padding: 15px;"> Accepted</td>
                    @elseif($payment['appointment']['status'] == 3)
                        <td style="border: 1px solid #ddd; padding: 15px;"> Rejected</td>
                    @elseif($payment['appointment']['status'] == 4)
                        <td style="border: 1px solid #ddd; padding: 15px;"> Check In</td>
                    @elseif($payment['appointment']['status'] == 5)
                        <td style="border: 1px solid #ddd; padding: 15px;"> Completed</td>
                    @endif
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div style="text-align: center; width: 100%;">
        <h1 style="color: red">No Entry Found</h1>
    </div>
@endif
