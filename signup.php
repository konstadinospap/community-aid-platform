<!DOCTYPE html>
<html lang="en">
<head>
  <title>Project WEB 2023-2024</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="my.css">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

     <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
</head>
<body>
<div class="jumbotron text-center myjb">
  <h1>Πλατφόρμα Βοήθειας</h1>
  
  
</div>
<!--Μέσα σε αυτό το container υπάρχει μια φόρμα εγγραφής με το ID frmreg και έναν τίτλο "Εγγραφή Χρήστη".--> 
<div class="container" style="display: flex; justify-content: center; align-items: center;">
    <div class="frm1">
        <form id="frmreg">
              <h3>Εγγραφή Χρήστη</h3>

              <div class="row">
              <div class="col-sm-6">
            
                <div class="form-group">
                    <label for="onoma">Όνοματεπώνυμο:</label>
                    <input type="text" class="form-control" id="onoma" name="onoma" required>
                  </div>

                <div class="form-group">
                  <label for="email">email:</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="onoma">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                  </div>

                  <div class="form-group">
                    <label for="username2">Username:</label>
                    <input type="text" class="form-control" id="username2" name="username2" required>
                  </div>

                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd2" name="pwd2" required>
                </div>

                </div>
                <div class="col-sm-6">
                <div id="map" class="mymap"></div>
                  <div class="form-group">
                 
                    <input type="hidden" class="form-control" id="x" name="x" step="any" value='38.2256455763377' required>
                  </div>

                  <div class="form-group">
                   
                    <input type="hidden" class="form-control" id="y" name="y" step="any" value='21.748469066436105' required>
                  </div>

               
                <div id="notification" style="text-align:center;"></div>
            </div>
                
            <!--Ένα κουμπί για την υποβολή της φόρμας και ένα κουμπί για επιστροφή στη σελίδα σύνδεσης (με τη λειτουργία logpage()).--> 
            <div id="backbtn">
                <button type="submit" id="signbtn" class="btn btn-default">Submit</button>
                <button onclick="logpage()" id="signbtn" class="btn btn-default">Back</button>
            </div>
          </form>
    </div>
</div>


<!--Δημιουργεί έναν χάρτη Leaflet με αρχικές συντεταγμένες (38.2256, 21.7484) και προσθέτει ένα marker (δείκτη) σε αυτή τη θέση.--> 
<script>
var map = L.map('map').setView([38.2256455763377, 21.748469066436105], 14);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var marker = L.marker([38.2256455763377, 21.748469066436105]).addTo(map);




//Όταν ο χρήστης κάνει κλικ στον χάρτη, αφαιρεί τον παλιό marker και προσθέτει έναν νέο στη νέα θέση, ενημερώνοντας τα κρυφά πεδία x και y με τις νέες συντεταγμένες.
map.on("click", (e)=>{
 

  map.removeLayer(marker);
  marker = L.marker(e.latlng).addTo(map);
  $("#x").val(e.latlng.lat);
  $("#y").val(e.latlng.lng);
});






    $("#frmreg").submit(()=>{
       event.preventDefault();
        $.post("phpcode.php?proc=1", $("#frmreg").serialize(),(res)=>{
            if(res=="1")
            {
              $("#notification").html(`<div class="alert alert-success">
                <strong>Η εγγραφή σας ολοκληρώθηκε!</strong></div>`)
            }
            else
            {
              $("#notification").html(`<div class="alert alert-danger">
                    <strong>H εγγραφή απέτυχε</strong></div>`);
            }

        });

    })





    //Η λειτουργία logpage() ανακατευθύνει τον χρήστη πίσω στη σελίδα σύνδεσης (index.php).
    function logpage(){
        window.location.href="index.php";
    }
</script>

    
</body>