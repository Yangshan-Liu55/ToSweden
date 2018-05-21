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

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Title -->
     @include('includes.title')
    <!-- Styles and Scripts -->
    @include('includes.stylesscripts')

    </head>
    <body ng-app="myApp" ng-controller="CitiesCtrl" ng-cloak>
        @include('includes.navbar')
      
        <div class="content">

            <div  ng-repeat="city in cities">
                <div class="row row-wrap">
<<<<<<< HEAD
                    <div class="col col-12 col-md-6 hovereffect">
                        <a href="city?nr=@{{city.id}}"><img ng-src="img/foto/@{{city.cities_img01}}" alt="City" class="d-block w-100 h-60">
                        <span  id="city-hero" ><img ng-src="img/skrivstil/@{{city.cities_head_img}}"></span>
                        <p class="overlay">Detalj</p>
                    </a>
=======
                    <div class="col col-12 col-md-6 p-0 hovereffect">
                        <img ng-src="img/foto/@{{city.cities_img01}}" alt="City" class="d-block w-100 h-60">
                        <span id="city-hero"><img ng-src="img/skrivstil/@{{city.cities_head_img}}"></span>
                        <a href="city?nr=@{{city.id}}" class="btn overlay"><span class="bottomlay">KLICK FÖR ATT SE MER</span></a>                    
>>>>>>> d2450c82915f2f77615978679df3debb128b770a
                    </div>
                    <div class="col col-12 col-md-6 px-5 py-4">
                        <div ng-repeat="s in breakStr((city.cities_text|limitTo:200)+'...')">
                            <p ng-bind-html="disBR(s)"></p>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>

    </body>
</html>
