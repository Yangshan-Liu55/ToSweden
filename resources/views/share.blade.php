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
    <body ng-app="myApp" ng-controller="ShareCtrl">
            @include('includes.navbar')
            <div class="container">
                <div class="p-3"><h2>Din resa till OS</h2></div>

       
                <div  class="container">

                                <div style="color: #006699" class="col-12 even-paler-grey-bg py-2  mt-3 ">
                                    <div class="row">
                                        <div class="col-4">Resnam</div>
                                        <div class="col-4">Pris</div>
                                        <div class="col-4">Tid</div>
                                    </div>
                                    <div id="" class="row">
                                      
                                        <!-- Skriver ut delarna i resrutt -->
                                        <div class="col-12 col-lg-6 ">
                                                      
                                            <div class="row" ng-repeat="test in shareOut">
                                                <div class="col-12 pb-2 pt-2">
                                                                @{{test.routeName}}
                                                    @{{test.depName}} - @{{test.arrName}}
                                                </div>
                                                <div class="col-6 ">
                                                    @{{timeConvert(test.transferTime)}}
                                                </div>
                                                <div class="col-6 ">
                                                    @{{test.shareLowPrice}} - @{{test.shareHighPrice}}
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

                console.log("sites: "+sites)

                //Byter ut adressen så att den får rätt format med id-nummer i slutet, 
                //så att den kan hämta info från databasen.
                window.history.replaceState(null, null, "/share/"+sites.id);
                var obj2 = sites.body.toString();
                var objOut = JSON.parse(obj2);
                $scope.shareOut = objOut;

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
               








     
           /*
            //Hämtar den genererade json från shareroutesController function store
            var sites = {!! json_encode($sharepost->toArray()) !!};

            console.log("sites: "+sites)
            
            //Byter ut adressen så att den får rätt format med id-nummer i slutet, 
            //så att den kan hämta info från databasen.
            window.history.replaceState(null, null, "/share/"+sites.id);
            var obj2 = sites.body.toString();
            var objOut = JSON.parse(obj2);
            $scope.shareOut = objOut;
            //obj2 = '{"getroute": '+obj2 +"}";
           console.log("objOut: "+objOut)
           console.log(objOut.routeName);
       

          
           // console.log("objOut "+objOut.routeName)
           console.log("objOut.getroute.length "+objOut.getroute.length);
        let resultOut="<div class='row'>";
        resultOut+="<div class='col-12 p-3'><h1>"+objOut.getroute[0].routeName[0]+"</h1></div>";
        resultOut+="<div class='col-12 pb-3'><iframe class='img-thumbnail' width='100%' height='400px' frameborder='0' style='border:0'  src='" + objOut.getroute[0].googleSrc + "' allowfullscreen></iframe></div>";  
        for (x=0;x<objOut.getroute.length;x++)
        {
            resultOut+="<div class='col-12 p-2 middleblue-border remove-house-borders'>"+objOut.getroute[x].depName+" - "+objOut.getroute[x].arrName+"</div>";
        }
      
        resultOut+="<div class='col-6 py-3 mt-2 white-col lightblue-bg'>Total restid: "+objOut.getroute[0].totalTravelTime+"</div>";
        resultOut+="<div class='col-6 py-3 mt-2 white-col lightblue-bg'>Total summa: "+objOut.getroute[0].highTotalPrice+"</div>";
        resultatOut="</div>";
        console.log("resultOut "+ resultOut)
       document.getElementById("routeOut").innerHTML = resultOut;

       */
            </script>
    </body>
</html>