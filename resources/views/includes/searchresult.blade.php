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
        <button ng-click="closeResult()" class="btn btn-danger col-md-6 col-sm-12 btn-block pointer">Stäng</button>
    </div>
</div>

