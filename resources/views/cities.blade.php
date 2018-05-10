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
    <body ng-app="myApp" ng-controller="CitiesCtrl">
            @include('includes.navbar')

            
            <div class="content">
                
                <h1>Cities</h1>

                <div ng-repeat="city in cities">
                    <div class="row row-wrap">
                    <div class="col col-12 col-md-4">
                        <a href="@{{city.cities_img01}}"><img ng-src="@{{city.cities_img01}}" alt="City" weight="75px" height="75px"></a>
                      </div>
                      <div class="col col-12 col-md-2">
                            <a href="city?nr=@{{city.id}}"><h3> @{{city.cities_name}}</h3></a>
                       </div>
                       <div class="col col-12 col-md-6"  >
                        
                        <span>@{{city.cities_text|limitTo:100}}...</span>
                    </div>
                  </div>
                     <hr>
                </div>
            </div>



    </body>
</html>
