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
    <body ng-app="myApp" ng-controller="ShareCtrl" class="imgBG">
        @include('includes.navbar')
        <div class="container">
               
                <div  class="container">
                        <div class="p-3 middleblue-bg white-col shadow-bg rounded mt-3"><h2 class="text-center">Din resa till OS</h2></div>
                        <div class="col-12 middleblue-col even-paler-grey-bg shadow-bg mb-4 mt-3 rounded">
                                <div  class="row">                                    
                                        <!-- Skriver ut delarna i resrutt -->
                                        <div class="col-12 ">
                                        <div class="row">   
                                                <div class="col-12 middleblue-bg white-col pt-3 pb-2 ">
                                                <h4>@{{headline}}</h4>  
                                                </div>    
                                                <div class="row middleblue-border remove-house-borders px-4" ng-repeat="test in shareOut">
                                                        <div class="col-12 pb-2 pt-2">
                                                                
                                                        <h1>  @{{test.depName}} - @{{test.arrName}}</h1>
                                                        </div>
                                                        <div class="col-6 pb-2">
                                                                @{{timeConvert(test.transferTime)}}
                                                        </div>
                                                        <div class="col-6 pb-2">
                                                                @{{test.lowTotalPrice}} - @{{test.highTotalPrice}}
                                                        </div>
                                                </div>
                                        </div>
                                        </div>
                                </div>
                        </div>
            </div>
        </div>
    <!-- Footer -->
    @include('includes.footer')

    <script>

                app.controller('ShareCtrl', function ($scope) {

                var sites = {!! json_encode($sharepost->toArray()) !!};


                //Byter ut adressen så att den får rätt format med id-nummer i slutet, 
                //så att den kan hämta info från databasen.
                window.history.replaceState(null, null, "/share/"+sites.id);
                var obj2 = sites.body.toString();
                var objOut = JSON.parse(obj2);
                $scope.shareOut = objOut;
                $scope.headline = objOut[0].routeName;
              

                $scope.timeConvert = function (data) {
                        var minutes = data % 60;
                        var hours = (data - minutes) / 60;

                        var result;

                        if (hours == 0) {
                        result = minutes + " min";
                        }
                        else {
                        result = hours + "h" + " " + minutes + "min";
                        }
                        return result;
                }

      
        });


            </script>
    </body>
</html>