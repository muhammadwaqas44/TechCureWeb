@extends('layouts.practitioner')

@section('extra-css')
@endsection

@section('main-content')

    <section class="section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-7">
                <div class="row">
                <div class="col-sm-8 col-lg-8">
                    <div class="row">
                        <div class="col-sm-5 col-lg-5 pr-0 remove-pr">
                            <div class=" patient-pic">
                            <img src="{{ asset('public/images/patient-pic.png') }}">
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-7 light-grey pt-2 pb-1 margin-20-mobile">
                            <div class="clearfix">
                            <h4 class="SourceSansProBold blue-color float-left">John Doe Khakwani</h4>
                            <a class="fa fa-pencil float-right pencil-color" href="#"></a>
                            </div>
                            <ul class="pateint-infomation">
                            <li><b>MR #:</b> 1234567890</li>
                            <li><b>Gender:</b> Male</li>
                            <li><b>Age:</b> 27y/2m/2d</li>
                            <li><b>Mob:</b> 03215001777</li>
                            <li>Lahore Pkistan</li>
                            </ul>
                            <div class="text-right two-flags">
                            <img src="{{ asset('public/images/blank-box.png') }}">
                            <img src="{{ asset('public/images/red-flag.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 mobile-m-top">
                    <h6 class="SourceSansProBold blue-color horizental-line"><span>Selected Visit</span></h6>
                    <div class="selected-visit clearfix">
                        <div class="clearfix">
                            <div class="float-left">
                            <h6>Visit # 10</h6>
                            <h6>Paid</h6>
                            </div>
                            <div class="float-right">
                            <h6>26 June, 2020</h6>
                            <h6>Original</h6>
                            </div>
                        </div>
                        <h1>Duration- 10:20</h1>
                    </div>
                    <div class="start-video">
                        <a href="#"><img src="{{ asset('public/images/start-video.png') }}"></a>
                    </div>
                </div>
                </div>
                <div class="sub-btns">
                <!-- <a href="#">Allergies</a> -->
                <!-- <a href="#">Vaccines</a> -->
                <!-- <a href="#">R.Drugs</a> -->
                <a href="#" data-toggle="modal" data-target="#modalPE">P.E.</a>
                <a href="#" data-toggle="modal" data-target="#modalhistory">History</a>
                <!--  <a href="#">Form</a>
                <a href="#">Form</a>
                <a href="#">Form</a> -->
                <a href="#" data-toggle="modal" data-target="#modalPMHx">PMHx</a>
                <a href="#" data-toggle="modal" data-target="#modalPSH">PSHx</a>
                <a href="#" data-toggle="modal" data-target="#modalFMHx">FMHx</a>
                <a href="#" data-toggle="modal" data-target="#modalsmoking">Smoking</a>
                <a href="#" data-toggle="modal" data-target="#modalros">ROS</a>
                <a href="#" data-toggle="modal" data-target="#modaladr">ADR</a>
                <a href="#" class="rx" data-toggle="modal" data-target="#modalrx">Rx</a>
                <!-- <a href="#">C.MEDS</a> -->
                </div>
                <div class="clearfix vitals-row">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Vitals</span></h6>
                <div class="vital-sub-row text-center clearfix">
                    <a href="#" class="float-left rep-vital">Repeat Vitals</a>
                    <a href="javascript:void(0);" id="vital_lbs" class="btn-space">LBs</a>
                    <a href="javascript:void(0);" id="vital_kgs" class="btn-space" style="display:none;">KGs</a>
                    <a href="javascript:void(0);" id="vital_cms" class="btn-space">CMs</a>
                    <a href="javascript:void(0);" id="vital_ft" class="btn-space" style="display:none;">Ft</a>
                </div>
                <div class="table-responsive vitals-table">
                    <table class="table new-table">
                        <thead>
                            <tr>
                            <th>BP (Sys- Dias)</th>
                            <th>Pulse</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>BMI</th>
                            <th>BSF</th>
                            <th>BSR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><input type="text" name="" value="120" class="red-input"><input type="text" name="" value="90" class="red-input"></td>
                            <td><input type="text" name="" value="90" class="grey-input expand-width m-0"></td>
                            <td><input type="text" name="weight" id="weight" value="" class="grey-input m-0 expand-width"></td>
                            <td><input type="text" name="height_ft" id="height_ft" value="" class="grey-input"><input type="text" name="height_in" id="height_in" value="" class="grey-input"></td>
                            <td><input type="text" name="" value="29.1" class="grey-input m-0 expand-width"></td>
                            <td><input type="text" name="" value="100" class="grey-input m-0 expand-width"></td>
                            <td><input type="text" name="" value="120" class="grey-input expand-width m-0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive vitals-table-two">
                    <table class="table new-table">
                        <thead>
                            <tr>
                            <th>SPO2 %</th>
                            <th>ETC</th>
                            <th>ETC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td width="90px"><input type="text" name="" value="94" class="grey-input expand-width m-0"></td>
                            <td width="70px" class="pl-0"><input type="text" name="" value="29.1" class="grey-input expand-width m-0"></td>
                            <td class="pl-0"><input type="text" name="" value="98" class="grey-input expand-width m-0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="clearfix pt-2 templates-row mobile-m-top">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Templates</span></h6>
                <form>
                    <input type="text" name="" placeholder="Search Templates">
                    <button type="submit">Labs Only</button>
                </form>
                <div class="templates-show">
                    <a href="#">Template 1</a>
                    <a href="#">Template 2</a>
                    <a href="#">Template 3</a>
                    <a href="#">Template 4</a>
                    <a href="#">Template 5</a>
                    <a href="#">Template 6</a>
                    <a href="#">Template 7</a>
                    <a href="#">Template 8</a>
                    <a href="#">Template 9</a>
                    <a href="#">Template 10</a>
                    <a href="#">Template 11</a>
                    <a href="#">Template 12</a>
                    <a href="#">Template 13</a>
                    <a href="#">Template 14</a>
                    <a href="#">Template 15</a>
                    <a href="#">Template 16</a>
                </div>
                </div>
                <div class="clearfix pt-2 templates-row mobile-m-top mt-2">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Prescription</span></h6>
                <div id="summernote"></div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-5 mobile-m-top">
                <div class="clearfix">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Previous Visits (200)</span></h6>
                <div class="table-responsive previous-visit">
                    <table class="table new-table">
                        <thead>
                            <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>26-11-2020</td>
                            <td class="yellow">Completed</td>
                            <td class="yellow">Revised-1</td>
                            <td><a href="#" class="view-btn">View</a> <a href="#" class="copy-btn">Copy</a><a href="#" class="revise-btn">Revise</a></td>
                            </tr>
                            <tr>
                            <td>26-11-2020</td>
                            <td class="yellow">Labs Only</td>
                            <td class="yellow"></td>
                            <td><a href="#" class="view-btn">View</a> <a href="#" class="copy-btn">Copy</a><a href="#" class="revise-btn">Revise</a></td>
                            </tr>
                            <tr>
                            <td>26-11-2020</td>
                            <td class="yellow">Completed</td>
                            <td class="yellow">Revised-1</td>
                            <td><a href="#" class="view-btn">View</a> <a href="#" class="copy-btn">Copy</a><a href="#" class="revise-btn">Revise</a></td>
                            </tr>
                            <tr>
                            <td>26-11-2020</td>
                            <td class="yellow">Completed</td>
                            <td class="yellow"></td>
                            <td><a href="#" class="view-btn">View</a> <a href="#" class="copy-btn">Copy</a><a href="#" class="revise-btn">Revise</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="clearfix vitals-row mt-2 pt-1 vitals-row2" style="display: none;">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Vitals2</span></h6>
                <div class="vital-sub-row text-center">
                    <a href="javascript:void(0);" id="vital_2_lbs" class="btn-space">LBs</a>
                    <a href="javascript:void(0);" id="vital_2_kgs" class="btn-space" style="display:none;">KGs</a>
                    <a href="javascript:void(0);" id="vital_2_cms" class="btn-space">CMs</a>
                    <a href="javascript:void(0);" id="vital_2_ft" class="btn-space" style="display:none;">Ft</a>
                </div>
                <div class="table-responsive vitals-table">
                    <table class="table new-table">
                        <thead>
                            <tr>
                            <th>BP (Sys- Dias)</th>
                            <th>Pulse</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>BMI</th>
                            <th>BSF</th>
                            <th>BSR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><input type="text" name="" value="120" class="red-input"><input type="text" name="" value="90" class="red-input"></td>
                            <td><input type="text" name="" value="90" class="grey-input expand-width m-0"></td>
                            <td><input type="text" name="weight_2" id="weight_2" value="" class="grey-input m-0 expand-width"></td>
                            <td><input type="text" name="height_2_ft" id="height_2_ft" value="" class="grey-input"><input type="text" name="height_2_in" id="height_2_in" value="" class="grey-input"></td>
                            <td><input type="text" name="" value="29.1" class="grey-input m-0 expand-width"></td>
                            <td><input type="text" name="" value="100" class="grey-input m-0 expand-width"></td>
                            <td><input type="text" name="" value="120" class="grey-input expand-width m-0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="table-responsive vitals-table-two">
                    <table class="table new-table">
                        <thead>
                            <tr>
                            <th>SPO2 %</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td width="90px"><input type="text" name="" value="94" class="grey-input expand-width m-0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="clearfix pt-2 mt-2 attachments">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Attachments (40)</span></h6>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#labs">Labs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#invoices">Invoices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#others">Others</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="labs" class="container tab-pane active">
                        <br>
                        <div class="owl-carousel owl-carousel-slider">
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                        </div>
                    </div>
                    <div id="invoices" class="container tab-pane fade">
                        <br>
                        <div class="owl-carousel owl-carousel-slider">
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                        </div>
                    </div>
                    <div id="others" class="container tab-pane fade">
                        <br>
                        <div class="owl-carousel owl-carousel-slider">
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                            <div class="item text-center">
                            <div class="lab-img">
                                <i class="fa fa-search"></i>
                            </div>
                            <p class="lab-rep m-0">Lab_Report .PDF</p>
                            <p class="rep-date m-0">26-11- 2020</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="clearfix pt-2 mt-2 doctor-notes">
                <h6 class="SourceSansProBold light-green horizental-line"><span>Doctor Notes (internal)</span></h6>
                <form>
                    <textarea></textarea>
                </form>
                </div>
                <div class="clearfix pt-2 mt-2 doctor-notes-printed">
                <h6 class="SourceSansProBold light-blue-print horizental-line"><span>Doctor Notes (Printed)</span></h6>
                <form>
                    <textarea></textarea>
                </form>
                </div>
            </div>
        </div>
        <div class="row medications-row">
            <div class="col-lg-12">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Medications</span></h6>
                <ul class="p-0">
                <li><a href="#" class="generic-name">Generic Name</a><input type="text" name="" placeholder="Type Medicine Trade Name" class="medicine-trade-name"></li>
                <li class="dosage">
                    <h6>Dosage</h6>
                    <input type="text" name="" placeholder="Morning">
                    <input type="text" name="" placeholder="Afternoon">
                    <input type="text" name="" placeholder="Evening">
                    <input type="text" name="" placeholder="Night">
                </li>
                <li><a href="#" class="as-required">As Required</a></li>
                <li class="meal">
                    <h6>Meal</h6>
                    <input type="text" name="" placeholder="Minutes">
                    <a href="#" class="as-use">Before</a>
                    <a href="#" class="as-use">After</a>
                    <a href="#" class="as-use">With</a>
                </li>
                <li><span class="border-sep"></span></li>
                <li>
                    <a href="#" class="as-use">Breakfast</a>
                    <a href="#" class="as-use">Lunch</a>
                    <a href="#" class="as-use">Dinner</a>
                </li>
                <li class="intake">
                    <h6 class="mb-2">Intake</h6>
                    <a href="#" class="as-use">Oral</a>
                    <a href="#" class="as-use">Local</a>
                    <a href="#" class="as-use">IV</a>
                    <a href="#" class="as-use">IM</a>
                    <a href="#" class="as-use">Units</a>
                    <a href="#" class="as-use">Nasal</a>
                    <a href="#" class="as-use">Eye</a>
                    <a href="#" class="as-use">Ear</a>
                    <a href="#" class="as-use">Vaginal</a>
                    <a href="#" class="as-use">Rectal</a>
                </li>
                <li class="duration">
                    <h6>Duration</h6>
                    <div style="height: 10px;"></div>
                    <input type="text" name="" placeholder="Day/Weeks">
                </li>
                <li class="count-days">
                    <a href="#" class="as-use">Days</a>
                    <a href="#" class="as-use">Weeks</a>
                    <a href="#" class="as-use">Months</a>
                    <a href="#" class="as-use">Continue</a>
                </li>
                <li class="treating-condition">
                    <h6>Treating Condition</h6>
                    <div style="height: 10px;"></div>
                    <input type="text" name="" placeholder="Search Disease Tags / Conditions">
                </li>
                </ul>
                <div class="special-dosage">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Special Dosage</span></h6>
                <div class="row">
                    <div class="col-sm-4 col-lg-3">
                        <div class="number-system">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">7</a>
                            <a href="#">8</a>
                            <a href="#">9</a>
                            <a href="#">0</a>
                            <a href="#">AM</a>
                            <a href="#">PM</a>
                            <a href="#">Hrs</a>
                            <a href="#">Days</a>
                            <a href="#">Weeks</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-8 p-0 m-pading-15">
                        <textarea placeholder="Special Instructions"></textarea>
                    </div>
                    <div class="col-sm-2 col-lg-1 pr-0">
                        <a href="#" class="add-dosage">Add Dosage</a>
                    </div>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table new-table dosage-tabel">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Dosage</th>
                            <th>Special Instructions</th>
                            <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>1</td>
                            <td>1 Tablet 8AM</td>
                            <td>Crush the table and mix it with water. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed</td>
                            <td class="text-center"><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <td>2</td>
                            <td>1 Tablet after 10 Days</td>
                            <td></td>
                            <td class="text-center"><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <td>3</td>
                            <td>1 Tablet after 4 Weeks</td>
                            <td></td>
                            <td class="text-center"><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 text-right pt-3 pb-3 pr-0">
                    <a href="#" class="add-prescription">Add to Prescription</a>
                </div>
                <div class="table-responsive prescription-tabel">
                    <table class="table new-table">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Medicine Name</th>
                            <th class="text-center">Dosage</th>
                            <th class="text-center">Intake</th>
                            <th>Duration</th>
                            <th>Diet</th>
                            <th>Condition</th>
                            <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>1</td>
                            <td>Risek 40mg Cap</td>
                            <td class="text-center p-3"><img src="{{ asset('public/images/dosage-icon.png') }}"></td>
                            <td class="text-center p-3">Oral</td>
                            <td>2 Weeks</td>
                            <td>120 Minutes Before Meals</td>
                            <td>Reflux</td>
                            <td class="text-center p-3"><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <td>2</td>
                            <td>Carveda 6.25mg Tab</td>
                            <td class="text-center p-3">1 + 1+1+1</td>
                            <td class="text-center p-3">Oral</td>
                            <td>2 Weeks</td>
                            <td>After Meals</td>
                            <td>Throat Infection</td>
                            <td class="text-center p-3"><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <td>3</td>
                            <td>Risek 40mg Cap</td>
                            <td class="text-center p-3">1 + 1+1+1</td>
                            <td class="text-center p-3">Oral</td>
                            <td>2 Weeks</td>
                            <td>120 Minutes Before Meals</td>
                            <td>Reflux</td>
                            <td class="text-center p-3"><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <td>4</td>
                            <td>Carveda 6.25mg Tab</td>
                            <td class="text-center p-3">1 + 1+1+1</td>
                            <td class="text-center p-3">Oral</td>
                            <td>2 Weeks</td>
                            <td>After Meals</td>
                            <td>Throat Infection</td>
                            <td class="text-center p-3"><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <tr>
                            <td>5</td>
                            <td>Risek 40mg Cap</td>
                            <td class="text-center p-3">1 + 1+1+1</td>
                            <td class="text-center p-3">Oral</td>
                            <td>2 Weeks</td>
                            <td>120 Minutes Before Meals</td>
                            <td>Reflux</td>
                            <td class="text-center p-3"><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <td>6</td>
                            <td>Carveda 6.25mg Tab</td>
                            <td class="text-center p-3">1 + 1+1+1</td>
                            <td class="text-center p-3">Oral</td>
                            <td>2 Weeks</td>
                            <td>After Meals</td>
                            <td>Throat Infection</td>
                            <td class="text-center p-3"><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <td>7</td>
                            <td>Risek 40mg Cap</td>
                            <td class="text-center p-3">1 + 1+1+1</td>
                            <td class="text-center p-3">Oral</td>
                            <td>2 Weeks</td>
                            <td>120 Minutes Before Meals</td>
                            <td>Reflux</td>
                            <td class="text-center p-3"><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                            <tr>
                            <td>8</td>
                            <td>Carveda 6.25mg Tab</td>
                            <td class="text-center p-3">1 + 1+1+1</td>
                            <td class="text-center p-3">Oral</td>
                            <td>2 Weeks</td>
                            <td>After Meals</td>
                            <td>Throat Infection</td>
                            <td class="text-center p-3"><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <div class="clearfix pt-2 templates-row fav-lab">
            <h6 class="SourceSansProBold blue-color horizental-line"><span>Favorite Labs / Investigations</span></h6>
            <form>
                <input type="text" name="" placeholder="Search Labs">
                <button type="submit">OTE</button>
            </form>
            <div class="templates-show">
                <a href="#">Lab1</a>
                <a href="#">Lab ume</a>
                <a href="#">Lab we</a>
                <a href="#">Labs kl</a>
                <a href="#">Labs gh</a>
                <a href="#">Lab nj</a>
                <a href="#">Lab op</a>
                <a href="#">Template 2</a>
                <a href="#">Template 3</a>
                <a href="#">Template 1</a>
                <a href="#">Template 2</a>
                <a href="#">Template 3</a>
            </div>
            <div class="table-responsive prescription-tabel mt-4">
                <table class="table new-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Diagnostic Name</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Fasting</th>
                        <th>Instructions</th>
                        <th>Recommended Lab</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td class="p-2">CVP TIP for BACTERIAL C/S (Aerobic) e Gram Stain</td>
                        <td class="text-center p-2">Imaging</td>
                        <td class="text-center p-2">Yes</td>
                        <td class="p-2">None</td>
                        <td class="p-2">Shaukat Khanum Laboratory - Jail Road Branch</td>
                        <td class="text-center p-2"><a href="#"><img src="{{ asset('public/images/dosage-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="p-2">CVP TIP for BACTERIAL C/S (Aerobic) e Gram Stain</td>
                        <td class="text-center p-2">Imaging</td>
                        <td class="text-center p-2">No</td>
                        <td class="p-2">The sample collection for this test must be done at 8AM exactly on the 11th day of starting the XXX-Tab.</td>
                        <td>Any</td>
                        <td class="text-center p-2"><a href="#"><img src="{{ asset('public/images/dosage-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/edit-icon.png') }}" class="mr-2"></a><a href="#"><img src="{{ asset('public/images/del-icon.png') }}"></a></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix pt-2 suger-chart mt-4">
            <h6 class="SourceSansProBold blue-color horizental-line"><span>Sugar Chart</span></h6>
            <div class="table-responsive mt-4">
                <table class="table new-table">
                <thead>
                    <tr>
                        <th class="light-font">Monitoring Time</th>
                        <th>Sunday</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Before breakfast</td>
                        <td class="fill-bg"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2 Hours after breakfast</td>
                        <td></td>
                        <td class="fill-bg"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Before lunch</td>
                        <td></td>
                        <td></td>
                        <td class="fill-bg"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2 Hours after lunch</td>
                        <td></td>
                        <td></td>
                        <td class="fill-bg"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Before dinner</td>
                        <td></td>
                        <td></td>
                        <td class="fill-bg"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2 Hours after dinner</td>
                        <td></td>
                        <td></td>
                        <td class="fill-bg"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>At bedtime</td>
                        <td></td>
                        <td></td>
                        <td class="fill-bg"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>At 3:00 AM</td>
                        <td></td>
                        <td></td>
                        <td class="fill-bg"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-7 col-lg-7">
                <div class="clearfix pt-2 templates-row  refer-to">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Refer to</span></h6>
                <form>
                    <input type="text" name="" placeholder="Search Doctor" class="w-100">
                </form>
                <div class="templates-show">
                    <a href="#">Doctor 1</a>
                    <a href="#">Doctor 2</a>
                    <a href="#">Doctor 3</a>
                    <a href="#">Doctor 4</a>
                    <a href="#">Doctor 5</a>
                    <a href="#">Doctor 6</a>
                    <a href="#">Doctor 7</a>
                    <a href="#">Doctor 8</a>
                    <a href="#">Doctor 9</a>
                    <a href="#">Doctor 10</a>
                    <a href="#">Doctor 11</a>
                    <a href="#">Doctor 12</a>
                    <a href="#">Doctor 13</a>
                    <a href="#">Doctor 14</a>
                    <a href="#">Doctor 15</a>
                    <a href="#">Doctor 16</a>
                    <a href="#">Doctor 17</a>
                    <a href="#">Doctor 18</a>
                    <a href="#">Doctor 19</a>
                    <a href="#">Doctor 20</a>
                    <a href="#">Doctor 21</a>
                    <a href="#">Doctor 22</a>
                    <a href="#">Doctor 23</a>
                    <a href="#">Doctor 24</a>
                </div>
                </div>
            </div>
            <div class="col-sm-5 col-lg-5 mobile-m-top">
                <div class="clearfix pt-2 next-visit">
                <h6 class="SourceSansProBold blue-color horizental-line"><span>Next Visit</span></h6>
                <ul class="next-visit-no mt-3 p-0">
                    <li><input type="text" name=""></li>
                    <li><a href="#">Day(s)</a></li>
                    <li><a href="#">Week(s)</a></li>
                </ul>
                <div class="calender-btns">
                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                        <input type="text" class="datetimepicker-input" data-target="#datetimepicker4" placeholder="08/11/2020">
                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                            <div class="input-group-text around-border"><i class="fa fa-angle-down"></i></div>
                        </div>
                    </div>
                </div>
                <div class="save-tempaltes">
                </div>
                <div align="right">
                    <a href="#" class="send-pateint-btn">Save & Send to Patient</a>
                    <a href="#" class="save-temp-btn">Save as Template</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    </section>
   
   <div id="modalPMHx" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
               <div class="modal-header pd-y-20 pd-x-25">
                  <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Past Medical History</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body pd-25">
                  <form>
                  <div class="total-chq-c">
                     <div class="row">
                     <div class="col-sm-6 col-lg-6">
                        <div class="input-group mb-2">
                           <label>Disease:</label>
                           <div style="clear: both;"></div>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                        <div class="input-group mb-2">
                        <label>Year:</label>
                        <input type="text" name="" class="form-control" placeholder="No. of Years"> <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span> <input type="text" class="form-control" name="" placeholder="YYYY">
                     </div>
                     </div>
                     <div class="col-sm-6 col-lg-6">
                        <div class="input-group">
                           <label>Remarks:</label>
                           <textarea rows="4" class="form-control"></textarea>
                        </div>
                     </div>
                    <div class="col-lg-12 mt-3 text-right">
                    <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">Remove</button>
                 </div>
                  </div>
               </div>
                  </form>
                  <div align="left" class="mt-3 clearfixss">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button">+ Add More</button>
                 </div>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

   <div id="modalPSH" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
               <div class="modal-header pd-y-20 pd-x-25">
                  <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">PAST SURGICAL HISTORY</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body pd-25">
                  <form>
                  <div class="total-chq-c-ipsh">
                     <div class="row">
                     <div class="col-sm-6 col-lg-6">
                        <div class="input-group mb-2">
                           <label>Surgery:</label>
                           <div style="clear: both;"></div>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                        <div class="input-group mb-2">
                        <label>Year:</label>
                        <input type="text" name="" class="form-control" placeholder="No. of Years"> <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span> <input type="text" class="form-control" name="" placeholder="YYYY">
                     </div>
                     </div>
                     <div class="col-sm-6 col-lg-6">
                        <div class="input-group">
                           <label>Remarks:</label>
                           <textarea rows="4" class="form-control"></textarea>
                        </div>
                     </div>
                    <div class="col-lg-12 mt-3 text-right">
                    <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">Remove</button>
                 </div>
                  </div>
               </div>
                  </form>
                  <div align="left" class="mt-3 clearfixss">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_ipsh">+ Add More</button>
                 </div>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

   <div id="modalFMHx" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
               <div class="modal-header pd-y-20 pd-x-25">
                  <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">FAMILY MEDICAL HISTORY</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body pd-25">
                  <form>
                  <div class="total-chq-c-fmhx">
                     <div class="row">
                     <div class="col-sm-6 col-lg-6">
                        <div class="row">
                        <div class="mb-2 col-sm-6 col-lg-6 d-blcok">
                           <label>Relation:</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                        <div class="mb-2 col-sm-6 col-lg-6">
                           <label>Disease:</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                        <div class="input-group mb-2">
                        <label>Year:</label>
                        <input type="text" name="" class="form-control" placeholder="No. of Years"> <span class="pl-3 pr-3 pt-2" style="font-size: .9rem;">OR</span> <input type="text" class="form-control" name="" placeholder="YYYY">
                     </div>
                     <div class="input-grou mt-2">
                        <label>Status:<br>
                        <input type="checkbox" name="" class="float-left mr-2 mt-1"> Deceased
                        </label>
                     </div>
                     </div>
                     <div class="col-sm-6 col-lg-6">
                        <div class="input-group">
                           <label>Remarks:</label>
                           <textarea rows="4" class="form-control"></textarea>
                        </div>
                     </div>
                    <div class="col-lg-12 mt-3 text-right">
                    <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">Remove</button>
                 </div>
                  </div>
               </div>
                  </form>
                  <div align="left" class="mt-3 clearfixss">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_fmhx">+ Add More</button>
                 </div>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

   <div id="modalPE" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
               <div class="modal-header pd-y-20 pd-x-25">
                  <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">PHYSICAL EXAMINATION</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body pd-25">
                  <form>
                  <div class="total-chq-c-pe">
                     <div class="row">
                     <div class="col-sm-6 col-lg-6">
                        <div class="mb-2">
                           <label>Patient:</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-6">
                        <div class="input-group">
                           <label>Remarks:</label>
                           <textarea rows="4" class="form-control"></textarea>
                        </div>
                     </div>
                    <div class="col-lg-12 mt-3 text-right">
                    <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">Remove</button>
                 </div>
                  </div>
               </div>
                  </form>
                  <div align="left" class="mt-3 clearfixss">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_pe">+ Add More</button>
                 </div>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

   <div id="modalhistory" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
               <div class="modal-header pd-y-20 pd-x-25">
                  <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">HISTORY</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body pd-25">
                  <form>
                     <div class="total-chq-c-history">
                        <div class="row">
                        <div class="col-sm-12 col-lg-12">
                           <div id="summernotet"></div>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

   <div id="modalsmoking" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
               <div class="modal-header pd-y-20 pd-x-25">
                  <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">SMOKING HISTORY</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body pd-25">
                  <form>
                     <div class="total-chq-c-history">
                        <div class="row">
                        <div class="col-sm-12 col-lg-12">
                           <form>
                              <label>
                                 <input type="checkbox" name="" class="first-level-smoke">
                                 Did you ever smoke?
                              </label>
                              <div style="clear: both;"></div>
                              <div class="even-smoke pl-4">
                                 <label><input type="radio" name="smoke" class="mr-2 show-still-smoke">Do you still smoke?</label>
                                 <label><input type="radio" name="smoke" class="mr-2 remove-still-smoke">Non-Smoker</label>
                                 <div style="clear: both;"></div>
                                 <div class="still-smoke mb-3">
                                    <div class="row">
                                       <div class="col-sm-3 col-lg-3">
                                          Years*   
                                          <input type="number" name="" class="form-control">
                                       </div>
                                       <div class="col-sm-3 col-lg-3">
                                          Cig/Day *
                                          <input type="text" name="" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <label>
                                 <input type="checkbox" name="" class="show-ever-drink">
                                 Did you ever drink?
                              </label>
                              <div class="ever-drink pl-4 mb-3">
                                 <label><input type="checkbox" name="" class="mr-2">Do you still drink?</label>
                                 <textarea rows="2" class="form-control" placeholder="Drink remarks"></textarea>
                              </div>
                              <label>
                                 <input type="checkbox" name="" class="show-ever-drugs">
                                 Did you ever use drugs?
                              </label>
                              <div class="ever-drugs pl-4">
                                 <label><input type="checkbox" name="" class="mr-2">Do you still use drugs?</label>
                                 <div class="row">
                                    <div class="col-sm-6 col-lg-6 mb-3">
                                       <textarea rows="2" class="form-control" placeholder="What drugs do you use?"></textarea>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                      <textarea rows="2" class="form-control" placeholder="How do you use the drugs?"></textarea>
                                   </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

   <div id="modalros" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
               <div class="modal-header pd-y-20 pd-x-25">
                  <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">REVIEW ON SYSTEM</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body pd-25">
                  <form>
                     <div class="total-chq-c-history">
                        <div class="row">
                        <div class="col-sm-12 col-lg-12 mb-3">
                           <textarea rows="3" class="form-control">He 1</textarea>
                        </div>
                        <div class="col-sm-12 col-lg-12 mb-3">
                           <textarea rows="3" class="form-control">He denies chest pain, shortness of breath, legs swelling, abdominal pain, nausea, vomiting, constipation, diarrhea, fever, chills, burning in urination, blood in urine, nighttime frequent urination, weight loss, weight gain, headaches or blurring of vision.</textarea>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                           <textarea rows="3" class="form-control">Rest of the review of systems is negative.</textarea>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

   <div id="modaladr" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ADR</h2>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
            <div class="modal-body pd-25">
               <form>
               <div class="total-chq-c-adr">
                  <div class="row">
                      <div class="col-sm-6 col-lg-6">
                        <div class="mb-2">
                           <label>Drug:</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-6">
                        <div class="mb-2">
                           <label>Reaction:</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                    <div class="col-lg-12 mt-3 text-right">
                    <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">Remove</button>
                 </div>
                  </div>
               </div>
                  </form>
                  <div align="left" class="mt-3 clearfixss">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_adr">+ Add More</button>
                 </div>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

    <div id="modalrx" class="modal fade popup-style" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h2 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">RX (MEDICINES)</h2>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
            <div class="modal-body pd-25">
               <form>
               <div class="total-chq-c-rx">
                  <div class="row">
                      <div class="col-sm-3 col-lg-3">
                        <div class="mb-2">
                           <label>Medicines</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-1 col-lg-1">
                        <div class="mb-2">
                           <label>Dose</label>
                           <select class="bg-transparent border w-100 form-control">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-1 col-lg-1">
                        <div class="mb-2">
                           <label>Unit</label>
                           <select class="bg-transparent border w-100 form-control">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-2 col-lg-2 pr-0">
                        <div class="mb-2">
                           <label>Frequency*</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-2 col-lg-2 pr-0">
                        <div class="mb-2">
                           <label>Duration *</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-2 col-lg-2 pr-0">
                        <div class="mb-2">
                           <label>Diagnosis Type *</label>
                           <select class="selectpicker bg-transparent border w-100" multiple data-live-search="true">
                             <option>Mustard</option>
                             <option>Ketchup</option>
                             <option>Relish</option>
                           </select>
                        </div>
                     </div>
                    <div class="col-lg-12 mt-3 text-right">
                    <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_field">Remove</button>
                 </div>
                  </div>
               </div>
                  </form>
                  <div align="left" class="mt-3 clearfixss">
                    <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button_rx">+ Add More</button>
                 </div>
               </div>
               <div class="modal-footer clearfix">
                   <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold">Save changes</button>
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>

@endsection

@section('scripts')
    <script src="{{asset('public/practitioner/js/patientVisit.js')}}"></script>
@endsection