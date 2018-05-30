
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

<body ng-app="myApp" class="imgBG">
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
                                <button ng-click="search()" type="submit" class="btn btn-lg mt-3">Sök resa</button>
                                <button ng-click="loadLocal()" class="btn btn-lg mt-3">Sparad resa</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- SLUT på SÖK RESA -->
        <p id="warning"></p>
        <div ng-show="localShow" class="container">

            <div style="color: #006699" class="col-12 even-paler-grey-bg py-2  mt-3 ">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4 pb-2 pt-2">
                                Resnamn: @{{localName}}
                            </div>
                            <div class="col-4 pb-2 pt-2">
                                Totalt pris: @{{localLowPrice}} - @{{localHighPrice}}
                            </div>
                            <div class="col-4 pb-2 pt-2">
                                Total restid: @{{localTotalTime}}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="" class="row">
                    <div ng-bind-html="localMap" class="col-12 col-lg-6 "></div>
                    <!-- Skriver ut delarna i resrutt -->
                    <div class="col-12 col-lg-6 ">
                        <div class="row" ng-repeat="test in localInfo">
                            <div class="col-12 pb-2 pt-2">
                               @{{test.depName}} - @{{test.arrName}}
                            </div>
                            <div class="col-6 ">
                                @{{timeConvert(test.transferTime)}}
                            </div>
                            <div class="col-6 ">
                                @{{convertMoney(test.lowPrice)}} - @{{convertMoney(test.highPrice)}}
                            </div>
                            <div class="col-12 middleblue-border remove-house-borders pb-2"></div>
                        </div>
                    </div>
                </div>
                <div align="center">
                    <button ng-click="localShow=false" class="btn btn-danger mt-2 col-6 pointer">Stäng</button>
                </div>
            </div>
        </div>
        <!-- 
    visar URL eller FEL meddelande 
    <p id="apiUrl"></p>
    -->
        <!-- START, visa RESULTATET vid respons från server -->
        @include('includes.searchresult')


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