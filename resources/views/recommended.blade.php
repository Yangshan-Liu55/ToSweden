
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

                <!-- City tabs -->

                <div class="row row-wrap mb-2 mt-5" align="center">
                    <div class="col col-4">
                        <div class="p-2 m-0" style="background: @{{bgColor1}};" ng-click="changeColor(1)">
                            <span>STOCKHOM</span>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="p-2 m-0" style="background: @{{bgColor2}};" ng-click="changeColor(2)">
                            <span>FALUN</span>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="p-2 m-0" style="background: @{{bgColor3}};" ng-click="changeColor(3)">
                            <span>ÅRE</span>
                        </div>
                    </div>
                </div>
                   
                <!-- Aktivitets tabs -->

                      <div class="row row-wrap mb-2 mt-5" align="center">
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

                </div>

                <div ng-repeat="h in hotels | filter: filterFunction" class="mb-3">
                    <a href="">
                    <div class="row row-wrap bg-info p-2">
                        <div class="col col-4">
                            <img ng-src="img/hotels/@{{h.hotels_img01}}" alt="City" weight="75px" height="75px">
                        </div>
                        <div class="col col-8" style="padding-left:40px; color:black">
                            <h3> @{{h.hotels_name}}</h3>
                            <span>@{{h.hotels_text|limitTo:100}}...</span>
                        </div>
                    </div>
                    </a>
                </div>                

            </div>
        </div>
    <!-- Footer -->
    @include('includes.footer')
    </body>
</html>
