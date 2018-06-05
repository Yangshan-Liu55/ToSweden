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

<body ng-app="myApp" ng-controller="searchCtrl" class="imgBG">
    @include('includes.navbar')

    <!-- NAVIGATION -->
    <div id="homeimage">
        <div id="home-welcome">
            <div id="home-welcome-center">
                <img src="/img/skrivstil/welcome.png">

                <!-- SÖK RESA -->
                <div class="test searchFieldBG" ng-init="changeCurrency()">
                    <div class="p-1 searchField container">
                        <div id="navbar">
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
                                            <option value="Falun">Falun</option>
                                            <option value="Åre">Åre</option>
                                        </select>
                                        <div id="button-row">

                                            <button ng-click="search()" type="submit" class="btn btn-lg mt-3">SÖK</button>
                                            <button ng-click="loadLocal()" class="btn btn-lg mt-3">Sparad Resa</button>

                                            <!-- Modal för OS-SCHEMA -->
                                           
                                                <button class="left m-2 test56" id="osschema-knapp" data-toggle="modal" data-target="#eventsModal">
                                                 <i class=" far fa-calendar-alt"></i>
                                                </button>
                                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- SLUT på SÖK RESA -->

                </div>
            </div>
        </div>

        <p id="warning"></p>
        <!-- START på visa SPARAD DATA -->
        @include('includes.localStorageResult')
        <!-- SLUT på visa SPARAD DATA -->
        <!-- 
    visar URL eller FEL meddelande 
    <p id="apiUrl"></p>
    -->
        <!-- START, visa RESULTATET vid respons från server -->
        @include('includes.searchresult')

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
        <div class="footerpositon">
            @include('includes.footer')
        </div>

</body>

</html>