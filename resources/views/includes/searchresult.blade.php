

<div ng-show="isResultOpen" class="container mt-4 table-responsive-sm  pale-grey-bg">
        <div class="row ">
            <div class="col-12 lightblue-bg">
                <div class="row p-3">
                    <div class="col-6 col-sm-8"></div>
                    <div class="col-2 col-sm-2 "><h5 style="position: absolute; bottom:0; right:0;">Valuta</h5></div>
                    <div class="col-4 col-sm-2">
                        <select class="form-control pointer" ng-model="choosenCurrency">
                            <option value="EUR">EUR</option>
                            <option value="SEK">SEK</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 " ng-click="sortBy('name')">
                        <h5 class="pointer">Färdmedel<h5>
                    </div>
                    <div class="col-3" ng-click="sortBy('totalDuration')">
                        <h5 class="pointer">Tid</h5>
                    </div>
                    <div class="col-4" ng-click="sortBy('indicativePrices[0].priceLow')">
                        <h5 class="pointer">Totalt pris</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 pale-grey-bg middleblue-col ">
                <div id="search-row" 
                class="row eventsHeader pointer middleblue-col middleblue-border remove-house-borders p-3" 
                ng-repeat="route in info.routes | orderBy: propertyName : reverse"
                ng-click="getDetails($index)"
                data-target="post@{{$index}}"
                >
                    <div class="col-5">
                        @{{route.name}}
                    </div>
                    <div class="col-3">
                        @{{timeConvert(route.totalDuration)}}
                    </div>
                    <div class="col-4">
                        @{{convertMoney(route.indicativePrices[0].priceLow)}} - @{{convertMoney(route.indicativePrices[0].priceHigh)}}
                    </div>
                    <div class="col-12 eventsBody even-paler-grey-bg py-2  mt-3 ">
                        <div id="post@{{$index}}" class="row" > 
                            <!-- Skriver ut karta -->
                            <div ng-bind-html="googleUrl" class="col-12 col-lg-6 "></div>
                            <!-- Skriver ut delarna i resrutt -->
                            <div  class="col-12 col-lg-6 ">
                                <div class="row" ng-repeat="infoResa in travelInfo" >
                                    <div class="col-12 pb-2 pt-2">
                                        @{{infoResa.depName}} - @{{infoResa.arrName}}
                                    </div>
                                    <div class="col-6 ">
                                        @{{timeConvert(infoResa.transferTime)}}
                                    </div>
                                    <div class="col-6 ">
                                        @{{convertMoney(infoResa.lowPrice)}} - @{{convertMoney(infoResa.highPrice)}}
                                    </div>
                                    <div class="col-12 middleblue-border remove-house-borders pb-2"></div>
                                    <!--<p>@{{infoResa}}</p>-->
                                </div>
                                <div align="right">
                                <button ng-click="saveLocal()" class="btn col-4 btn-success mt-2">Spara Resa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="p-3" align="center">
            <button ng-click="closeResult()" class="btn btn-danger col-6  pointer">Stäng</button>
        </div>  
    </div>


    <!-- GAMMAL 
    <div ng-show="isResultOpen" class="container mt-4 table-responsive-sm pale-grey-bg nopadding">
            <table class="container table ">
                <thead class="lightblue-bg">
                    <th ng-click="sortBy('name')"><h5>Färdmedel<h5></th>
                    <th ng-click="sortBy('totalDuration')"><h5>Tid</h5></th>
                    <th ng-click="sortBy('indicativePrices[0].priceLow')"><h5>Pris</h5></th>
                    <th>
                        <h5>Valutan</h5>
                        <select class="form-control" ng-model="choosenCurrency">
                            <option value="EUR">EUR</option>
                            <option value="SEK">SEK</option>
                            <option value="USD">USD</option>
                        </select>
                    </th>
                </thead>
          
                <tr id="search-row" class="pointer middleblue-col" ng-repeat="route in info.routes | orderBy: propertyName : reverse">
                    <td>@{{route.name}}</td>
                    <td>@{{timeConvert(route.totalDuration)}}</td>
                    <td>@{{convertMoney(route.indicativePrices[0].priceLow)}} - @{{convertMoney(route.indicativePrices[0].priceHigh)}}</td>
                    <td align="center">
                        <button class="btn pointer" ng-click="getDetails($index)" data-toggle="modal" data-target="#myModal">Detaljer</button>
                    </td>
                </tr>
            </table>
            <div class="pb-4" align="center">
                <button ng-click="closeResult()" class="btn btn-danger col-md-6 col-sm-12  pointer">Stäng</button>
            </div>
        </div>
       --> 
        