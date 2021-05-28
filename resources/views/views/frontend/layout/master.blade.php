<!DOCTYPE html>
<html lang="en">

    @include('frontend.layout.head')

<body>

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->

    
    @yield('main-content')
	<!-- /main content -->
	
    
    @include('frontend.layout.footer')

	<div id="toTop"></div>
	<!-- Back to top button -->

    @include('frontend.layout.script')



</body>

</html>