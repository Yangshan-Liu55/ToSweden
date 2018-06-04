//Angular-delen

//Search rome2rio api bas
var searchAPI = "http://free.rome2rio.com/api/1.4/json/Search?";
var searchAPIKey = "key=S2Q8spaR";
var searchSpecify = "&noSpecial&noBikeshare&noRideshare&noTowncar&noMinorStart&noMinorEnd&noCommuter&oKind=city&dKind=city";
var searchFrom = "&oName=";
var searchTo = "&dName=";

//valuta api bas
var currencyAPI = "http://data.fixer.io/api/latest?";
var currencyAPIKey = "access_key=75c2d7067bea8674ce16c6a88eb10ccc";

//google map API
var googleAPI = "https://www.google.com/maps/embed/v1/directions?";
var googleKey = "key=AIzaSyAApIIpuOK_GeeYmYGiSp9DgvnWGRjPhR4";
var googleFrom = "&origin=";
var googleTo = "&destination=";

var app = angular.module("myApp", []);

//Search delen i Home.php
app.controller("searchCtrl", function ($scope, $http, $sce) {

    //vald valuta
    $scope.choosenCurrency = "EUR";

    //staden man åker från
    $scope.fromCity = document.getElementById("inputCity").value;

    //staden man ska till
    $scope.toCity = document.getElementById("selectCity").value;

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

        //hämtar valuta i json format
        $.ajax({
            url: currencyUrl,
            dataType: 'jsonp',
            success: function (json) {

                //lagrar valuta datan
                $scope.currencyInfo = json;
            }
        });
    }

    //konverterar till vald valuta
    $scope.convertMoney = function (moneyToConvert) {

        //konverterar bas valutan 'USD' till EUR
        var convertedAmount = Math.round(moneyToConvert / $scope.currencyInfo.rates.USD);

        //lagra resultatet
        var resultAmount;

        //vilken valuta man väljer
        var currencyToConvert;

        if ($scope.choosenCurrency == "SEK") {

            //om man väljer SEK som valuta
            currencyToConvert = Math.round(convertedAmount * $scope.currencyInfo.rates.SEK);
            resultAmount = currencyToConvert + " " + $scope.choosenCurrency;

        } else if ($scope.choosenCurrency == "USD") {

            //om man väljer USD som valuta
            currencyToConvert = Math.round(convertedAmount * $scope.currencyInfo.rates.USD);
            resultAmount = "$" + currencyToConvert;

        } else {

            //om man väljer EUR som valuta
            resultAmount = "€" + convertedAmount;

        }

        //om pris fältet är tomt
        if (moneyToConvert == null) {
            resultAmount = "";
        }

        return resultAmount;
    }

    //visar detaljer om resan, avgångar, ankomster, restid, pris och valuta
    $scope.getDetails = function (index) {
        removePolyline();
        $scope.map = new google.maps.Map(document.getElementById(index), {
            zoom: 4,
            center: { lat: 61.72744, lng: 15.62597 },
            mapTypeId: 'roadmap'
        });
        //hämtar resvägen man vill ha detaljer för
        var route = $scope.info.routes[index];

        //resvägens namn
        $scope.routeName = route.name;

        $scope.depCity = $scope.info.places[route.depPlace].longName;

        $scope.arrCity = $scope.info.places[route.arrPlace].longName;

        $scope.lowestPrice = $scope.convertMoney(route.indicativePrices[0].priceLow);

        $scope.highestPrice = $scope.convertMoney(route.indicativePrices[0].priceHigh);

        $scope.travelTime = $scope.timeConvert(route.totalDuration);

        //en array att lagra detalj informationen
        $scope.travelInfo = [];

        //Skriver ut aktuell karta.     
        let source = googleAPI + googleKey + googleFrom + $scope.depCity + googleTo + $scope.arrCity;

        //för varje segment i resvägen
        for (var i = 0; i < route.segments.length; i++) {

            //hämtar avgångstationen
            $scope.depName = $scope.info.places[route.segments[i].depPlace].shortName;

            //hämtar ankomststationen
            $scope.arrName = $scope.info.places[route.segments[i].arrPlace].shortName;

            //tiden mellan stationerna
            var time = route.segments[i].transitDuration;

            //antal segment
            $scope.segmentLength = route.segments.length;

            $scope.googlePath = route.segments[i].path;

            if (typeof route.segments[i].path !== 'undefined') {
                setPolyline(google.maps.geometry.encoding.decodePath($scope.googlePath));
            } else {
                $scope.depLat = $scope.info.places[route.segments[i].depPlace].lat;
                $scope.depLng = $scope.info.places[route.segments[i].depPlace].lng;

                $scope.arrLat = $scope.info.places[route.segments[i].arrPlace].lat;
                $scope.arrLng = $scope.info.places[route.segments[i].arrPlace].lng;

                setPolyline([{
                    lat: $scope.depLat,
                    lng: $scope.depLng
                },
                {
                    lat: $scope.arrLat,
                    lng: $scope.arrLng
                }
                ]);
            }
            //om prices fältet inte är tomt
            if (route.segments[i].indicativePrices != null) {
                //lägsta pris segment resan
                var lowPrice = route.segments[i].indicativePrices[0].priceLow;
                //högsta pris för segment resan
                var highPrice = route.segments[i].indicativePrices[0].priceHigh;

                //läger till allt i array
                $scope.travelInfo.push({ 'routeName': $scope.routeName, 'lowTotalPrice': $scope.lowestPrice, 'highTotalPrice': $scope.highestPrice, 'totalTravelTime': $scope.travelTime, 'depLat': $scope.depLat, 'depLng': $scope.depLng, 'arrLat': $scope.arrLat, 'arrLng': $scope.arrLng, 'path': $scope.googlePath, 'depName': $scope.depName, 'arrName': $scope.arrName, 'transferTime': time, 'lowPrice': lowPrice, 'highPrice': highPrice });
            }
            else {
                //lägg till i array
                $scope.travelInfo.push({ 'routeName': $scope.routeName, 'lowTotalPrice': $scope.lowestPrice, 'highTotalPrice': $scope.highestPrice, 'totalTravelTime': $scope.travelTime, 'depLat': $scope.depLat, 'depLng': $scope.depLng, 'arrLat': $scope.arrLat, 'arrLng': $scope.arrLng, 'path': $scope.googlePath, 'depName': $scope.depName, 'arrName': $scope.arrName, 'transferTime': time });
            }
        }

        $scope.googleUrl = $sce.trustAsHtml("<iframe class='img-thumbnail' width='100%' height='400px' frameborder='0' style='border:0'  src='" + source + "' allowfullscreen></iframe>");

    };

    var polyLine = [];
    function setPolyline(_path) {
        polyLine.push(new google.maps.Polyline({
            //map: map,
            path: _path,
            strokeColor: '#006699',
            strokeOpacity: 1,
            strokeWeight: 3
        }));
        polyLine[polyLine.length - 1].setMap($scope.map);
    }

    function removePolyline() {
        if (typeof polyLine !== 'undefined') {
            for (var index in polyLine) {
                polyLine[index].setMap(null);
            }
            polyLine = [];
        }
    }

    var localPolyLine = [];
    function setLocalPolyline(localpath) {
        localPolyLine.push(new google.maps.Polyline({
            //map: map,
            path: localpath,
            strokeColor: '#006699',
            strokeOpacity: 1,
            strokeWeight: 3
        }));
        localPolyLine[localPolyLine.length - 1].setMap($scope.localGoogleMap);
    }
    function removeLocalPolyline() {
        if (typeof localPolyLine !== 'undefined') {
            for (var index in localPolyLine) {
                localPolyLine[index].setMap(null);
            }
            localPolyLine = [];
        }
    }
    
    
    $scope.saveLocal = function () {
        localStorage.setItem("arraydata", JSON.stringify($scope.travelInfo));
    }

    $scope.loadLocal = function () {
        $scope.localInfo = JSON.parse(localStorage.getItem("arraydata"));
        removeLocalPolyline();
        if ($scope.localInfo != null) {
            $scope.localName = $scope.localInfo[0].routeName;

            $scope.localLowPrice = $scope.localInfo[0].lowTotalPrice;

            $scope.localHighPrice = $scope.localInfo[0].highTotalPrice;

            $scope.localTotalTime = $scope.localInfo[0].totalTravelTime;

            $scope.localShow = true;

            $scope.localGoogleMap = new google.maps.Map(document.getElementById('localGoogleMap'), {
                zoom: 4,
                center: { lat: 61.72744, lng: 15.62597 },
                mapTypeId: 'roadmap'
            });

            for (var i = 0; i < $scope.localInfo.length; i++) {
                if (typeof $scope.localInfo[i].path !== 'undefined') {

                    setLocalPolyline(google.maps.geometry.encoding.decodePath($scope.localInfo[i].path));

                } else {
                    setLocalPolyline([{
                        lat: $scope.localInfo[i].depLat,
                        lng: $scope.localInfo[i].depLng
                    },
                    {
                        lat: $scope.localInfo[i].arrLat,
                        lng: $scope.localInfo[i].arrLng
                    }
                    ]);
                }
            }
            //let localSrc = $scope.localInfo[0].googleSrc;
            //$scope.localMap = $sce.trustAsHtml("<iframe class='img-thumbnail' width='100%' height='400px' frameborder='0' style='border:0'  src='" + localSrc + "' allowfullscreen></iframe>");
            //console.log($scope.localInfo);
        }
        else {
            document.getElementById("warning").innerHTML = "Ingen sparad resa finns";
        }
    }



    /*LÄGG TILL ICON VID SÖKRESULTATEN */
    $scope.addIcon = function (travelText) {

        /Omvandlar till små bokstäver/
        var travel = travelText.toLowerCase();

        /Spara färdmedel för de olika resor*/
        var output = "";
        var tArray = travel.replace(',', '').replace('.', '').split(' ');
        tArray.forEach(element => {
            switch (element) {
                case "fly":
                    output = output + ' <img src="/img/travel/pos/air.png" width ="20px" height="20px">';
                    break;

                case "bus":
                    output = output + ' <img src="/img/travel/pos/bus.png" width ="20px" height="20px" >';
                    break;

                case "train":
                    output = output + ' <img src="/img/travel/pos/train.png" width ="20px" height="20px">';
                    break;

                case "walk":
                    output = output + ' <img src="/img/travel/pos/walk.png" width ="20px" height="20px">';
                    break;

                case "drive":
                    output = output + ' <img src="/img/travel/pos/car.png" width ="20px" height="20px">';
                    break;

                case "ferry":
                    output = output + ' <img src="/img/travel/pos/boat.png" width ="20px" height="20px">';
                    break;

                default:
                    break;
            }
        });

        return $sce.trustAsHtml(output);



    }
});



//Hämtar JSON för Sporter till schema i Home.php.
app.controller('sportsCtrl', function ($scope, $http) {
    $http.get('http://steffo.info/toswe-api/toswe-sports.php')
        .then(function (response) {
            $scope.sports = response.data;
        });
});



app.controller('selectTabs', function ($scope) {
    $scope.click = function (itemNmb) {
        $scope.tabOut = itemNmb;
        console.log(itemNmb)
    };
});



//Hämtar JSON för Cities till schema i Cities.php.
app.controller('CitiesCtrl', function ($scope, $http, $location, $sce) {
    $http.get('http://steffo.info/toswe-api/toswe-cities.php')
        .then(function (response) {
            $scope.cities = response.data;
        });

    //local url
    var locurl = $location.absUrl();
    $scope.citynr = locurl.substring(locurl.lastIndexOf('nr') + 3, locurl.lastIndexOf('nr') + 4);

    $http.get('http://steffo.info/toswe-api/toswe-todo.php')
        .then(function (response) {
            $scope.todo = response.data;
        });

    $scope.toToType;

    $scope.breakStr = function (str) {
        return str.split("/n");
    }

    $scope.disBR = function (str1) {
        return $sce.trustAsHtml(str1);
    }
});

//Hämtar JSON för Recommended  i Recommended.php.
app.controller('allEvents', function ($scope, $http) {
    $http.get('http://steffo.info/toswe-api/toswe-events.php')
        .then(function (response) {
            $scope.allEvents = response.data;
        });
});

//Hämtar JSON för Recommended  i Recommended.php.
app.controller('HotelsCtrl', function ($scope, $http) {
    $http.get('http://steffo.info/toswe-api/toswe-hotels.php')
        .then(function (response) {
            $scope.hotels = response.data;
        });

    $scope.tabSelect1 = "yellow-bg yellow-border navbar-black";
    $scope.tabSelect2 = "yellow-bg yellow-border navbar-black";
    $scope.tabSelect3 = "yellow-bg yellow-border navbar-black";

    var cSelected = [];

    var addRes = function (n) {
        if (cSelected.indexOf(n) < 0) {
            cSelected.push(n);
        }
    }
    var removeRes = function (n) {
        var indexid = cSelected.indexOf(n);
        if (indexid >= 0) {
            cSelected.splice(indexid, 1);
        }
    }

    $scope.changeColor = function (n) {
        switch (n) {
            case 1:
                if ($scope.tabSelect1 == "yellow-bg yellow-border navbar-black") {
                    $scope.tabSelect1 = "lightblue-bg lightblue-border white-col";
                    addRes(1);
                    break;
                }
                else {
                    $scope.tabSelect1 = "yellow-bg yellow-border navbar-black";
                    removeRes(1);
                    break;
                }

            case 2:
                if ($scope.tabSelect2 == "yellow-bg yellow-border navbar-black") {
                    $scope.tabSelect2 = "lightblue-bg lightblue-border white-col";
                    addRes(2);
                    break;
                }
                else {
                    $scope.tabSelect2 = "yellow-bg yellow-border navbar-black";
                    removeRes(2);
                    break;
                }

            case 3:
                if ($scope.tabSelect3 == "yellow-bg yellow-border navbar-black") {
                    $scope.tabSelect3 = "lightblue-bg lightblue-border white-col";
                    addRes(3);
                    break;
                }
                else {
                    $scope.tabSelect3 = "yellow-bg yellow-border navbar-black";
                    removeRes(3);
                    break;
                }

            default:
                break;
        }
    }

    $scope.filterFunction = function (e) {
        switch (cSelected.length) {
            case 0:
                return e.hotels_cities_id > 0;
                break;

            case 1:
                return e.hotels_cities_id == cSelected[0];
                break;

            case 2:
                if (cSelected.indexOf(1) < 0) {
                    return e.hotels_cities_id != 1;
                    break;
                }
                else if (cSelected.indexOf(2) < 0) {
                    return e.hotels_cities_id != 2;
                    break;
                }
                else if (cSelected.indexOf(3) < 0) {
                    return e.hotels_cities_id != 3;
                    break;
                }

            case 3:
                return e.hotels_cities_id > 0;
                break;

            default:
                break;
        }
    }

});
