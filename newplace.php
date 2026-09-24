<?php
include "head.php";

?>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>


<h1>Αλλαγή Θέσης </h1>

Θέση διασώστη:
<form id=frm1>

            Lat:<input type='number' size=6 name=x step=any id=xx value="38.25470" size=6> -
            Lng:<input type='number' size=6 name=y step=any id=yy value="21.740971" size=6>
</form>

<div id="map" style="width:100%; height:500px"></div>

<script>

    var markerd;
    var map;
    var station;
$.getJSON("phpcode.php?proc=100",(res)=>{

    station=res.station;
    aitimata=res.aitimata;
    prosfores=res.prosfores;
    diasostes=res.diasostes;


    var stationicon = L.icon({
    iconUrl: 'https://maps.google.com/mapfiles/kml/shapes/schools.png',
    iconSize:     [40, 40], // size of the icon
   
});

   
var diasostisicon = L.icon({
    iconUrl: 'https://maps.google.com/mapfiles/kml/shapes/motorcycling.png',
    iconSize:     [40, 40], // size of the icon
   
});
       
var aitimaicon = L.icon({
    iconUrl: 'https://maps.google.com/mapfiles/kml/shapes/caution.png',
    iconSize:     [40, 40], // size of the icon
   
});
   



    map = L.map('map').setView([station.x, station.y], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([station.x, station.y], {icon: stationicon }).addTo(map);

   
                 
    markerd = L.marker([diasostes[0].x, diasostes[0].y], {icon: diasostisicon}).addTo(map);

    $("#xx").val(diasostes[0].x);
    $("#yy").val(diasostes[0].y);           

 
    map.on("click",changeMarker);


    
})


function changeMarker(e)
{
    var diasostisicon = L.icon({
    iconUrl: 'https://maps.google.com/mapfiles/kml/shapes/motorcycling.png',
    iconSize:     [40, 40], // size of the icon
   
    });


    map.removeLayer(markerd);
    markerd = L.marker(e.latlng, {icon: diasostisicon }).addTo(map);
   
    $("#xx").val(e.latlng.lat);
    $("#yy").val(e.latlng.lng);
    
    $.post("phpcode.php?proc=3",{lat:e.latlng.lat,lng:e.latlng.lng},(res)=>{

    })

}

</script>


</body>
</html>


</body>
</html>