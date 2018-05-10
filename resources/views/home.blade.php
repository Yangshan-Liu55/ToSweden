<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    @include('includes.title')
    <!-- Styles and Scripts -->
    @include('includes.stylesscripts')
    <style>
        #map {
            height: 200px;
            width: 100%;
        }
    </style>
</head>

<body ng-app="myApp">
    @include('includes.navbar')
    <!-- NAVIGATION -->

    <div class="" id="homeimage">
        <img src="https://blogg.svenskakyrkan.se//kennethlandeliusigen/files/2015/02/image14.jpg" class="rounded mx-auto d-block"
            width="100%" alt="...">
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
                    <th></th>
                </thead>
                <tr ng-repeat="route in info.routes | orderBy: propertyName : reverse">
                    <td>@{{route.name}}</td>
                    <td>@{{timeConvert(route.totalDuration)}}</td>
                    <td>@{{(route.indicativePrices[0].priceLow/currencyInfo.rates.USD) | number: 0}} - @{{(route.indicativePrices[0].priceHigh/currencyInfo.rates.USD)
                        | number: 0}} @{{currencyInfo.base}}</td>
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
                                <td>@{{(infoResa.lowPrice/currencyInfo.rates.USD) | number: 0}} - @{{(infoResa.highPrice/currencyInfo.rates.USD)
                                    | number: 0}} @{{currencyInfo.base}}</td>
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
    <!-- SLUT https://www.google.com/maps/dir/?api=1&origin=berlin+germany&destination=paris+france på Modal RESULTATET-->

    <!-- TEST FÖR SCHEMA -->
    <div ng-controller="sportsCtrl" class="container p-5">
        <div ng-if="sport.id==2" ng-repeat="sport in sports">
            <div class="row row-wrap">
                <img src="http://steffo.info/img/pictogram/neg/@{{sport.sports_img}}" weight="40px" height="40px"> &nbsp;&nbsp;
                <h6>@{{sport.sports_name_swe}}</h6>
            </div>
            <hr>
        </div>
    </div>


    <!-- SLUT TEST FÖR SCHEMA -->

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