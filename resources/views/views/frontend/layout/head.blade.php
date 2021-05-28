<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Find easily a doctor and book online an appointment">
	<meta name="author" content="Ansonika">
	
	@yield('title')

	<!-- Favicons-->
	<link rel="shortcut icon" href="{{asset('public/frontend/img/logo.png')}}" type="image/x-icon">
	
	<!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/menu.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/vendors.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet">
    
	<!-- YOUR CUSTOM CSS -->
	<link href="{{asset('public/frontend/css/custom.css')}}" rel="stylesheet">

	<style>
		.active-class{
			color: #e74e84 !important;
		}
	</style>

	@yield('css')

	<!-- Modernizr -->
	<script src="{{asset('public/frontend/js/modernizr.js')}}"></script>

</head>