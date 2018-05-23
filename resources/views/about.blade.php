
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119022172-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119022172-1');
    </script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Title -->
    @include('includes.title')

    <!-- Styles and Scripts -->
    @include('includes.stylesscripts')
</head>
<body>
        @include('includes.navbar')
        <div  align ="center">
        <div class="center"> 
                <img style="width:100%;" src="/img/foto/osrings.jpg" />
        </div>
        </div>
    <!-- TEXT OM oss -->
    <h1 class="text-center mt-5">Om To Sweden</h1>
        <div class="container">         
        <hr class="hr" size=1   color="#ffcc00" style="border:2 solid #ffcc00">
        <p class="px-5">Vi leder alla till Sverige. To Sweden samarbetar med Svenska Olympiska kommittén och den 
            internationella olympiska kommittén för att hjälpa världens medborgare till årtusendets event.<BR><BR>
            Vi anser att en lyckad upplevelse börjar redan vid resan, därför har vi lagt mycket tid och omsorg
            för att hitta de rätta vägarna till årets olympiska spel. <BR><BR>
                Välkommen till landet av snö och is!
        </p>
     
        <div class="row " align="center">
        
        <div class="col col-1 m-0 p-0">
            <p><img  src="img/Paint/squer.png" alt="">
        </div>

        <div class="col "> <hr class="yellow-bg" size="5"> </div>
        
        <div class="col col-1 m-0 p-0">
            <img  src="img/Paint/squer.png" alt=""></p>
        </div>
        </div>
    </div>
<!-- Slut om oss -->        
    <!-- TEXT OM OS -->
    <h1 class="text-center mt-5">Historien om OS</h1>
        <div class="container">         
        <hr class="hr" size=1   color="#ffcc00" style="border:2 solid #ffcc00">
        <p class="px-5">Den franske baronen och filosofen Pierre de Coubertin grundade de olympiska spelen 1894. Han var övertygad om att
            man kan göra världen bättre med hjälp av idrott. De första olympiska spelen arrangerades i Aten 1896. Inspirationen
            till spelen var hämtade från idrottstävlingar som hölls till guden Zeus ära i Grekland under antiken.
        </p>
     
        <div class="row " align="center">
        
        <div class="col col-1 m-0 p-0">
            <p><img  src="img/Paint/squer.png" alt="">
        </div>

        <div class="col "> <hr class="yellow-bg" size="5"> </div>
        
        <div class="col col-1 m-0 p-0">
            <img  src="img/Paint/squer.png" alt=""></p>
        </div>
        </div>
    </div>
<!-- Slut om OS -->

   <br>
   <div  align ="center" class=" pt-2 pb-4">
   <img src="img/logotyp/logotyp.png" alt="2 Sweden">
   </div>

       <!-- Footer -->
       @include('includes.footer')
</body>
</html>