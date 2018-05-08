<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome to Sweden</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }



        </style>




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
                            <h3> @{{city.cities_name}}</h3>
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
