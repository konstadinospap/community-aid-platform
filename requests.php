<?php
include "head.php";

?>



<div class="row">
    <div class="col-md-8">
        <h2>Αιτήματα</h2>
        <table class="table table-striped" style='width:100%'> <!-- Ο πίνακας (<table>) έχει κλάση table table-striped του Bootstrap, που προσθέτει βασικό στυλ και ρίγες σε κάθε σειρά του πίνακα.--> 
            <thead>
                <tr><th>Ημερομηνία</th><th>Αντικείμενο</th><th>Αρ.Ατόμων</th><th>Κατάσταση</th></tr>
            </thead>

                <tbody id=data> <!--είναι το σώμα του πίνακα, όπου τα δεδομένα θα προστεθούν δυναμικά μέσω JavaScript.--> 


                </tbody>
        
        </table>
    </div>
        <div class=col-md-4>
            <!-- Trigger the modal with a button -->
            <button type="button" id="modalbtn"class="btn btn-info btn-md" data-toggle="modal" data-target="#modalaitima">Προσθήκη Αιτήματος</button>
            <!--Στην άλλη στήλη (col-md-4, που καταλαμβάνει 4/12 του πλάτους), υπάρχει ένα κουμπί που ανοίγει ένα modal για την προσθήκη νέου αιτήματος. Το data-toggle="modal" και data-target="#modalaitima" είναι Bootstrap attributes που ενεργοποιούν την εμφάνιση του modal όταν πατηθεί το κουμπί.-->
            <!-- Modal -->
            <div id="modalaitima" class="modal fade" role="dialog">
                <!--Το id="modalaitima" προσδιορίζει μοναδικά το modal αυτό, ώστε να μπορεί να ανοίγει/κλείνει με κώδικα ή με το κουμπί που το ενεργοποιεί.-->
                <!--Η κλάση modal fade του Bootstrap καθορίζει ότι αυτό το div είναι ένα modal που θα έχει ομαλό εφέ εμφάνισης/εξαφάνισης (fade).--> 
                <div class="modal-dialog">

                    <!-- Modal content περιεχομενο μονταλ-->
                    <div class="modal-content"> <!-- περιεχομενο μονταλ-->
                        <div class="modal-header"><!-- Modal κεφαλιδα-->
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <!-- Το κουμπί με την κλάση close εμφανίζει το σύμβολο &times; (το σύμβολο ×) για να κλείσει το modal.-->
                            <!--Το data-dismiss="modal" δηλώνει ότι το modal θα κλείσει όταν πατηθεί το κουμπί.-->
                            <h4 class="modal-title">Νέο Αίτημα</h4>
                        </div>
                        <div class="modal-body"> 
                            <form id=form1>
                                <table>
                                    <tr><td>Αριθμός Ατόμων:</td>
                                    <td><input type="number" name=atoma id=atoma></td></tr>
                                    <tr><td style="text-align:right;">Αντικείμενο:</td>
                                    <td><select id=items name=item >
                                        

                                    </select></td></tr>

                                    <tr><td></td><td><input type=submit id="modalbtn"  value="Δημοσίευση Αιτήματος"></td></tr>
                                </table>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="modalbtn" data-dismiss="modal">Close</button>
                            <!--ο <div class="modal-footer"> περιέχει το footer του modal, όπου υπάρχει ένα κουμπί "Close". Το κουμπί με data-dismiss="modal" κλείνει το modal χωρίς να υποβληθεί η φόρμα.--> 
                        </div>

                    </div>
                </div>

            </div>
        </div>
</div>
<br><br><br><br><br><br>
<script>
    let antik;
    $.getJSON("phpcode.php?proc=8", (res)=>{
        antik=res; //η λιστα αντικειμων αποθηκευεται στο antik και κάθε αντικείμενο προστίθεται δυναμικά στο dropdown (select) του modal.
        for(i=0;i<res.length;i++)
        {
            $("#items").append(`<option value=${res[i].id}>${res[i].name}</option>`);
        }
    });


   

    $("#form1").submit(()=>{ //Αυτή η λειτουργία ενεργοποιείται όταν ο χρήστης υποβάλλει τη φόρμα.
        event.preventDefault();

        $.post("phpcode.php?proc=7",$("#form1").serialize(),(res)=>{ ////serialize μεθοδος της jquery pou μετατρέπει τα δεδομένα μιας φόρμας σε μια συμβολοσειρά κωδικοποιημένη σε μορφή URL
            if(res==1){
                alert("Το αίτημα προστέθηκε");
                show_all();
            }
            else
            {
                alert("Το αίτημα δεν προστέθηκε !!");
            }
        });


    })

    


    function show_all()
    {
        $.getJSON("phpcode.php?proc=10",(res)=>{
            $("#data").html(""); //Καθαρίζει το περιεχόμενο του πίνακα ($("#data").html("")) και για κάθε εγγραφή αιτήματος που επιστρέφεται, προσθέτει μια νέα σειρά στον πίνακα με τα δεδομένα (ημερομηνία, όνομα αντικειμένου, αριθμός ατόμων, και κατάσταση).
            
            res.forEach((e)=>{
                $("#data").append(`<tr><td>${e.date}</td><td>${e.name}</td><td>${e.arithmos_atomwn}</td><td>${e.state}</td></tr>`)
            })
        })


    }


    show_all(); //καλείται αυτόματα όταν φορτωθεί η σελίδα για να εμφανιστούν τα υπάρχοντα αιτήματα.


</script>

</body>
</html>