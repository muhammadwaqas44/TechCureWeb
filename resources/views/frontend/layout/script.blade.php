<!-- COMMON SCRIPTS -->
<script src="{{asset('public/frontend/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('public/frontend/js/common_scripts.min.js')}}"></script>
<script src="{{asset('public/frontend/js/functions.js')}}"></script>
<script src="{{asset('public/admin/dist/js/toastr.min.js')}}"></script>
<script src="{{ asset('public/admin/dist/js/toastr.js')}}"></script>
<!-- SPECIFIC SCRIPTS -->
<script src="{{asset('public/frontend/js/video_header.js')}}"></script>
<script>
    'use strict';
    HeaderVideo.init({
        container: $('.header-video'),
        header: $('.header-video--media'),
        videoTrigger: $("#video-trigger"),
        autoPlayVideo: true
    });

    
</script>
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

@yield('script')