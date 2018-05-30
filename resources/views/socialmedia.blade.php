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
    <body ng-app="myApp" ng-controller="HotelsCtrl">
            @include('includes.navbar')
            <div class="container">
                <div class="p-3"><h2>Din resa till OS</h2></div>
                <div class="p-2">
                    <h1>ResID:  {{$sharepost->id}}</h1>
                </div>
                <div class="p-2">
                <!--     Resväg: <BR>  {{$sharepost->saveroutes_travelInfo}} -->
                </div>
       
       <div id="demo" class="p-4"></div>
            </div>
    <!-- Footer -->
    @include('includes.footer')

@php

@endphp

    <script>
        //Hämtar den genererade json från shareroutesController function store
        var sites = {!! json_encode($sharepost->toArray()) !!};
        
        //Byter ut adressen så att den får rätt format med id-nummer i slutet, 
        //så att den kan hämta info från databasen.
        window.history.replaceState(null, null, "/socialmedia/"+sites.id);

        var obj2 = sites.saveroutes_travelInfo.toString();
       
       //obj = obj.replace('[','');obj = obj.replace(']','');
     

    //  obj2 = obj2.substring(0, obj2.length - 1)
    //  obj2 = obj2.substring(1);

    obj2 = '{"getroute": '+obj2 +"}";

       console.log("obj2: "+obj2)
     //   obj2 = obj2.replace('},{','},{');
  
    //   obj = obj.replace('\\','');
    //    console.log("obj "+obj)

      var objOut = JSON.parse(obj2);
       // console.log("objOut "+objOut.routeName)
   document.getElementById("demo").innerHTML = objOut.getroute[0].depName +" -> "+objOut.getroute[1].depName;



        </script>
    </body>
</html>
