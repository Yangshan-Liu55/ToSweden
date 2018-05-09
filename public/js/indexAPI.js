//Angular-delen 
var api = "http://free.rome2rio.com/api/1.4/json/Search?";
var apiKey = "key=S2Q8spaR";
var specify = "&noSpecial&noBikeshare&noRideshare&noTowncar&noMinorStart&noMinorEnd&noCommuter&oKind=city&dKind=city";
var from = "&oName=";
var to = "&dName=";

var app = angular.module("myApp", []);

app.controller("searchCtrl", function ($scope, $http) {

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

        //skapar jsonUrl
        var jsonUrl = api + apiKey + specify + from + $scope.fromCity + to + $scope.toCity;

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

    //visar detaljer om resan
    $scope.getDetails = function (index) {

        //hämtar resvägen man vill ha detaljer för
        var route = $scope.info.routes[index];

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

            //om fältet inte är tomt
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

        }

    };
});