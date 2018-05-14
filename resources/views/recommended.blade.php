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
    <body ng-app="myApp" ng-controller="HotelsCtrl">
            @include('includes.navbar')
        <div class="position-ref full-height">
            
            <div class="content">

                <div ng-repeat="h in hotels">
                    <a href="">
                    <div class="row row-wrap">
                      <div class="col col-12 col-md-4">
                        <img ng-src="img/hotels/@{{h.hotels_img01}}" alt="City" weight="75px" height="75px">
                      </div>
                      <div class="col col-12 col-md-2">
                           <h3> @{{h.hotels_name}}</h3>
                      </div>
                      <div class="col col-12 col-md-6"  >
                        <span>@{{h.hotels_text|limitTo:100}}...</span>
                    </div>
                  </div>
                </a>
                     <hr>
                </div>

            </div>
        </div>


    </body>
</html>
