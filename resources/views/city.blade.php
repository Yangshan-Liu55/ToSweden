
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
    <body ng-app="myApp" ng-controller="CitiesCtrl" >
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
            <div class="p-2 p-md-4 darkblue-bg rounded " id="headline-game">
                <p ng-bind-html="disBR(c.cities_text)"></p>
            </div>
       
            </div><!-- End of City -->

            <!--  -->

            <!-- To do -->
            <div class="row row-wrap m-2 mt-5" align="center">

                <button type="button" class="btn pointer btn-primary leftBtn menuSelect yellow-bg yellow-border navbar-black text-uppercase" ng-click="toToType='Sevärdhet'">Sevärdhet</button
                ><button type="button" class="btn pointer btn-primary middleBtn menuSelect yellow-bg yellow-border navbar-black text-uppercase" ng-click="toToType='Aktivitet'">Aktivitet</button
                ><button type="button" class="btn pointer btn-primary rightBtn menuSelect yellow-bg yellow-border navbar-black text-uppercase" ng-click="toToType='Shopping'" >Shopping</button>

            </div>
            <div class="yellowCard" ng-repeat="t in todo | filter: {todo_cities_id:citynr} | filter: {todo_activity:toToType}">                
                <div class="row row-wrap">
                    <div class="col col-12 col-md-6">
                        <img ng-src="img/todo/@{{t.todo_img01}}" alt="@{{t.todo_name}}" class="d-block w-100 h-60">
                    </div>
                    <div class="col col-12 col-md-6">
                            
                        <!-- Avgör om rubriken ska översättas eller inte -->  
                        <div ng-switch="@{{t.todo_translate_header}}">
                            <h3 ng-switch-when=1><span>@{{t.todo_name}}</span> </h3>
                            <h3 ng-switch-default><span class="notranslate";>@{{t.todo_name}}</span> </h3>
                        </div>
                            
                        <div ng-repeat="s in breakStr(t.todo_text)">
                            <p ng-bind-html="disBR(s)"></p>
                        </div>
                    </div>
                </div>
            </div><!-- End of To do -->

        </div>
    <!-- Footer -->
    @include('includes.footer')
    </body>
</html>
