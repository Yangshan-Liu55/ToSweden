//Angular-delen

//Search rome2rio api bas
var searchAPI = "http://free.rome2rio.com/api/1.4/json/Search?";
var searchAPIKey = "key=S2Q8spaR";
var searchSpecify = "&noSpecial&noBikeshare&noRideshare&noTowncar&noMinorStart&noMinorEnd&noCommuter&oKind=city&dKind=city";
var searchFrom = "&oName=";
var searchTo = "&dName=";

//valuta api bas
var currencyAPI = "http://data.fixer.io/api/latest?";
var currencyAPIKey = "access_key=69b996c0142c261c2378e5656d182eb7";

//google map API
var googleAPI = "https://www.google.com/maps/embed/v1/directions?";
var googleKey = "key=AIzaSyAApIIpuOK_GeeYmYGiSp9DgvnWGRjPhR4";
var googleFrom = "&origin=";
var googleTo = "&destination=";

var app = angular.module("myApp", []);

//Search delen i Home.php
app.controller("searchCtrl", function ($scope, $http) {

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
            resultAmount = currencyToConvert + " " + $scope.choosenCurrency;

        } else {

            //om man väljer EUR som valuta
            resultAmount = convertedAmount + " " + $scope.choosenCurrency;

        }

        //om pris fältet är tomt
        if (moneyToConvert == null) {
            resultAmount = "";
        }

        return resultAmount;
    }

    //visar detaljer om resan, avgångar, ankomster, restid, pris och valuta
    $scope.getDetails = function (index) {

        //hämtar resvägen man vill ha detaljer för
        var route = $scope.info.routes[index];

        $scope.depCity = $scope.info.places[route.depPlace].longName;

        $scope.arrCity = $scope.info.places[route.arrPlace].longName;

        $scope.cash = $scope.convertMoney(route.indicativePrices[0].priceLow);

        $scope.travelTime = $scope.timeConvert(route.totalDuration);

        //en array att lagra detalj informationen
        $scope.travelInfo = [];

        //för varje segment i resvägen
        for (var i = 0; i < route.segments.length; i++) {

            //hämtar avgångstationen
            $scope.depName = $scope.info.places[route.segments[i].depPlace].shortName;

            //hämtar ankomststationen
            $scope.arrName = $scope.info.places[route.segments[i].arrPlace].shortName;

            //tiden mellan stationerna
            var time = route.segments[i].transitDuration;

            //resvägens namn
            $scope.routeName = route.name;

            //antal segment
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
                $scope.travelInfo.push({ 'depName': $scope.depName, 'arrName': $scope.arrName, 'transferTime': time, 'lowPrice': lowPrice, 'highPrice': highPrice, 'currency': currency });
            }
            else {
                //lägg till i array
                $scope.travelInfo.push({ 'depName': $scope.depName, 'arrName': $scope.arrName, 'transferTime': time });
            }
        }
        $scope.googleUrl = googleAPI + googleKey + googleFrom + $scope.depCity + googleTo + $scope.arrCity;
        document.getElementById("googleMap").src = $scope.googleUrl;

    };

    var savedInfo = {};
    $scope.saveData = function () {
        savedInfo["routeName"] = $scope.routeName;
        savedInfo["cities"] = $scope.depCity +" - " + $scope.arrCity;
        savedInfo["time"] = $scope.travelTime;
        savedInfo["costLow"] = $scope.cash; 
        var ending = new Date(Date.now() + 60 * 1000).toString();
        var cookieString = "";
        for (var key in savedInfo) {
            cookieString = key + "=" + savedInfo[key] + ";" + ending + ";";
            document.cookie = cookieString;
        }
    }

    $scope.loadData = function () {
        savedInfo = {};
        var kv = document.cookie.split(";");
        for (var id in kv) {
            var cookie = kv[id].split("=");
            savedInfo[cookie[0].trim()] = cookie[1];
        }
        document.getElementById("showRoute").innerHTML ="Resnamn: " + savedInfo["routeName"];
        document.getElementById("showCities").innerHTML = "Resmål: "+savedInfo["cities"];
        document.getElementById("showTime").innerHTML = "Tid: " + savedInfo["time"];
        document.getElementById("showCost").innerHTML = "Kostnad: "+savedInfo["costLow"];
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

    $scope.breakStr = function (str) {
        return str.split("/n");
    }

    $scope.disBR = function (str1) {
        return $sce.trustAsHtml(str1);
    }
});

//Hämtar JSON för Recommended  i Recommended.php.
app.controller('allToDo', function ($scope, $http) {
    $http.get('http://steffo.info/toswe-api/toswe-todo.php')
        .then(function (response) {
            $scope.allToDo = response.data;
        });
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
    
    $scope.tabSelect1 = "yellow-bg navbar-black";
    $scope.tabSelect2 = "yellow-bg navbar-black";
    $scope.tabSelect3 = "yellow-bg navbar-black";

    // $scope.bgColor1 = "#ffcc00"; //#B18904
    // $scope.bgColor2 = "#ffcc00"; 
    // $scope.bgColor3 = "#ffcc00"; 
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
                if ($scope.tabSelect1 == "yellow-bg navbar-black") {
                    $scope.tabSelect1 = "dark-yellew-bg";
                    addRes(1);
                    break;
                }
                else {
                    $scope.tabSelect1 = "yellow-bg navbar-black";
                    removeRes(1);
                    break;
                }

            case 2:
                if ($scope.tabSelect2 == "yellow-bg navbar-black") {
                    $scope.tabSelect2 = "dark-yellew-bg";
                    addRes(2);
                    break;
                }
                else {
                    $scope.tabSelect2 = "yellow-bg navbar-black";
                    removeRes(2);
                    break;
                }

            case 3:
                if ($scope.tabSelect3 == "yellow-bg navbar-black") {
                    $scope.tabSelect3 = "dark-yellew-bg";
                    addRes(3);
                    break;
                }
                else {
                    $scope.tabSelect3 = "yellow-bg navbar-black";
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

/*var myCookies = {};

function saveCookies() {
    myCookies["city"] = document.getElementById("inputCity").value;
    var selectMenu = document.getElementById("selectCity");
    myCookies["select"] = selectMenu.options[selectMenu.selectedIndex].value;
    var expires = new Date(Date.now() + 60 * 1000).toString();
    var cookieString = "";
    for (var key in myCookies) {
        cookieString = key + "=" + myCookies[key] + ";" + expires + ";";
        document.cookie = cookieString;
    }
}

function loadCookies() {
    myCookies = {};
    var kv = document.cookie.split(";");
    for (var id in kv) {
        var cookie = kv[id].split("=");
        myCookies[cookie[0].trim()] = cookie[1];
    }
    document.getElementById("inputCity").value = myCookies["city"];
    var selectMenu = document.getElementById("selectCity");
    selectMenu.value = myCookies["select"];
}*/

