<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title }}</title>
	<link rel="icon" href="assets/images/favicon/icon.png">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/media-query.css') }}">
</head>

<body>
	<div class="site_content">
		<!-- Onboarding  Details Section Start -->
		<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
			<div class="first_slide">
				<div class="Onboarding-Screen-1 slide1">
					<div class="">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		<!-- Onboarding  Details Section End -->
	</div>
	<script src="{{ asset('assets/js/jquery-min-3.6.0.js') }}"></script>
	<script src="{{ asset('assets/js/slick.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
