
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
    <body ng-app="myApp" ng-controller="HotelsCtrl" class=" imgBG">
            @include('includes.navbar')
        <div class="position-ref full-height">
              
            <div class="container">
                
                <!-- City tabs -->
                <div class="row row-wrap  my-3" align="center">

                    <button type="button" class="btn btn-font-size pointer leftBtn hotelSelect text-uppercase @{{tabSelect1}} " ng-click="changeColor(1)">Stockholm</button
                    ><button type="button" class="btn btn-font-size pointer middleBtn hotelSelect text-uppercase @{{tabSelect2}} " ng-click="changeColor(2)">Falun</button
                    ><button type="button" class="btn btn-font-size pointer rightBtn hotelSelect text-uppercase @{{tabSelect3}} " ng-click="changeColor(3)" >Åre</button>

                </div>

                <!-- Aktivitets tabs -->
                <!-- <div class="row row-wrap mb-2 mt-5" align="center">
                    <div class="col col-6">
                        <div class="p-2 m-0" style="background: @{{bgColor0}};" ng-click="changeColor()">
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
                    
                    <div class="row schedule-sports-bg px-0 py-2 mb-3 tabBorder">
                        <div class="col col-5 my-auto">
                            <a href="/img/hotels/@{{h.hotels_img01}}"><img ng-src="/img/hotels/@{{h.hotels_img01}}" alt="City" class="rounded img-fluid"></a>
                        </div>
                        <div class="col col-7 px-auto" style="color:black">
                            <h3> @{{h.hotels_name}}</h3>
                            <!-- <span>@{{h.hotels_text|limitTo:100}}...</span> -->
                            <p>BETYG: @{{h.hotels_stars}}/5</p>     
                            <p><i class="fas fa-phone-volume middleblue-col" ></i>  @{{h.hotels_phone}}</p>                   
                            <p><i class="fas fa-map-marker middleblue-col" ></i>  @{{h.hotels_tocity}}</p>
                            <a href="@{{h.hotels_web}}" class="btn btn-warning float-right middleblue-col" style="color:white;">GÅ TILL HEMSIDA</a>
                        </div>
                    </div>

                </div>                

            </div>
        </div>
    <!-- Footer -->
    @include('includes.footer')
    </body>
</html>
