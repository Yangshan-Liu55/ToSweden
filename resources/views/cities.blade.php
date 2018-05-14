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
                    <div class="col col-12 col-md-6" style="position:relative;">
                        <a href="city?nr=@{{city.id}}"><img ng-src="img/foto/@{{city.cities_img01}}" alt="City" class="d-block w-100 h-60">
                        <span style="position:absolute; z-indent:2; left:15%; top:30%; font-size:70px; color:white;">@{{city.cities_name}}</span></a>
                    </div>
                    <div class="col col-12 col-md-6 px-5 py-4">                       
                        <span><p>@{{city.cities_text|limitTo:300}}...</p></span>
                    </div>
                </div>
                
            </div>
        </div>



    </body>
</html>
