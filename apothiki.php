<?php
include "head.php";

?>
 
<h1>Αποθήκη</h1>
Search: <input type=text id=search1 onkeyup="filter1()">
<!--Δημιουργείται ένα πεδίο κειμένου (<input type="text">) με id="search1, όπου ο χρήστης μπορεί να πληκτρολογήσει μια αναζήτηση--> 
<!--Η λειτουργία onkeyup="filter1()" καλεί τη συνάρτηση filter1 κάθε φορά που ο χρήστης πληκτρολογεί κάτι στο πεδίο αναζήτησης, φιλτράροντας τα δεδομένα στον πίνακα.-->

<table class="table table-striped">
    <!-- Δημιουργείται ένας πίνακας (<table>) με τη Bootstrap κλάση table table-striped, που δίνει ένα στυλ με γραμμές σε εναλλασσόμενα χρώματα.--> 
    <thead>
        <tr><th>id</th><th>Item</th><th>Κατηγορία</th><th>Ποσότητα</th></tr>
    </thead>
    <tbody id=data>

    </tbody>
</table>
<script>



        $.getJSON("phpcode.php?proc=70",(res)=>{
            h="";
            for (i=0;i<res.length;i++)
            {
                h+=`<tr><td>${res[i].idi}</td><td>${res[i].name}</td><td>${res[i].category_name}</td><td>
            
                <input type='number' value=${res[i].qty} id='t${res[i].idi}'>
                
                <button style="margin-left:3px;" id="modalbtn" onclick='save(${res[i].idi})'>Save</button></td></tr>`;
            }
            $("#data").html(h);

        });
        //Στη στήλη Ποσότητα, προστίθεται ένα πεδίο εισαγωγής αριθμών (<input type="number">) με την τιμή αποθέματος res[i].qty και id="t${res[i].idi}", ώστε να μπορεί να ενημερωθεί.
        //Προστίθεται ένα κουμπί Save, το οποίο καλεί τη συνάρτηση save(${res[i].idi}) όταν πατηθεί.


 function filter1()
 {
    x=$("#search1").val();

    K=$("#data tr");

    for (i=0; i<K.length;i++)
    {
        if($(K[i]).text().toUpperCase().indexOf(x.toUpperCase())<0)
        {
            $(K[i]).hide(); //Αν το κείμενο της σειράς δεν περιέχει το αναζητούμενο κείμενο, η σειρά κρύβεται 
        }
        else
        {
            $(K[i]).show(); //Αν το κείμενο περιέχει το αναζητούμενο κείμενο, η σειρά εμφανίζεται 
        }
    }
    

 } 

 function save(id)
 {
    x=$("#t"+id).val();
    $.post("phpcode.php?proc=71",{idi:id, qty:x }, (res)=>{});


 }

</script>

</body>
</html>