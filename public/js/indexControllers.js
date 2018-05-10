//Angular-delen

//Search rome2rio api bas
var searchAPI = "http://free.rome2rio.com/api/1.4/json/Search?";
var searchAPIKey = "key=S2Q8spaR";
var searchSpecify = "&noSpecial&noBikeshare&noRideshare&noTowncar&noMinorStart&noMinorEnd&noCommuter&oKind=city&dKind=city";
var searchFrom = "&oName=";
var searchTo = "&dName=";

//valuta api bas
var currencyAPI = "http://data.fixer.io/api/latest?";
var currencyAPIKey = "access_key=8a07f22cf0d5906c37ae53d615974ff6";
var callBack = "&callback=data";

//google map API
var googleAPI = "https://www.google.com/maps/embed/v1/directions?";
var googleKey = "key=AIzaSyAApIIpuOK_GeeYmYGiSp9DgvnWGRjPhR4";
var googleFrom = "&origin=";
var googleTo = "&destination=";

var app = angular.module("myApp", []);

//Search delen i Home.php
app.controller("searchCtrl", function ($scope, $http, $sce) {

    //staden man åker från
    $scope.fromCity = [];

    //staden man ska till
    $scope.toCity = "Stockholm";

    //sorterar listan på det man valt
    $scope.sortBy = function (propertyName) {
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
        $scope.propertyName = propertyName;
    };

    //när man söker resa
    $scope.search = function () {
        //skapar jsonUrl för sökningen
        var jsonUrl = searchAPI + searchAPIKey + searchSpecify + searchFrom + $scope.fromCity + searchTo + $scope.toCity;
        //hämtar json
        $http({
            method: 'GET',
            url: jsonUrl
        }).then(function successCallback(response) {

            //lagrar datan från json
            $scope.info = response.data;

            //visar api url
            //document.getElementById("apiUrl").innerHTML = jsonUrl;

            //visar true om man har klickat på sök och fått resultat
            $scope.isResultOpen = true;

        }, function errorCallback(response) {

            //skriver ut om ingen respons från servern
            //document.getElementById("apiUrl").innerHTML = "Ingen respons från servern!";

        });
    }
    $scope.closeResult = function () {
        $scope.isResultOpen = false;
    }

    //konverterar tiden i minuter till timmar och minuter
    $scope.timeConvert = function (data) {
        var minutes = data % 60;
        var hours = (data - minutes) / 60;

        var result;

        if (hours == 0) {
            result = minutes + " min";
        }
        else {
            result = hours + "h" + " " + minutes + "min";
        }
        return result;
    }

    //hämtar valuta
    $scope.changeCurrency = function () {

        //url till valuta API
        var currencyUrl = currencyAPI + currencyAPIKey;

        //vald valuta
        $scope.choosenCurrency = "EUR";

        //hämtar valuta i json format
        $.ajax({
            url: currencyUrl,
            dataType: 'jsonp',
            success: function (json) {

                //lagrar valuta datan
                $scope.currencyInfo = json;
            }
        });
        //document.getElementById("currencyTest").innerHTML = currencyUrl;
    }

    //visar detaljer om resan, avgångar, ankomster, restid, pris och valuta
    $scope.getDetails = function (index) {

        //hämtar resvägen man vill ha detaljer för
        var route = $scope.info.routes[index];

        var depCity = $scope.info.places[route.depPlace].longName;

        var arrCity = $scope.info.places[route.arrPlace].longName;

        //en array att lagra detalj informationen
        $scope.travelInfo = [];

        //för varje segment i resvägen
        for (var i = 0; i <= route.segments.length; i++) {

            //hämtar avgångstationen
            var depName = $scope.info.places[route.segments[i].depPlace].shortName;

            //hämtar ankomststationen
            var arrName = $scope.info.places[route.segments[i].arrPlace].shortName;

            //tiden mellan stationerna
            var time = route.segments[i].transitDuration;

            //resvägens namn
            $scope.routeName = route.name;

            $scope.segmentLength = route.segments.length;

            //om prices fältet inte är tomt
            if (route.segments[i].indicativePrices != null) {
                //lägsta pris segment resan
                var lowPrice = route.segments[i].indicativePrices[0].priceLow;
                //högsta pris för segment resan
                var highPrice = route.segments[i].indicativePrices[0].priceHigh;
                //currency
                var currency = route.segments[i].indicativePrices[0].currency

                //läger till allt i array
                $scope.travelInfo.push({ 'depName': depName, 'arrName': arrName, 'transferTime': time, 'lowPrice': lowPrice, 'highPrice': highPrice, 'currency': currency });
            }
            else {
                //lägg till i array
                $scope.travelInfo.push({ 'depName': depName, 'arrName': arrName, 'transferTime': time });
            }

            $scope.googleUrl = googleAPI + googleKey + googleFrom + depCity + googleTo + arrCity;
            document.getElementById("googleMap").src = $scope.googleUrl;

        }

    };
});

//Hämtar JSON för Sporter till schema i Home.php.
app.controller('sportsCtrl', function ($scope, $http) {
    $http.get('http://steffo.info/toswe-api/toswe-sports.php')
        .then(function (response) {
            $scope.sports = response.data;
        });
});

//Hämtar JSON för Cities till schema i Cities.php.
app.controller('CitiesCtrl', function ($scope, $http) {
    $http.get('http://steffo.info/toswe-api/toswe-cities.php')
        .then(function (response) {
            $scope.cities = response.data;
        });
});

//Hämtar JSON för Recommended  i Recommended.php.
app.controller('allToDo', function ($scope, $http) {
    $http.get('http://steffo.info/toswe-api/toswe-todo.php')
        .then(function (response) {
            $scope.allToDo = response.data;
        });
});