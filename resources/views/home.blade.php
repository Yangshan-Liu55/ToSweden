<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119022172-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
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

    <div class="" id="homeimage">
        <img src="img/foto/sverige01.jpg" class="rounded mx-auto d-block"
            width="100%" alt="Welcome to Sweden">
    </div>
    <h2 class="text-center" id="welcometext">WELCOME
        <span class="highlight">TO SWEDEN</span>
    </h2>

    <!-- SÖK RESA -->
    <div ng-controller="searchCtrl" ng-init="changeCurrency()">
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
        <div ng-show="isResultOpen" class="container mt-3 table-responsive-sm">
            <table class="table table-hover">
                <thead class="thead-light">
                    <th ng-click="sortBy('name')">Färdmedel</th>
                    <th ng-click="sortBy('totalDuration')">Tid</th>
                    <th ng-click="sortBy('indicativePrices[0].priceLow')">Pris</th>
                    <th>
                   Valuta
                    <select ng-model="choosenCurrency">
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
                        <iframe id="googleMap" width="100%" height="300" frameborder="0" style="border:0" src= "" allowfullscreen>
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

<BR><BR>
    <img src="/img/travel/pos/bus.png"><img src="/img/travel/pos/air.png"><img src="/img/travel/pos/train.png"><img src="/img/travel/pos/walk.png"><BR><BR>
        <img src="/img/travel/neg/bus.png"><img src="/img/travel/neg/air.png"><img src="/img/travel/neg/train.png"><img src="/img/travel/neg/walk.png"><BR><BR>
        <div class="container">
        <button class="btn btn-warning btn-block"  data-toggle="modal" data-target="#eventsModal">OS-schema</button>
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
                <!-- Filter för att plocka ut rätt sporter till rätt städer -->
                    <!-- Loopar igenom alla Städer -->
                    <div ng-controller="CitiesCtrl" >
                        <div ng-repeat="city in cities" >
                            <div class="thead p-3"><h5>@{{city.cities_name}}</h5></div>
                            <div ng-controller="sportsCtrl" >
                                <!-- Loopar igenom alla Sporter -->
                                <div class="eventsHeader bg-info p-2" ng-if="sport.sports_cities_id==city.id" ng-repeat="sport in sports">
                                    <img  src="/img/pictogram/neg/@{{sport.sports_img}}"  weight="40px" height="40px">  <h6 >@{{sport.sports_name_swe}}</h6>
                                    <!-- Loopar igenom Sportschema -->
                                    <div class="eventsBody bg-light" ng-controller="allEvents" >
                                        <div ng-if="event.events_sports_id==sport.id" ng-repeat="event in allEvents">
                                            <div class="row row-wrap p-3">
                                                <!-- Kontrollerar medaljstatus -->
                                                <div ng-if="event.events_status==1"><img src="/img/pictogram/pos/day.png"></div>
                                                <div ng-if="event.events_status==2"><img src="/img/pictogram/pos/medal.png"></div>                        
                                                &nbsp;&nbsp;<h6 class="toS-blue">Dag: @{{event.events_date}}/2</h6>
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


    <!-- TEXT OM OSS -->
    <h1 class="text-center mt-5">OM OSS</h1>
    <div class="container-fluid navbar">

        <p class="text-center">Den franske baronen och filosofen Pierre de Coubertin grundade de olympiska spelen 1894. Han var övertygad om att
            man kan göra världen bättre med hjälp av idrott. De första olympiska spelen arrangerades i Aten 1896. Inspirationen
            till spelen var hämtade från idrottstävlingar som hölls till guden Zeus ära i Grekland under antiken.
        </p>
    </div>
</body>

</html>