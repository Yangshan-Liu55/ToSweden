<!doctype html>
<html lang="{{ app()->getLocale() }}">

<!-- php artisan serve : öppna localt -->

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119022172-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
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

<body ng-app="myApp">
    @include('includes.navbar')
    <!-- NAVIGATION -->
    <div id="homeimage">
        <div id="home-welcome">
            <div id="home-welcome-center">
                <img  src="img/skrivstil/welcome.png"> 
            </div>  
        </div>
    </div>

    <!-- SÖK RESA -->
    <div ng-controller="searchCtrl" ng-init="changeCurrency()">
        <div class="searchField">
            <div class="container" id="navbar">
                <form class="container" name="searchForm">
                    <div class="form-group">
                        <label>FRÅN</label>
                        <input required ng-model="fromCity" type="text" class="form-control mb-2 mr-sm-2 mb-sm-0">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">DESTINATION</label>
                        <select ng-model="toCity" required class="form-control" id="exampleFormControlSelect1">
                            <option value="Stockholm" selected>Stockholm</option>
                            <option value="Åre">Åre</option>
                            <option value="Falun">Falun</option>
                        </select>
                    </div>
                    <div align="right">
                    <button ng-click="search()" type="submit" class="btn btn-lg">SÖK</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- SLUT på SÖK RESA -->

        <!-- 
    visar URL eller FEL meddelande 
    <p id="apiUrl"></p>
    -->
        <!-- START, visa RESULTATET vid respons från server -->
        <div ng-show="isResultOpen" class="container mt-3 table-responsive-sm resultBox">
            <table class="container table table-hover">
                <thead class="">
                    <th ng-click="sortBy('name')">Färdmedel</th>
                    <th ng-click="sortBy('totalDuration')">Tid</th>
                    <th ng-click="sortBy('indicativePrices[0].priceLow')">Pris</th>
                    <th>
                        Valuta
                        <select class="form-control" ng-model="choosenCurrency">
                            <option value="EUR">EUR</option>
                            <option value="SEK">SEK</option>
                            <option value="USD">USD</option>
                        </select>
                    </th>
                </thead>
                <tr ng-repeat="route in info.routes | orderBy: propertyName : reverse">
                    <td>@{{route.name}}</td>
                    <td>@{{timeConvert(route.totalDuration)}}</td>
                    <td>@{{convertMoney(route.indicativePrices[0].priceLow)}} - @{{convertMoney(route.indicativePrices[0].priceHigh)}}</td>
                    <td align="center">
                        <button class="btn" ng-click="getDetails($index)" data-toggle="modal" data-target="#myModal">Detaljer</button>
                    </td>
                </tr>
            </table>
            <div align="center">
            <button ng-click="closeResult()" class="btn btn-danger col-md-6 col-sm-12 btn-block">Stäng</button>
            </div>
        </div>
        <!-- SLUT på SÖK RESULTAT -->
        <!-- The Modal för att visa DETALJER -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">@{{routeName}}</h4>
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
                                <td>@{{convertMoney(infoResa.lowPrice)}} - @{{convertMoney(infoResa.highPrice)}}</td>
                            </tr>
                        </table>
                        <iframe id="googleMap" width="100%" height="300" frameborder="0" style="border:0" src="" allowfullscreen>
                        </iframe>
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

    <!-- Modal för OS-SCHEMA -->
 


    <BR>
    <BR>
    <img src="/img/travel/pos/bus.png">
    <img src="/img/travel/pos/air.png">
    <img src="/img/travel/pos/train.png">
    <img src="/img/travel/pos/walk.png">
    <BR>
    <BR>
    <img src="/img/travel/neg/bus.png">
    <img src="/img/travel/neg/air.png">
    <img src="/img/travel/neg/train.png">
    <img src="/img/travel/neg/walk.png">
    <BR>
    <BR>
    <div class="container">
        <button class="btn darkblue-bg btn-block pointer" data-toggle="modal" data-target="#eventsModal"><h2 class="white-col"><i class="far fa-calendar-alt yellow-col"></i> &nbsp;&nbsp;OS-schema</h2></button>
    </div>

    <div class="modal" id="eventsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">OS-schema</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div  class="modal-body">
                    <!-- Filter för att plocka ut rätt sporter till rätt städer -->
                    <!-- Loopar igenom alla Städer -->
                    <div ng-controller="CitiesCtrl">
                        <div ng-repeat="city in cities">
                            <div id="schedule-thead" class="thead p-3">
                                <h5>@{{city.cities_name}}</h5>
                            </div>
                            <div ng-controller="sportsCtrl">
                                <!-- Loopar igenom alla Sporter -->
                                <div class="eventsHeader schedule-sports-bg " ng-if="sport.sports_cities_id==city.id" ng-repeat="sport in sports">
                                    <div id="schedule-row" class="row p-1">
                                        <div class="col">
                                            <div class="p-2">
                                                <img class="schedule-picto" src="/img/pictogram/neg/@{{sport.sports_img}}" >
                                            </div>
                                        </div>
                                        <div id="schedule-sports-name" class="col-9">
                                            <h6>@{{sport.sports_name_swe}}</h6>
                                        </div>
                                    </div>
                                    
                                    <!-- Loopar igenom Sportschema -->
                                    <div class="eventsBody schedule-days-bg " ng-controller="allEvents">
                                        <div class="schedule-days-border" ng-if="event.events_sports_id==sport.id" ng-repeat="event in allEvents">
                                            <div class="row  p-3">
                                                
                                                <!-- Kontrollerar medaljstatus -->
                                                <div class="col" ng-if="event.events_status==1">
                                                    <img class="schedule-picto" src="/img/pictogram/pos/day.png">
                                                </div>
                                                <div class="col" ng-if="event.events_status==2">
                                                    <img class="schedule-picto" src="/img/pictogram/pos/medal.png">
                                                </div>
                                                <div class="col-9">
                                                    <div class="schedule-sports-name py-2">
                                                        <h6 >@{{event.events_cities_day_swe}} @{{event.events_date}}/2</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- SLUT Filter för schema -->
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Stäng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- SLUT Modal för OS-schema -->

<div class="footer p-5"></footer>
</body>

</html>