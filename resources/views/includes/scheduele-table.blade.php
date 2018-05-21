<div ng-controller="selectTabs">
        <!-- Attention! Special breaks. Do not re-format! -->
        <button type="button" id="menuSelect" class=" btn pointer btn-primary leftBtn " ng-click="click(1)">Stockholm</button
        ><button type="button" class="btn pointer btn-primary middleBtn " ng-click="click(2)">Falun</button
        ><button type="button" class="btn pointer btn-primary rightBtn" ng-click="click(3)" >Åre</button>
    
<!-- Filter för att plocka ut rätt sporter till rätt städer -->
<!-- Loopar igenom alla Städer -->
<div ng-controller="CitiesCtrl">
        <!-- Val av stad -->
        <div ng-repeat="city in cities | filter:{ id: tabOut }">
        <div id="schedule-thead" class="thead p-3">
            <h5>@{{city.cities_name}}</h5>
        </div>
        <div ng-controller="sportsCtrl">
            <!-- Loopar igenom alla Sporter -->
            <div class="eventsHeader schedule-sports-bg " ng-if="sport.sports_cities_id==city.id" ng-repeat="sport in sports">
                <div id="schedule-row" class="row p-1">
                    <div class="col">
                        <div class="p-2">
                            <img class="schedule-picto" ng-src="/img/pictogram/neg/@{{sport.sports_img}}">
                        </div>
                    </div>
                    <div id="schedule-sports-name" class="col-9">
                        <h6>@{{sport.sports_name_swe}}</h6>
                    </div>
                </div>

                <!-- Loopar igenom Sportschema -->
                <div class="eventsBody schedule-days-bg " ng-controller="allEvents">
                    <div class="schedule-days-border" ng-if="event.events_sports_id==sport.id" ng-repeat="event in allEvents">
                        <div class="row  p-3">

                            <!-- Kontrollerar medaljstatus -->
                            <div class="col" ng-if="event.events_status==1">
                                <img class="schedule-picto" src="/img/pictogram/pos/day.png">
                            </div>
                            <div class="col" ng-if="event.events_status==2">
                                <img class="schedule-picto" src="/img/pictogram/pos/medal.png">
                            </div>
                            <div class="col-9">
                                <div class="schedule-sports-name py-2">
                                    <h6>@{{event.events_cities_day_swe}} @{{event.events_date}}/2</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- SLUT Filter för schema -->