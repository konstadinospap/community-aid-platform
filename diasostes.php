<?php
include "head.php";

?>

<!-- βιβλιοθήκη για χάρτες -->
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

<h1>Προσθήκη διασώστη</h1>
<div class="row">
<div class="col-md-8">
    <!-- πίνακας διασωστών -->
    <table class="table table-striped" style='width:100%'>
        <thead>
            <tr><th>Username</th><th>Password</th><th>x</th><th>y</th><th>Action</th></tr>
        
            <form id=formdias>
            <tr>
                <td><input type='text' name=usr size=6></td>
                <td><input type='password' size=6 name=pwd></td>
                <td><input type='number' size=6 name=x step=any id=xx value="38.25470" size=6></td>
                <td><input type='number' size=6 name=y step=any id=yy value="21.740971" size=6></td>
                <td><button id="modalbtn" type="submit">+</button></td></tr> <!--Το κουμπί υποβολής "+" αποστέλλει τα δεδομένα της φόρμας για την προσθήκη του διασώστη.--> 
        </thead>
        <!-- τα στοιχεία των διασωστών -->
            <tbody id=data>


            </tbody>
    </form>
    </table>
</div>
<div class=col-md-4>
    <!-- η περιοχή του χάρτη -->
    <div id=map style="width:100%; height:300px;"></div>
</div>
</div>

<br><br><br><br><br><br>
<script>

var map = L.map('map').setView([38.2547053128223, 21.740971461949773], 13);
//Δημιουργεί έναν χάρτη με χρήση της βιβλιοθήκης Leaflet, κεντραρισμένο στις συντεταγμένες (38.2547, 21.74097), με επίπεδο zoom 13.

// το στοιχείο αυτό δείχνει ότι θα χρησιμοοιήσουμε πολιτικό χάρτη
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
//Φορτώνεται το πλαίσιο του χάρτη (tile layer) από το OpenStreetMap. Το μέγιστο zoom είναι 19 και το attribution προσθέτει τα πνευματικά δικαιώματα του χάρτη.

var marker = L.marker([38.2547053128223, 21.740971461949773]).addTo(map);
//Προστίθεται ένας δείκτης (marker) στη θέση (38.2547, 21.74097).


// ο χάρτης. Οταν πατάμε κλικ πάμε στο changeMarker
map.on("click",changeMarker);
//Καθορίζει ότι κάθε φορά που ο χρήστης κάνει κλικ στον χάρτη, θα καλείται η συνάρτηση changeMarker.

function changeMarker(e)
{
    
    map.removeLayer(marker); //Αφαιρεί τον προηγούμενο δείκτη από τον χάρτη.
    marker = L.marker(e.latlng).addTo(map);//Προσθέτει έναν νέο δείκτη στη θέση του κλικ (e.latlng).
    $("#xx").val(e.latlng.lat);
    $("#yy").val(e.latlng.lng); //Ενημερώνει τα πεδία της φόρμας xx (latitude) και yy (longitude) με τις νέες συντεταγμένες.
    

}
    
    // τα στοιχεία του διασώστη στέλνονται στο backend
    $("#formdias").submit(()=>{
        event.preventDefault();

        $.post("phpcode.php?proc=3",$("#formdias").serialize(),(res)=>{
            if(res==1){
                alert("Ο διασώστης προστέθηκε");
                show_all();
            }
            else
            {
                alert("Ο διασώστης δεν προστέθηκε !!");
            }
        });


    })
    
    // εμφανίζουνται ολοι οι διασώστες
    function show_all()
    {
        $.getJSON("phpcode.php?proc=4",(res)=>{
            $("#data").html("");
            
            res.forEach((e)=>{
                $("#data").append(`<tr><td>${e.username}</td><td></td><td>${e.x}</td><td>${e.y}</td>
                <td><button id="modalbtn" onclick="dels(${e.id})">Del</button></td></tr>`)
            })
        })
        //Η συνάρτηση show_all καλεί τη σελίδα phpcode.php με παράμετρο proc=4 για να λάβει όλους τους διασώστες σε μορφή JSON.
        //Για κάθε διασώστη (e), προστίθεται μια νέα σειρά στον πίνακα που δείχνει το username, τις συντεταγμένες x, y, και ένα κουμπί διαγραφής (Del).


    }

    function dels(id)
    {
        $.post("phpcode.php?proc=5", {"id":id}, (res)=>{
            //Η συνάρτηση dels(id) στέλνει ένα αίτημα POST στο phpcode.php με παράμετρο proc=5 και το id του διασώστη που θα διαγραφεί.
            show_all();
        })
    }

    show_all();
    //Κατά την αρχική φόρτωση της σελίδας, η show_all() καλείται για να εμφανιστούν οι υπάρχοντες διασώστες.


</script>

</body>
</html>