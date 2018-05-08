<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to Sweden</title>

    <!-- Styles and Scripts -->
    @include('includes.stylesscripts')
    <style>
    body{
    background-color: #006699;
    color: white;
     
}
h1{
    font-family: Raleway;
    font-size: 20px;
}
p{
    font-family: Lato;
    font-size: 14px;
}


.navbar{
    background: #ffcc00 !important; 
    background-color: #ffcc00 !important; 
}
#homeimage img{
    position: relative;

}
.highlight{
    color: #ffcc00;
}

.modal .thead{
    background-color: #006699;
}

.modal-title, .modal-body td{
    color: #006699;
}
    </style>
</head>

<body ng-app="myApp" ng-controller="myCtrl">
    @include('includes.navbar')
    <!-- NAVIGATION -->

    <div class="container" id="homeimage">
        <img src="https://blogg.svenskakyrkan.se//kennethlandeliusigen/files/2015/02/image14.jpg" class="rounded mx-auto d-block" width="100%" alt="...">
    </div>
    <h2 class="text-center" id="welcometext">WELCOME
        <span class="highlight">TO SWEDEN</span>
    </h2>

    <!-- SÖK RESA -->
    <div class="container" id="navbar">
        <form name="searchForm">
            <div class="form-group">
                <label>FRÅN</label>
                <input required ng-model="fromCity" type="text" class="form-control mb-2 mr-sm-2 mb-sm-0">
                <small id="emailHelp" class="form-text text-muted">FROM</small>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">DESTINATION</label>
                <select ng-model="toCity" required class="form-control" id="exampleFormControlSelect1">
                    <option value="Stockholm" selected>Stockholm</option>
                    <option value="Åre">Åre</option>
                    <option value="Falun">Falun</option>
                </select>
            </div>
            <button ng-disabled="" ng-click="search()" type="submit" class="btn btn-primary">SÖK</button>
        </form>
    </div>
    <!-- SLUT på SÖK RESA -->

    <!-- 
    visar URL eller FEL meddelande 
    <p id="apiUrl"></p>
    -->
    <!-- START, visa RESULTATET vid respons från server -->
    <div ng-show="isSearchClicked" class="container mt-3 table-responsive-sm">
        <table class="table table-hover">
            <thead class="thead-light">
                <th ng-click="sortBy('name')">Färdmedel</th>
                <th ng-click="sortBy('totalDuration')">Tid</th>
                <th ng-click="sortBy('indicativePrices[0].priceLow')">Pris</th>
                <th></th>
            </thead>
            <tr ng-repeat="route in info.routes | orderBy: propertyName : reverse">
                <td>@{{route.name}}</td>
                <td>@{{timeConvert(route.totalDuration)}}</td>
                <td>@{{route.indicativePrices[0].priceLow + route.indicativePrices[0].currency}} - @{{route.indicativePrices[0].priceHigh
                    + route.indicativePrices[0].currency}}</td>
                <td>
                    <button class="btn btn-primary" ng-click="getDetails($index)" data-toggle="modal" data-target="#myModal">Detaljer</button>
                </td>
            </tr>
        </table>
        <button ng-click="closeResult()" class="btn btn-danger btn-block">Stäng</button>
    </div>
        <!-- SLUT på SÖK RESULTAT -->


        <!-- The Modal för att visa DETALJER -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">@{{routeName}}</h4>
                        <h2>@{{segmentLength}}</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead class="thead">
                                <th>Plats</th>
                                <th>Tid</th>
                                <th>Pris</th>
                            </thead>
                            <tr ng-repeat="infoResa in travelInfo">
                                <td>@{{infoResa.depName}} - @{{infoResa.arrName}}</td>
                                <td>@{{timeConvert(infoResa.transferTime)}}</td>
                                <td>@{{infoResa.lowPrice}} @{{infoResa.currency}} - @{{infoResa.highPrice}} @{{infoResa.currency}}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Stäng</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- SLUT på Modal RESULTATET-->
    <!-- TEXT OM OSS -->

    <h1 class="text-center mt-5">OM OSS</h1>
    <div class="container-fluid navbar">

        <p class="text-center">Den franske baronen och filosofen Pierre de Coubertin grundade de olympiska spelen 1894. Han var övertygad om att
            man kan göra världen bättre med hjälp av idrott. De första olympiska spelen arrangerades i Aten 1896. Inspirationen
            till spelen var hämtade från idrottstävlingar som hölls till guden Zeus ära i Grekland under antiken.
        </p>
    </div>

    <script>



        //         //jQuery-delen
        //         $(function(){
        //         $.getJSON("http://steffo.info/toswe-api/toswe-cities.php", function(data){
        //          var items = [];//Global variablel        
        //         $.each( data, function( key, val ) {
        //            // console.log("key "+key)
        //            // console.log("val "+val['cities_name'])
        //             items.push(val['cities_name']); 
        //         });
        //       //  console.log ("All Cities: "+items)
        //         $("#cities").html(items);
        //         });
        //     });

        //Angular-delen 
        var api = "http://free.rome2rio.com/api/1.4/json/Search?";
        var apiKey = "key=S2Q8spaR";
        var specify = "&noCar&noSpecial&noBikeshare&noRideshare&noTowncar&noMinorStart&noMinorEnd&noCommuter&oKind=city&dKind=city";
        var from = "&oName=";
        var to = "&dName=";


        var app = angular.module("myApp", []);

        app.controller("myCtrl", function ($scope, $http) {

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

            //staden man åker från
            $scope.fromCity = [];

            //staden man ska till
            $scope.toCity = "Stockholm";

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
                        //lägsta pris resan
                        var lowPrice = route.segments[i].indicativePrices[0].priceLow;
                        //högsta pris för resan
                        var highPrice = route.segments[i].indicativePrices[0].priceHigh;
                        //currency
                        var currency = route.segments[i].indicativePrices[0].currency

                        $scope.travelInfo.push({ 'depName': depName, 'arrName': arrName, 'transferTime': time, 'lowPrice': lowPrice, 'highPrice': highPrice, 'currency': currency });
                    }
                    else {
                        //lägg till i array
                        $scope.travelInfo.push({ 'depName': depName, 'arrName': arrName, 'transferTime': time });
                    }

                }

            };

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
                    $scope.isSearchClicked = true;

                }, function errorCallback(response) {

                    //skriver ut om ingen respons från servern
                    //document.getElementById("apiUrl").innerHTML = "Ingen respons från servern!";

                });
            }

            $scope.closeResult = function(){
                $scope.isSearchClicked = false;
            }

        });
    </script>
</body>

</html>