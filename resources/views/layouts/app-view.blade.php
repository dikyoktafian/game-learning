<!doctype html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
	<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
	<!--[if gt IE 8]>
	<!--> 
	<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
	<!--<![endif]-->
		<head>
            <meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<meta name="viewport" content="width=device-width, initial-scale=1">

            <title>Game Learning</title>
			<meta name="description" content="Game Learning descrption.">
			<meta name="keywords" content="keyword, e-learning">
			<meta name="author" content="Diky Oktafian">

            <meta property="og:type" content="website"/>
            <meta property="og:title" content="Game Learning"/>
            <meta property="og:url" content="https://blackmotorace.blackxperience.com"/>
            <meta property="og:image" content="https://blackmotorace.blackxperience.com/images/logo.jpg"/>
            <meta property="og:site_name" content="Game Learning"/>
            <meta property="og:description" content="Game Learning descrption."/>

            <meta name="twitter:card" content="summary"/>
            <meta name="twitter:title" content="Game Learning"/>
            <meta name="twitter:description" content="Game Learning descrption."/>
            <meta name="twitter:image" content="https://blackmotorace.blackxperience.com/images/logo.jpg"/>
            <meta name="twitter:url" content="https://blackmotorace.blackxperience.com"/>

            <link rel="icon" href="{{ asset('/images/favicon.ico') }}">
			<link rel="manifest" href="{{ asset('manifest.json') }}">

            <!-- Bootstrap 4.3.1 -->
			<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

			<!-- Roboto 400 -->
            <!-- Font Awesome 4.7.0 -->
            <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
            <link rel="stylesheet" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
			<link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

			<link rel="stylesheet" href="{{ asset('fonts/main.css?v=1.0.0') }}">
			<link rel="stylesheet" href="{{ asset('css/app.css?v=1.0.0') }}">
			@yield('css')

		</head>
		<body class="page">
			<!--[if lt IE 8]>
				<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
			<![endif]-->

			@yield('content')

			<!-- Jquery and Bootstrap -->
			<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
			<script src="{{ asset('vendor/bootstrap/js/popper.min.js') }}"></script>
			<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
			<script src="{{ asset('js/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
			<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
			<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
            <script src="{{ asset('js/main.js') }}"></script>
            
            <!-- Ionic Iocns -->
            <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
            
			<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=UA-XXXXXXXXX-X"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
            
              gtag('config', 'UA-XXXXXXXXX-X');
			</script>
			<script>
				// CODELAB: Register service worker.
				if ('serviceWorker' in navigator) {
				window.addEventListener('load', () => {
					navigator.serviceWorker.register('/sw.js')
						.then((reg) => {
						console.log('Service worker registered.', reg);
						});
				});
				}
			</script>
			@yield('scripts')
		</body>
</html>
