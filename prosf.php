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

<!--Το integrity προσδιορίζει την ακεραιότητα του αρχείου, ενώ το crossorigin διασφαλίζει ότι το CSS θα φορτωθεί με ασφάλεια από τον διακομιστή.--> 

<!-- Αυτό το τμήμα HTML δημιουργεί έναν πίνακα όπου θα εμφανιστούν οι προσφορές.-->
<div class="row">
<div class="col-md-8">
    <h2>Προσφορές</h2>
    <table class="table" style='width:100%'> <!--Ο πίνακας (<table>) έχει κλάση table του Bootstrap για τη βελτιστοποίηση της εμφάνισης. -->
    <tr><th>Ημερομηνία</th><th>Αντικείμενο</th><th>Αρ.Ατόμων</th><th>Κατάσταση</th></tr>
    

            <tbody id=data> <!--μέρος του πίνακα που θα γεμίσει δυναμικά με δεδομένα-->


            </tbody>
    
    </table>
</div>

</div>

<br><br><br><br><br><br>
<script>
   

   


    function show_all()
    {
        $.getJSON("phpcode.php?proc=14",(res)=>{
            $("#data").html(""); //// Καθαρίζει το υπάρχον περιεχόμενο του πίνακα
            
            res.forEach((e)=>{
                //// Προσθέτει κάθε εγγραφή στον πίνακα ως νέα γραμμή
                $("#data").append(`<tr><td>${e.date}</td><td>${e.name}</td><td>${e.posotita}</td><td>${e.state}</td></tr>`)
                //Για κάθε προσφορά, προστίθεται μια νέα γραμμή στον πίνακα με τη μέθοδο append(), περιλαμβάνοντας τα πεδία: Ημερομηνία (e.date),Όνομα Αντικειμένου (e.name),Ποσότητα (e.posotita),Κατάσταση (e.state)

            })
        })


    }


    show_all(); //EMFANISH PROSFORWN


</script>

</body>
</html>