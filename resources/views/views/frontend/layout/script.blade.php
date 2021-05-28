<!-- COMMON SCRIPTS -->
<script src="{{asset('public/frontend/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('public/frontend/js/common_scripts.min.js')}}"></script>
<script src="{{asset('public/frontend/js/functions.js')}}"></script>

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

@yield('script')