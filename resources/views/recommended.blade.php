<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    @include('includes.title')

    <!-- Styles and Scripts -->
    @include('includes.stylesscripts')

    </head>
    <body ng-app="myApp" ng-controller="allToDo">
            @include('includes.navbar')
        <div class="position-ref full-height">
            
            <div class="content">
                
                <h1>Recommended</h1>

                <div ng-repeat="todo in allToDo">
                    <a href="../2Sweden/city.html?nr=@{{city.id}}">
                    <div class="row row-wrap">
                      <div class="col col-12 col-md-4">
                        <img ng-src="@{{todo.todo_img01}}" alt="City" weight="75px" height="75px">
                      </div>
                      <div class="col col-12 col-md-2">
                           <h3> @{{todo.todo_cities_name}}</h3>
                      </div>
                      <div class="col col-12 col-md-6"  >
                        <span>@{{todo.todo_text|limitTo:100}}...</span>
                    </div>
                  </div>
                </a>
                     <hr>
                </div>

            </div>
        </div>


    </body>
</html>
