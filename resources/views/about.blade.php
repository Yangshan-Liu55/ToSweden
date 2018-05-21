@php session_start(); @endphp
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
        @php echo $_SESSION['category']; @endphp

    <!-- TEXT OM OSS -->
    <h1 class="text-center mt-5">OM OSS</h1>
    <div class="container-fluid ">
        <div class="container">
        <hr class="hr" size=1   color="#ffcc00" style="border:2 solid #ffcc00">
        <p class="text-center">Den franske baronen och filosofen Pierre de Coubertin grundade de olympiska spelen 1894. Han var övertygad om att
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
</div>

   <br>
   <div  align ="center" class=" p-1 m-1">
   <img src="img/logotyp/logotyp.png" alt="2 Sweden">
   </div>
</body>
</html>