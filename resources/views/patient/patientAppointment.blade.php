<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Find easily a doctor and book online an appointment">
    <meta name="author" content="Ansonika">

    <title>EON Health</title>

    <link rel="shortcut icon" href="{{asset('public/images/favicon.ico')}}" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/css/agoracommon.css')}}">
    <style>
        .active-class {
            color: #e74e84 !important;
        }

        body {
            background: #fff;
            font-size: 14px;
            font-size: .875rem;
            line-height: 1.4;
            font-family: Poppins, Helvetica, sans-serif;
            color: #555;
        }

        footer,
        header {
            background-color: #fff
        }

        header {
            min-height: 55px;
            padding: 10px 0;
            border-bottom: 1px solid transparent
        }

        header.header_sticky {
            width: 100%;
            z-index: 999;
            position: relative;
            transition: all .3s ease-in-out
        }

        header.header_map,
        header.header_sticky.sticky {
            position: fixed;
            left: 0;
            border-bottom: 1px solid #ededed;
            z-index: 999;
            top: 0
        }

        header.header_map {
            width: 100%
        }

        header.static {
            border-bottom: 1px solid #ededed;
            z-index: 999;
            position: relative
        }

        ul#top_access {
            float: right;
            position: relative;
            top: 3px;
            margin: -1px 0 0
        }

        .header-video {
            position: relative;
            overflow: hidden;
            background: #000
        }

        #logo_home h1 a h2 {
            font-size: 14px;
            text-align: center;
            margin: 10px 0 0;
        }

        #logo_home h1 a img {
            margin: auto;
            display: block;
        }

        #logo_home h1 a img {
            width: 64px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #333;
        }

        #logo_home h1 a {
            width: 163px;
        }

        #logo_home h1 {
            margin: 0;
            padding: 0;
            line-height: 1;
        }

        a,
        a:focus,
        a:hover {
            text-decoration: none;
            outline: 0;
        }

    </style>
</head>
<script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.2.1.js"></script>

<body class="agora-theme">
<input type="hidden" name="appointmentId" id="appointmentId" value="{{$appointment->id}}">
<header class="sticky-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-6">
                <div id="logo_home">
                    <h1><a href="{{route('indexPage')}}" title="Findoctor"><img
                                src="{{asset('public/images/favicon.ico')}}">
                            <h2>EON Health - Video Calling</h2>
                        </a></h1>
                </div>
            </div>

        </div>
    </div>
    <!-- /container -->
</header>
<div class="container border">

    <div class="row">
        <div class="col-sm-6 col-lg-6 text-center">
            <h4 class="">{{$appointment->patient->name}}</h4>
        </div>
        <div class="col-sm-6 col-lg-6 text-center">
            <h4>{{$appointment->practitioner->name}}</h4>
        </div>

        <div class="w-100">
            {{-- <div class="row" style="margin: 0">
<div class="col s12">
<button class="btn btn-raised btn-primary waves-effect waves-light" id="join">JOIN</button>
<button class="btn btn-raised btn-primary waves-effect waves-light" id="leave">LEAVE</button>
<button class="btn btn-raised btn-primary waves-effect waves-light" id="publish">PUBLISH</button>
<button class="btn btn-raised btn-primary waves-effect waves-light"
id="unpublish">UNPUBLISH</button>
</div>
</div> --}}
            <div class="video-grid" id="video">
                <div class="video-view">
                    <div id="local_stream" class="video-placeholder"></div>
                    <div id="local_video_info" class="video-profile hide"></div>
                    <div id="video_autoplay_local" class="autoplay-fallback hide"></div>
                </div>
            </div>
        </div>

        <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('public/js/agoramaterialized.js')}}"></script>
        <script>
            function Toastify(options) {
                M.toast({
                    html: options.text,
                    classes: options.classes
                })
            }

            var Toast = {
                info: (msg) => {
                    Toastify({
                        text: msg,
                        classes: "info-toast"
                    })
                },
                notice: (msg) => {
                    Toastify({
                        text: msg,
                        classes: "notice-toast"
                    })
                },
                error: (msg) => {
                    Toastify({
                        text: msg,
                        classes: "error-toast"
                    })
                }
            }
            // rtc object
            var rtc = {
                client: null,
                joined: false,
                published: false,
                localStream: null,
                remoteStreams: [],
                params: {}
            };

            // Options for joining a channel
            var option = {
                appID: "{{$appointment->practitioner->agora_app_id}}",
                channel: "{{$appointment->practitioner->agora_app_channel}}",
                uid: null,
                token: "{{$appointment->practitioner->agora_app_token}}"
            }
            rtc.client = AgoraRTC.createClient({
                mode: "live",
                codec: "h264",
                areaCode: ['GLOBAL']
            });
            rtc.client.init(option.appID, function () {
                console.log("init success");
            }, (err) => {
                console.error(err);
            });

            rtc.client.setClientRole('audience');

            rtc.client.join(option.token ? option.token : null, option.channel, option.uid ? +option.uid : null,
                function (uid) {
                    console.log("join channel: " + option.channel + " success, uid: " + uid);
                    rtc.params.uid = uid;
                    rtc.joined = true
                },
                function (err) {
                    console.error("client join failed", err)
                })
            rtc.localStream = AgoraRTC.createStream({
                streamID: rtc.params.uid,
                audio: true,
                video: true,
                screen: false,
            });

            // Initialize the local stream
            rtc.localStream.init(function () {
                console.log("init local stream success");
                // play stream with html element id "local_stream"
                rtc.localStream.play("local_stream");
                setTimeout(() => {
                    stream();
                }, 2000);

            }, function (err) {
                console.error("init local stream failed ", err);
            });

            rtc.client.on("stream-added", function (evt) {

                var remoteStream = evt.stream;
                var id = remoteStream.getId();

                if (id !== rtc.params.uid) {
                    rtc.client.subscribe(remoteStream, function (err) {
                        console.log("stream subscribe failed", err);
                    })
                }
                console.log('stream-added remote-uid: ', id);
            });

            rtc.client.on("stream-subscribed", function (evt) {
                var remoteStream = evt.stream;
                var id = remoteStream.getId();
                // Add a view for the remote stream.
                addView(id);
                // Play the remote stream.
                remoteStream.play("remote_video_" + id);
                console.log('stream-subscribed remote-uid: ', id);

                if (rtc.localStream.streamId) {
                    rtc.localStream.play("local_stream");
                    setTimeout(() => {
                        stream();
                    }, 2000);
                }
            })

            rtc.client.on("stream-removed", function (evt) {
                debugger;
                var remoteStream = evt.stream;
                var id = remoteStream.getId();
                // Stop playing the remote stream.
                remoteStream.stop("remote_video_" + id);
                // Remove the view of the remote stream.
                removeView(id);
                console.log("stream-removed remote-uid: ", id);
            });

            rtc.client.on("peer-leave", function (evt) {
                var id = evt.uid;
                console.log("id", evt)
                let streams = rtc.remoteStreams.filter(e => id !== e.getId())
                let peerStream = rtc.remoteStreams.find(e => id === e.getId())
                if (peerStream && peerStream.isPlaying()) {
                    peerStream.stop()
                }
                rtc.remoteStreams = streams
                if (id !== rtc.params.uid) {
                    removeView(id)
                }

                // removeView(rtc.localStream.streamId)
                rtc.localStream.stop("local_stream");
                // Remove the view of the remote stream.
                // removeLocalView();
                changeBit();
                Toast.notice("peer leave")
                console.log("peer-leave", id)
            })

            function stream() {
                rtc.client.publish(rtc.localStream, function (err) {
                    console.log("publish failed");
                    console.error(err);
                });

            }

            $("#leave").on('click', function () {
                rtc.client.leave(function () {
                    // Stop playing the local stream
                    rtc.localStream.stop();
                    rtc.localStream.close();
                    rtc.joined = false
                    // Stop playing the remote streams and remove the views
                    while (rtc.remoteStreams.length > 0) {
                        var stream = rtc.remoteStreams.shift();
                        var id = stream.getId();
                        stream.stop();
                        removeView(id);
                    }

                    console.log("client leaves channel success");
                }, function (err) {
                    console.log("channel leave failed");
                    console.error(err);
                });

            });

            function addView(id, show) {
                if (!$("#" + id)[0]) {
                    $("<div/>", {
                        id: "remote_video_panel_" + id,
                        class: "video-view",
                    }).appendTo("#video");
                    $("<div/>", {
                        id: "remote_video_" + id,
                        class: "video-placeholder",
                    }).appendTo("#remote_video_panel_" + id);
                    $("<div/>", {
                        id: "remote_video_info_" + id,
                        class: "video-profile " + (show ? "" : "hide"),
                    }).appendTo("#remote_video_panel_" + id);
                    $("<div/>", {
                        id: "video_autoplay_" + id,
                        class: "autoplay-fallback hide",
                    }).appendTo("#remote_video_panel_" + id);
                }
            }

            function removeView(id) {
                if ($("#remote_video_panel_" + id)[0]) {
                    $("#remote_video_panel_" + id).remove();
                }
            }

            function removeLocalView() {
                if ($("#lcoal_video_stream")[0]) {
                    $("#lcoal_video_stream").remove();
                }
            }

            function changeBit(){
                var appointmentId = $('#appointmentId').val();
                $.ajax({
                    method: "GET",
                    url: "{{url('/changeAppointmentStatusBit')}}/"+appointmentId,
                    data: {
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

            $(document).ready(function() {
                setInterval(checkAppointment, 5000);
            });

            function checkAppointment() {
                var appointmentId = $('#appointmentId').val();
                $.ajax({
                    method: "GET",
                    url: "{{url('/checkAppointmentStatus')}}/"+appointmentId,
                    data: {
                        'appointmentId': appointmentId
                    },
                    success: function (response) {
                        console.log(response);
                        if(response.status == 0){
                            // alert(response.message);
                            return false;
                        }
                        if(response.status == 1 && response.message == "Appointment Video Complete"){
                            location.href= "{{route('indexPage')}}";
                        }
                    }
                });
            }
        </script>


    </div>
</div>
</body>

</html>
