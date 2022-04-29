<h1></h1>
<!doctype html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta name="language" content="pt-BR">
		<link rel="icon" type="img/png" sizes="16x16"  href="favicon.png">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="theme-color" content="#ffffff">
		<title>@yield('title') </title>
		<meta name="description" content="">
		<meta name="robots" content="all">
		<meta name="author" content="Keven Castilho">
		<meta name="keywords" content="SIM,PREDIAL,FORMULARIO,MANUTENÇÃO">

		<meta property="og:type" content="page">
		<meta property="og:url" content="">
		<meta property="og:title" content="">
		<meta property="og:image" content="https://i.imgur.com/P80IuPi.png">
		<meta property="og:description" content="">

		<meta property="article:author" content="Keven Castilho">

		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="">
		<meta name="twitter:title" content="">
		<meta name="twitter:creator" content="@VenatuAdMortem">
		<meta name="twitter:description" content="">

		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
		<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700;800&amp;family=Roboto:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="styles/fontawesome-all.min.css">
        <script src="scripts/font.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/min.css">
		<link rel="apple-touch-icon" sizes="180x180" href="../../app/icons/icon-192x192.png">
		<style>
			body{
			margin:0px;
			padding:0px;
			}
			.card-center{
			top: 40% !important;
			}
            p{
                color:#000 !important;
                font-weight: bold;
            }
		</style>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PJ24DF8');</script>
<!-- End Google Tag Manager -->

    <!-- Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7WLKE56X38"></script>
    <script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-7WLKE56X38');
    </script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	
	 <script>
        function voltar() {
            window.location.href = "/SIM_Frota";
        }
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-ABCDE1');
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-12345678-90"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-12345678-90');
    </script>
    <!-- ------------------------------------------------------------------------------- -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-39365077-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
                '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script type="text/javascript">      
        window.csrf_token = "{{ csrf_token() }}"
      </script>
	</head>
    
    
<body class="theme-light">


<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJ24DF8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div id="preloader" class="preloader-hide">
        
    </div>
    <div id="page" data-swup="0">
        <div class="container">
			<div class="row">
				<div class="page-content">
					<div class="card bg-transparent mb-0" data-card-height="cover" style="height: 799px;">
					    
						<div class="mx-3 text-center">
						  
						</br>
							<img src="img/logo-min.png" class="img-fluid"  style="max-width:500px"/>  
						</br>
							<p class="font-16 mb-4"></p>
						</br></br>
						<div class="row mb-0 mx-auto" style="max-width:330px">
						@yield('content')   
						<footer>
									<div class="col-12">
										<p class="color-black mb-0 opacity-60 pt-4 font-11">
											Be Tecnologia 2022 - &copy Todos Os Direitos Reservados.
									</div>
								</footer>  
								</div>
                        </div>
					</div>
				</div>
			</div>
		</div>
			<div class="page-bg"></div>
		</div>
	</div>
</div>
    <script type="text/javascript" src="scripts/bootstrap.min.js"></script>
    <div class="menu-hider"></div>
    <p class="offline-message bg-red-dark color-white">No internet connection detected</p>
    <p class="online-message bg-green-dark color-white">You are back online</p>
</body>

</html>



