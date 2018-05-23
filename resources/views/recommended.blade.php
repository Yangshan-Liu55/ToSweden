
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
              
            <div class="container">

                <!-- City tabs -->
                <div class="row row-wrap mb-2 mt-5" align="center">
                    <div class="col col-4 pl-0">
                        <div class="p-2 m-0 tabBorder tabSelected text-uppercase @{{tabSelect1}}" ng-click="changeColor(1)">
                            <span>STOCKHOM</span>
                        </div>
                    </div>
                    <div class="col col-4 px-1">
                        <div class="p-2 m-0 tabBorder tabSelected text-uppercase @{{tabSelect2}}"ng-click="changeColor(2)">
                            <span>FALUN</span>
                        </div>
                    </div>
                    <div class="col col-4 pr-0">
                        <div class="p-2 m-0 tabBorder tabSelected text-uppercase @{{tabSelect3}}" ng-click="changeColor(3)">
                            <span>ÅRE</span>
                        </div>
                    </div>
                </div>

                <!-- Aktivitets tabs -->
                <!-- <div class="row row-wrap mb-2 mt-5" align="center">
                    <div class="col col-6">
                        <div class="p-2 m-0" style="background: @{{bgColor0}};" ng-click="">
                            <span>Hotel/resturang</span>
                        </div>
                    </div>
                    <div class="col col-6">
                        <div class="p-2 m-0" style="background: @{{bgColor0}};" ng-click="changeColor()">
                            <span>Aktiviteter</span>
                        </div>
                    </div>
                </div> -->

                <div ng-repeat="h in hotels | filter: filterFunction" class="mb-3">
                    
                    <div class="row middle-grey-bg px-0 py-2 mb-3 tabBorder">
                        <div class="col col-5 my-auto">
                            <img ng-src="img/hotels/@{{h.hotels_img01}}" alt="City" class="rounded img-fluid">
                        </div>
                        <div class="col col-7 px-auto" style="color:black">
                            <h3> @{{h.hotels_name}}</h3>
                            <!-- <span>@{{h.hotels_text|limitTo:100}}...</span> -->
                            <p>BETYG: 3.4/5</p>     
                            <p><i class="fas fa-phone-volume" style="color:#ffcc00;"></i>  +46 8 21 53 10</p>                   
                            <p><i class="fas fa-map-marker" style="color:#ffcc00;"></i>  Stockholm Sweden 0,2 km till centrum</p>
                            <a href="" class="btn btn-warning float-right" style="color:white;">GÅ TILL HEMSIDA</a>
                        </div>
                    </div>

                </div>                

            </div>
        </div>
    <!-- Footer -->
    @include('includes.footer')
    </body>
</html>
