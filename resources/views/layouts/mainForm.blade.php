<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="language" content="pt-BR">
    <link rel="icon" type="image/png" sizes="16x16" href="<favicon.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title')</title>
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
    <!-- <link rel="stylesheet" href="css/all.css">  -->
    <!-- {{-- <link rel="stylesheet" href="css/all.min.css"> --}} -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/signature-pad.css">
    <link rel="stylesheet" href="styles/estilos.css">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <link rel="stylesheet" type="text/css" href="styles/min.css">
    <!-- Tag Manager -->
    <script>
        function voltar() {
            window.location.href = "/SIM_Frota/FinalizarChamado";
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

    <!-- Analytics -->
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

<body>
    <div class="container">
        <div class="row Header">
            <div class="col-xs-12">
                </br>
                <img src="img/logo-min.png" class="img-fluid" />
            </div>
        </div>

        @yield('content')
        <div class="row Footer">
            <div class="col-xs-12"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="{{asset('scripts/signature_pad.umd.js')}}"></script>
    <script src="{{asset('scripts/app.js')}}"></script>
    <script src="{{asset('scripts/app-main.js')}}"></script>
</body>

</html>
