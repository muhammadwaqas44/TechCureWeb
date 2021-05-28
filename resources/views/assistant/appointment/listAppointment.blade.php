@extends('layouts.practitioner')

@section('extra-css')
@endsection

@section('main-content')
    <!-- Counts Section -->
    <section class="dashboard-counts section-padding">
       <div class="container-fluid">
          <div class="row">
             <div class="col-sm-9 col-lg-9">
                <div class="clearfix">
                   <ul class="m-0 p-0 calender-btns">
                      <li>
                         <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" class="datetimepicker-input" data-target="#datetimepicker4" placeholder="08/11/2020" />
                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                               <div class="input-group-text around-border"><i class="fa fa-angle-down"></i></div>
                            </div>
                         </div>
                      </li>
                      <li><a href="">Completed</a></li>
                      <li><a href="">Paid</a></li>
                      <li><a href="">Wishlist</a></li>
                   </ul>
                </div>
                <div class="table-responsive mt-25">
                   <table class="table new-table">
                      <thead>
                         <tr>
                            <th>#</th>
                            <th></th>
                            <th>MR#</th>
                            <th>Name</th>
                            <th>Appointment</th>
                            <th>Action</th>
                            <th></th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                            <td>1</td>
                            <td class="yellow text-center pl-0">Paid</td>
                            <td>G-01234567890</td>
                            <td>John Doe Khakwani</td>
                            <td>1:30 pm</td>
                            <td><a href="{{ route('practitionerPatientVisit') }}" class="manage-btn">Manage</a></td>
                         </tr>
                         <tr>
                            <td>2</td>
                            <td class="yellow text-center pl-0">Completed</td>
                            <td>G-01234567890</td>
                            <td>John Doe Khakwani</td>
                            <td>1:30 pm</td>
                            <td><a href="{{ route('practitionerPatientVisit') }}" class="manage-btn">Manage</a> <a href="#" class="report-btn">Reports</a></td>
                         </tr>
                         <tr>
                            <td>3</td>
                            <td></td>
                            <td>G-01234567890</td>
                            <td>John Doe Khakwani</td>
                            <td>1:30 pm</td>
                            <td><a href="{{ route('practitionerPatientVisit') }}" class="manage-btn">Manage</a> <a href="#" class="report-btn">Reports</a></td>
                         </tr>
                         <tr>
                            <td>4</td>
                            <td></td>
                            <td>G-01234567890</td>
                            <td>John Doe Khakwani</td>
                            <td>1:30 pm</td>
                            <td><a href="{{ route('practitionerPatientVisit') }}" class="manage-btn">Manage</a> <a href="#" class="report-btn">Reports</a></td>
                         </tr>
                         <tr>
                            <td>5</td>
                            <td></td>
                            <td>G-01234567890</td>
                            <td>John Doe Khakwani</td>
                            <td>1:30 pm</td>
                            <td><a href="{{ route('practitionerPatientVisit') }}" class="manage-btn">Manage</a> <a href="#" class="report-btn">Reports</a></td>
                         </tr>
                         <tr>
                            <td>6</td>
                            <td></td>
                            <td>G-01234567890</td>
                            <td>John Doe Khakwani</td>
                            <td>1:30 pm</td>
                            <td><a href="{{ route('practitionerPatientVisit') }}" class="manage-btn">Manage</a> <a href="#" class="report-btn">Reports</a></td>
                         </tr>
                         <tr>
                            <td>7</td>
                            <td></td>
                            <td>G-01234567890</td>
                            <td>John Doe Khakwani</td>
                            <td>1:30 pm</td>
                            <td><a href="{{ route('practitionerPatientVisit') }}" class="manage-btn">Manage</a> <a href="#" class="report-btn">Reports</a></td>
                         </tr>
                      </tbody>
                   </table>
                </div>
             </div>
             <div class="col-sm-3 col-lg-3 border-left-col">
                <div class="total-case">
                   <small class="mb-17 d-inline-block grey">Total Appointments</small>
                   <div class="row">
                      <div class="col my-auto">
                         <h4 class="SourceSansProBold">246K</h4>
                         <small class="percentage-no"><img src="{{ asset('public/images/down-percent.png') }}" class="pr-1">13.8%</small>
                      </div>
                      <div class="col text-right mt-3">
                         <img src="{{ asset('public/images/total-case.png') }}">
                      </div>
                   </div>
                </div>
                <div class="total-case mt-0">
                   <small class="mb-17 d-inline-block grey">Completed Appointments</small>
                   <div class="row">
                      <div class="col my-auto">
                         <h4 class="SourceSansProBold">2453</h4>
                         <small class="percentage-no up-percent-color"><img src="{{ asset('public/images/up-percent.png') }}" class="pr-1">13.8%</small>
                      </div>
                      <div class="col text-right mt-3">
                         <img src="{{ asset('public/images/total-case.png') }}">
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- Header Section-->
 </div>
@endsection

@section('scripts')
@endsection