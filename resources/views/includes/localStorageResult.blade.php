
        <div ng-show="localShow" class="container">
            <div style="color: #006699" class="col-12 even-paler-grey-bg py-2  mt-3 ">
                <div id="" class="row">
                    <!--<div ng-bind-html="localMap" class="col-12 col-lg-6 "></div>-->
                    <div id="localGoogleMap" class="googleMap"></div>
                    <!-- Skriver ut delarna i resrutt -->
                    <div class="col-12 col-lg-6 ">
                        <div class="row" ng-repeat="test in localInfo">
                            <div class="col-12 pb-2 pt-2">
                                @{{test.routeName}}
                            </div>
                            <div class="col-12 pb-2 pt-2">
                                @{{test.depName}} - @{{test.arrName}}
                            </div>
                            <div class="col-6 ">
                                @{{timeConvert(test.transferTime)}}
                            </div>
                            <div class="col-6 ">
                                @{{convertMoney(test.lowPrice)}} - @{{convertMoney(test.highPrice)}}
                            </div>
                        </div>
                    </div>
                </div>
                <div align="center">
                    <button ng-click="localShow=false" class="btn btn-danger m-2 col-6 pointer">Stäng</button>
                </div>
            </div>
        </div>