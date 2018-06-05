
        <div ng-show="localShow" class="container p-0">
            <div class="col-12 even-paler-grey-bg middleblue-col p-4  mt-3 ">
                <div id="" class="row px-2">
                    <div id="localGoogleMap" class="googleMap"></div>
                    <!-- Skriver ut delarna i resrutt -->
                    <div class="col-12 col-lg-6 ">
                        <div class="row middleblue-border remove-house-borders" ng-repeat="test in localInfo">
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
                <div align="center" class="mt-4">
                    <button ng-click="localShow=false" class="btn btn-danger  col-6 pointer">Stäng</button>
                </div>
            </div>
        </div>