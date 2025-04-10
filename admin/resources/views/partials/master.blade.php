<!DOCTYPE html>
<html lang="tr">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Wiky Watch CRM Sistemi</title>
	<meta name="author" content="Selimcan Gürsu | Full Stack Web Developer">
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Public Sans:300,400,500,600,700"]},
			custom: {"families":["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
</head>
<body>
	<div class="wrapper">
	     @include('partials.sidebar')
		<div class="main-panel">
			@include('partials.header')	
			<div class="container">
				@yield('main')
			</div>	
	     @include('partials.footer')
		</div>
	</div>
	<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
	<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
	<script src="{{asset('assets/js/plugin/jsvectormap/world.js')}}"></script>
	<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
	<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
	<script src="{{asset('assets/js/setting-demo.js')}}"></script>
	<script src="{{asset('assets/js/demo.js')}}"></script>
</body>
</html>