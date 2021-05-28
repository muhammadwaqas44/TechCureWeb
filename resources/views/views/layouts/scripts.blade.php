{{-- Scripts --}}
<script src="{{asset('public/admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>$.widget.bridge('uibutton', $.ui.button)</script>



<script src="//js.pusher.com/3.1/pusher.min.js"></script>

<script src="{{asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('public/admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<script src="{{asset('public/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

<script src="{{asset('public/admin/dist/js/adminlte.js')}}"></script>
<script src="{{asset('public/admin/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('public/admin/dist/js/demo.js')}}"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script src="{{asset('public/admin/dist/js/toastr.min.js')}}"></script>
<script src="{{asset('public/admin/dist/js/toastr.js')}}"></script>

@if(Session::has('success-message'))
    <script>
        toastr.success('{{  Session::get('success-message') }}')
    </script>
@endif

@if (Session::has('status'))
    <script>
        toastr.success('{{  Session::get('status') }}')
    </script>
@endif

@if(Session::has('error-message'))
    <script>
        toastr.error('{{  Session::get('error-message') }}')
    </script>
@endif

<script>
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
</script>
