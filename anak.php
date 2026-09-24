<?php
include "head.php";

?>


<div class="row">
<div class="col-md-12"> <!--Δημιουργεί ένα container με Bootstrap grid (row), το οποίο περιλαμβάνει μία στήλη (col-md-12) που καταλαμβάνει όλο το πλάτος της σελίδας (12 στήλες από το σύστημα grid). -->
    <h2>Ανακοινώσεις</h2>
    <table class="table table-striped" style='width:100%'>
        <thead>
            <tr><th>Ημερομηνία</th><th>Τίτλος</th><th>Περιγραφή</th><th>Αντικείμενα</th><th>Action</th></tr>
        </thead> <!--Δημιουργεί έναν πίνακα με κλάση table table-striped, που εφαρμόζει στυλ από το Bootstrap και κάνει τον πίνακα διακριτά οριζόντια ριγέ. Ο πίνακας έχει επικεφαλίδες για ημερομηνία, τίτλο, περιγραφή, αντικείμενα, και ενέργειες.-->

            <tbody id=data>


            </tbody> <!--Το <tbody> είναι το κενό σώμα του πίνακα όπου τα δεδομένα θα τοποθετηθούν δυναμικά μέσω JavaScript (με το ID data).--> 
    
    </table>
</div>

</div>

<br><br><br><br><br><br> <!--κενά διαστήματα (<br>) για την εισαγωγή χώρου κάτω από τον πίνακα.-->

<!-- Modal δημιουργια παραθυρου modal-->
<div id="myModal" class="modal fade" role="dialog"> <!--δημιουργεί το modal παράθυρο. id="myModal" ορίζει ένα μοναδικό αναγνωριστικό για το modal.Η κλάση modal του Bootstrap εφαρμόζει το styling και τη συμπεριφορά του modal.Η κλάση fade προσθέτει εφέ σταδιακής εμφάνισης/εξαφάνισης του modal--> 
  <div class="modal-dialog"> <!--κλάση modal-dialog του Bootstrap--> 

    <!-- Modal content perixomeno modal-->
    <div class="modal-content"> <!--Το <div class="modal-content"> περιέχει το πραγματικό περιεχόμενο του modal-->
      <div class="modal-header"> <!--ορίζει την κεφαλίδα του modal--> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- Το <button type="button" class="close" data-dismiss="modal">&times;</button> δημιουργεί ένα κουμπί για το κλείσιμο του modal. Το σύμβολο &times; αντιστοιχεί στο "×", το εικονίδιο για κλείσιμο. Το data-dismiss="modal" δηλώνει ότι αυτό το κουμπί θα κλείσει το modal όταν πατηθεί.-->
        <h4 class="modal-title">Προσφορά</h4>
      </div>
      <div class="modal-body"> <!--περιέχει το κύριο περιεχόμενο του modal, δηλαδή τη φόρμα.-->
        <form id=frm10> <!--είναι η φόρμα με ID frm10, η οποία θα υποβληθεί όταν ο χρήστης κάνει μια προσφορά.-->
            <table>
                <!-- δημιουργια δυο πεδίων item (me select box, me id itemp) και ποσοτητα με πεδιο εισαγωγης type number-->
                <tr><td style="text-align:right;">Item: </td>
                <td><select id=itemp name=itemp>


                </select>
                </td></tr>
                <tr><td>Ποσότητα: </td><td><input id="posot" type=number name=posotita></td></tr>
                <input type=hidden name=anakoinosi id=anakoinosi> <!--krymmeno pedio. θα αποθηκεύει το ID της ανακοίνωσης στην οποία αναφέρεται η προσφορά και θα χρησιμοποιηθεί όταν η φόρμα υποβληθεί. -->
                <tr><td></td><td><input type=submit id="modalbtn" value="Στείλε την προσφορά"></td></tr>
            </table>
        </form>
      </div>
      <div class="modal-footer"> <!--περιέχει το footer του modal.-->
        <button type="button" id="modalbtn" class="btn btn-default" data-dismiss="modal">Close</button> <!--Το κουμπί με ID modalbtn, κλάση btn btn-default και data-dismiss="modal" κλείνει το modal όταν πατηθεί.-->
      </div>
    </div>

  </div>
</div>


<script>
    let antik;
    $.getJSON("phpcode.php?proc=11", (res)=>{ //Στέλνει ένα αίτημα GET στο phpcode.php?proc=11 και περιμένει απόκριση σε μορφή JSON.
        antik=res;
        for(i=0;i<res.length;i++) 
        {
            $("#items").append(`<option value=${i}>${res[i].name}</option>`);
        }
    }); //Αποθηκεύει την απάντηση στη μεταβλητή antik και επαναλαμβάνει κάθε αντικείμενο της λίστας res, προσθέτοντάς το ως επιλογή (<option>) στο drop-down με ID items (πιθανώς ένα αντικείμενο που λείπει από το τρέχον HTML).



    


    function show_all() //Δημιουργείται μια συνάρτηση με το όνομα show_all(), η οποία καλείται για να εμφανίσει όλες τις ανακοινώσεις.
    {
        $.getJSON("phpcode.php?proc=11",(res)=>{ //Η συνάρτηση show_all() στέλνει αίτημα GET στο phpcode.php?proc=11 για να πάρει όλες τις ανακοινώσεις.
            $("#data").html(""); //καθαριζει το πινακα
            
            res.forEach((e)=>{ //Η μέθοδος forEach() επαναλαμβάνεται για κάθε εγγραφή (ανακοίνωση) που περιέχεται στη μεταβλητή res. Κάθε εγγραφή αποθηκεύεται προσωρινά στη μεταβλητή e και περιέχει τα πεδία της ανακοίνωσης.
                $("#data").append(`<tr><td>${e.date}</td><td>${e.title}</td><td>${e.description}</td><td>${e.items}</td>
                <td><button data-toggle="modal" id="modalbtn" data-target="#myModal" onclick='prosfora(${e.id})'>Προσφορά</button></td>
                
                </tr>`) //Για κάθε εγγραφή e, προστίθεται μια νέα γραμμή (<tr>) στον πίνακα με τα δεδομένα της(ημερομηνια, τιτλος,περιγραφη,αντικειμενα).
                //δημιουργεί ένα κουμπί "Προσφορά" που ανοίγει το modal και καλεί τη συνάρτηση prosfora() με το ID της ανακοίνωσης.
            })
        })


    }


    show_all(); //Καλεί τη συνάρτηση show_all() όταν φορτώνεται η σελίδα για να εμφανιστούν όλες οι ανακοινώσεις στον πίνακα.


    function prosfora(id)
    {
        

            $.getJSON("phpcode.php?proc=12&id="+id,(res)=>{ //Η συνάρτηση prosfora(id) στέλνει αίτημα GET στο phpcode.php?proc=12&id=, όπου το id είναι το ID της ανακοίνωσης που επιλέχθηκε.
                $("#itemp").html(""); // Καθαρίζει το περιεχόμενο του drop-down με ID itemp, το οποίο πιθανότατα περιέχει τα αντικείμενα που σχετίζονται με την επιλεγμένη ανακοίνωση.
                res.forEach((e)=>{
                    $("#itemp").append(`<option value='${e.item}'>${e.name}</option>`); //Καθαρίζει το drop-down με ID itemp και προσθέτει τις επιλογές αντικειμένων από την απόκριση.
                });
            })

            $("#anakoinosi").val(id); // Θέτει το ID της ανακοίνωσης στο κρυφό πεδίο

    }


    

    $("#frm10").submit(()=>{
        event.preventDefault();

        $.post("phpcode.php?proc=13",$("#frm10").serialize(),(res)=>{ //serialize μεθοδος της jquery pou μετατρέπει τα δεδομένα μιας φόρμας σε μια συμβολοσειρά κωδικοποιημένη σε μορφή URL (URL-encoded string), η οποία μπορεί να σταλεί εύκολα μέσω μιας AJAX κλήσης. 
            if(res==1){
                alert("Η προσφορά προστέθηκε");
                show_all(); // Επαναφορτώνει τις ανακοινώσεις μετά την υποβολή
            }
            else
            {
                alert("Η προσφορά δεν προστέθηκε !!");
            }
        });


    })

</script>

</body>
</html>