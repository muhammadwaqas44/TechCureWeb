@extends('layouts.practitioner')

@section('extra-css')
@endsection

@section('main-content')
    <!-- Counts Section -->

    <div class="content-wrapper">
      <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                        <h1 class="m-0 text-dark mt-4">Dashboard</h1>
                  </div>
               </div>
            </div>
      </div>

      <section class="content">
         <div class="container-fluid">
             <div class="row mt-4">

                 <div class="col-lg-3 col-6">
                     <div class="small-box bg-info">
                     <div class="inner">
                        <h3 class="ml-2" style="font-size: 40px">{{ $todayAppointmentsCount }}</h3>
                         <p class="ml-2 mt-2">Total Appointments / Today</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                    <a href="{{ route('practitionerAppointmentList') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                 </div>

                 <div class="col-lg-3 col-6">
                     <div class="small-box bg-success">
                     <div class="inner">
                         <h3 class="ml-2" style="font-size: 40px">{{ $todayOpenAppointmentsCount }}</h3>
                         <p class="ml-2 mt-2">Open Appointments / Today</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                     <a href="{{ route('practitionerAppointmentList') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                 </div>

                 <div class="col-lg-3 col-6">
                     <div class="small-box bg-warning">
                     <div class="inner">
                        <h3 class="ml-2" style="font-size: 40px">{{ $todayClosedAppointmentsCount }}</h3>
                         <p class="ml-2 mt-2">Closed Appointments / Today</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                     <a href="{{ route('practitionerAppointmentList') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                 </div>

                 <div class="col-lg-3 col-6">
                     <div class="small-box bg-danger">
                     <div class="inner">
                     <h3 class="ml-2" style="font-size: 40px" style="font-size: 40px">{{ $assistantsCount }}</h3>
                         <p class="ml-2 mt-2">Total Assistants</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-stats-bars"></i>
                     </div>
                     <a href="{{ route('practitionerAssistantList') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                 </div>

                 <div class="col-lg-3 col-6 mt-2">
                     <div class="small-box bg-success">
                     <div class="inner">
                         <h3 class="ml-2" style="font-size: 40px">{{ $patientsCount }}</h3>
                         <p class="ml-2 mt-2">Total Patients</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-stats-bars"></i>
                     </div>
                     <a href="{{ route('practitionerPatientList') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                 </div>

                 <div class="col-lg-3 col-6 mt-2">
                     <div class="small-box bg-warning">
                     <div class="inner">
                     <h3 class="ml-2" style="font-size: 40px">{{ $prescriptionTemplatesCount }}</h3>
                         <p class="ml-2 mt-2">Prescriptions Templates</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                     <a href="{{ route('practitionerPrescriptionTemplateList') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                 </div>

                 <div class="col-lg-3 col-6 mt-2">
                     <div class="small-box bg-danger">
                     <div class="inner">
                         <h3 class="ml-2" style="font-size: 40px">{{ $practitionerLabTestsCount }}</h3>
                         <p class="ml-2 mt-2">Favourite Lab Tests</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                     <a href="{{ route('practitionerLabTestList') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                 </div>

             </div>
         </div>
      </section>
    <!-- Header Section-->
   </div>
@endsection

@section('scripts')
@if(Session::has('success-message'))
<script>
toastr.success('{{ Session::get('success-message') }}')
</script>
@endif

@if(Session::has('error-message'))
<script>
toastr.error('{{ Session::get('error-message') }}')
</script>
@endif
@endsection