var app = angular.module('myApp', []);

app.controller("CitiesCtrl", function($scope, $http, $location){

  //hämta data
  var url = "http://steffo.info/toswe-api/toswe-cities.php";
  $http.get(url)
    .then(function(response){
      $scope.request = response;
      console.log("get from api.php: "+$scope.request);
      $scope.cities = $scope.request.data;
  });

  //local url
  var locurl = $location.absUrl();
  // $scope.citynr = locurl.substring(locurl.lastIndexOf('nr') + 3, locurl.length);
  $scope.citynr = locurl.substring(locurl.length-1, locurl.length);
  console.log("get locurl: "+locurl);
  console.log("get citynr: "+$scope.citynr);

});