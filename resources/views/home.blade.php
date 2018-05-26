@php session_start(); @endphp
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
                <img src="img/skrivstil/welcome.png">
            </div>
        </div>
        <!-- <div style="height:100%" class="container">
            <h1 class="text-center" id="welcometext">WELCOME
                <span class="highlight">TO SWEDEN</span>
            </h1>
        </div>-->
    </div>
    <!-- SÖK RESA -->
    <div class="test" ng-controller="searchCtrl" ng-init="changeCurrency()">
        <div class="searchField">
            <div class="container" id="navbar">
                <form class="container" name="searchForm">
                  <div class="col-sm-12" align="center">
                    <div class="form-group col-md-6 col-sm-12" align="left">
                        <label>FRÅN</label>
                        <input id="inputCity" required ng-model="fromCity" type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-6 col-sm-12" align="left">
                        <label for="exampleFormControlSelect1">DESTINATION</label>
                        <select ng-model="toCity" required class="form-control " id="selectCity">
                            <option value="Stockholm">Stockholm</option>
                            <option value="Åre">Åre</option>
                            <option value="Falun">Falun</option>
                        </select>
                      <div align="right">
                        <button ng-click="search()" type="submit" class="btn btn-lg mt-3">SÖK</button>
                        <button ng-click="loadData()" class="btn btn-lg mt-3">Sparad Resa</button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
            <div class="container darkblue-bg">
                <h3 class="text-center" id="showRoute"></h3>
                <h3 class="text-center" id="showCities"></h3>
                <h3 class="text-center" id="showTime"></h3>
                <h3 class="text-center" id="showCost"></h3>
                <h3 class="text-center" id="test"></h3>
            </div>
        </div>
        <!-- SLUT på SÖK RESA -->
        <!-- 
    visar URL eller FEL meddelande 
    <p id="apiUrl"></p>
    -->
        <!-- START, visa RESULTATET vid respons från server -->
        <div ng-show="isResultOpen" class="container mt-4 table-responsive-sm middle-grey-bg nopadding">
            <table class="container table ">
                <thead class="lightblue-bg">
                    <th ng-click="sortBy('name')"><h5>Färdmedel<h5></th>
                    <th ng-click="sortBy('totalDuration')"><h5>Tid</h5></th>
                    <th ng-click="sortBy('indicativePrices[0].priceLow')"><h5>Pris</h5></th>
                    <th>
                        <h5>Valuta</h5>
                        <select class="form-control" ng-model="choosenCurrency">
                            <option value="EUR">EUR</option>
                            <option value="SEK">SEK</option>
                            <option value="USD">USD</option>
                        </select>
                    </th>
                </thead>
                <tr id="search-row" class="pointer middleblue-col" ng-repeat="route in info.routes | orderBy: propertyName : reverse" ng-click="getDetails($index)" data-toggle="modal" data-target="#myModal">
                    <td><span ng-bind-html="addIcon(route.name)"></span><span class="pl-1">@{{route.name}}</span></td>
                    <td>@{{timeConvert(route.totalDuration)}}</td>
                    <td>@{{convertMoney(route.indicativePrices[0].priceLow)}} - @{{convertMoney(route.indicativePrices[0].priceHigh)}}</td>
                    <td align="center">
                        <button class="btn pointer" >Detaljer</button>
                        <button ng-click="getVeichle($index)">FORDON</button>

                    </td>
                </tr>
            </table>
            <div class="pb-4" align="center">
                <button ng-click="closeResult()" class="btn btn-danger col-md-6 col-sm-12 btn-block pointer">Stäng</button>
            </div>
        </div>
        
        

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
                        <div style="color:black" ng-repeat="resa in travelInfo">@{{resa}}</div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button ng-click="saveData()" class="btn btn-success">Spara resa</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Stäng</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- SLUT på Modal RESULTATET-->

    <!-- Modal för OS-SCHEMA -->

    <div class="container p-4  col-md-6 col-sm-12">
        <button id="osschema-knapp" class="btn darkblue-bg btn-block pointer" data-toggle="modal" data-target="#eventsModal">
            <h2 class="white-col">
                <i class="far fa-calendar-alt yellow-col"></i> &nbsp;&nbsp;OS-schema</h2>
        </button>
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
                <div class="modal-body">

                    <!-- OS Schema -->
                    @include('includes.scheduele-table')      
                 
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Stäng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- SLUT Modal för OS-schema -->
    
    <!-- Footer -->
    @include('includes.footer')
</body>
</html>