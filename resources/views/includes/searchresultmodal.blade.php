 <!-- The Modal för att visa Resor -->
 <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">@{{routeName}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <table class="table table-hover">
                    <thead class="thead">
                        <th>Plats</th>
                        <th>Tid</th>
                        <th>Pris</th>
                    </thead>
                    <tr ng-repeat="infoResa in travelInfo">
                        <td>@{{infoResa.depName}} - @{{infoResa.arrName}}</td>
                        <td>@{{timeConvert(infoResa.transferTime)}}</td>
                        <td>@{{convertMoney(infoResa.lowPrice)}} - @{{convertMoney(infoResa.highPrice)}}</td>
                    </tr>
                </table>
                <iframe id="googleMap" width="100%" height="300" frameborder="0" style="border:0" src="" allowfullscreen>
                </iframe>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Stäng</button>
            </div>
        </div>
    </div>
</div>
 <!-- SLUT på Modal RESULTATET-->