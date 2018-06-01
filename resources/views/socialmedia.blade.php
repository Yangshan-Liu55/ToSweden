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
    <body ng-app="myApp" >
            @include('includes.navbar')
            <div class="container mt-4 mb-4 table-responsive-sm pale-grey-bg middleblue-col">
                <div class="col-12 pt-3 "><h2 class="text-center">Din resa till OS</h2></div>

                <div id="routeOut" class="p-4"></div>


                <div >
                   <!-- <h1>ResID:  {{$sharepost->id}}</h1> -->
                </div>
       
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

      // console.log("obj2: "+obj2);
     //   obj2 = obj2.replace('},{','},{');
  
    //   obj = obj.replace('\\','');
    //    console.log("obj "+obj)

      var objOut = JSON.parse(obj2);
       // console.log("objOut "+objOut.routeName)
    //   console.log("objOut.getroute.length "+objOut.getroute.length);
    let resultOut="<div class='row'>";
            resultOut+="<div class='col-12 p-3'><h1>"+objOut.getroute[0].routeName+"</h1></div>";
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



        </script>
    </body>
</html>
