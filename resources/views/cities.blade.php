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


<script>
//Angular-delen 
var app = angular.module('myApp', []);
app.controller('CitiesCtrl', function($scope, $http) {
  $http.get('http://steffo.info/toswe-api/toswe-cities.php')
  .then(function(response) {
      $scope.cities = response.data;
  });
});
</script>
    </body>
</html>
