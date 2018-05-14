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
        <!-- City -->
            <div style="padding: 5px" ng-repeat="c in cities | filter: {id:citynr}">
            <!-- Slides -->
            <div id="cCity" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                <li data-target="#cCity" data-slide-to="0" class="active"></li>
                <li data-target="#cCity" data-slide-to="1"></li>
                </ol>     
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100 h-60" ng-src="img/foto/@{{c.cities_img01}}" alt="City image 1">
                </div>     
                <div class="carousel-item">
                <img class="d-block w-100 h-60" ng-src="img/foto/@{{c.cities_img02}}" alt="City image 2"> 
                </div>                
                </div>     
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#cCity" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#cCity" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- End of Slides -->

            <h1 style="font-size:50px; text-align:center;">@{{c.cities_name}}</h1>
            <div class="yellowCard">               
                <p style="color:white">@{{c.cities_text}}</p>
            </div>
            <h2 style="text-align:center;">Att Göra I @{{c.cities_name}}</h2>           
            </div><!-- End of City -->

            <!-- To do -->
            <div class="yellowCard" ng-repeat="t in todo | filter: {todo_cities_id:citynr}">                
                <div class="row row-wrap">
                    <div class="col col-12 col-md-6">
                        <a href="@{{t.todo_img01}}"><img ng-src="@{{t.todo_img01}}" alt="ToDo Image 1" class="d-block w-100 h-60"></a>
                    </div>
                    <div class="col col-12 col-md-6">
                        <h3 style="color:#006699;text-align:center; padding-top:15px">@{{t.todo_name}}</h3>
                        <p>@{{t.todo_text}}</p>
                    </div>
                </div>
            </div><!-- End of To do -->

        </div>

    </body>
</html>
