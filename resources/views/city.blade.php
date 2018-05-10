<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
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
                
            <h1>City</h1>

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
                    <a href="@{{c.cities_img01}}"><img class="d-block w-100 h-60" ng-src="@{{c.cities_img01}}" alt="City image 1"></a> 
                </div>     
                <div class="carousel-item">
                    <a href="@{{c.cities_img02}}"><img class="d-block w-100 h-60" ng-src="@{{c.cities_img02}}" alt="City image 2"></a> 
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
            <h1>@{{c.cities_name}}</h1>
            <p>@{{c.cities_text}}</p>
            </div><!-- End of City -->

        </div>


<script>
    //Angular-delen 
    var app = angular.module('myApp', []);
    app.controller('CitiesCtrl', function($scope, $http, $location) {

        $http.get('http://steffo.info/toswe-api/toswe-cities.php')
            .then(function(response) {
                $scope.cities = response.data;
        });

        //local url
        var locurl = $location.absUrl();
        $scope.citynr = locurl.substring(locurl.lastIndexOf('nr') + 3, locurl.lastIndexOf('nr') + 4);

    });
</script>
    </body>
</html>
