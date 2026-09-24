<?php
include "head.php";

?>

<!-- εμφανίζει την αποθήκη -->
<p>
<a href="apothiki.php"><button style="padding:15px; font-size:20pt;" id="modalbtn">Αντικείμενα</button></a>

<a href="categories.php"><button style="padding:15px; font-size:20pt;" id="modalbtn">Κατηγορίες</button></a>
</p>

<div class="panel panel-default panel1">
    <h1>Προσθήκη Δεδομένων από URL</h1> 
    <form id="frm1" >
        <!-- Φορτώνουμε τα δεδομένα από url -->
    URL: <input type="url" value="http://usidas.ceid.upatras.gr/web/2023/export.php" name=url><br><br>
     <button id="modalbtn" type=submit>SEND</button>
    </form>

</div>
<div class="panel panel-default panel1">
    <h1>Προσθήκη Δεδομένων από Αρχείο</h1>
    <form id="frm2">
         <!-- Φορτώνουμε τα δεδομένα από αρχείο -->
        URL:<input type="file"  name=file1 id=file1><br>
        <button id="modalbtn" type=submit>SEND</button>
        
    </form>
    
</div>
<br><br>
    



<div class=row>
  <div class=col-md-6>
  <div class="panel panel-default panel1">
    <h1>Προσθήκη νέας κατηγορίας</h1>
        <form id=frmc>
            <table>
            <tr><td>ID:</td><td> <input type=text name=idc></td></tr>
            <tr><td>Category Name:</td><td> <input type=text name=namec></td></tr>
            </table>
            <input type=submit value="Προσθήκη Κατηγορίας">
        </form>
</div>
  </div>
  <div class=col-md-6>
  <div class="panel panel-default panel1">
        <h1>Προσθήκη νέου προϊόντος</h1>
        <form id=frmp>
            <table>
            <tr><td>ID:</td><td> <input type=text name=idp></td></tr>
            <tr><td>Name:</td><td> <input type=text name=namep></td></tr>

            <tr><td>Category:</td><td> <select name=categp id=cat13></select></td></tr>
            </table>
            <input type=submit value="Προσθήκη Προϊόντος">
        </form>

        <script>
    $.getJSON("phpcode.php?proc=13", (res)=>{
        h="";
        for (i=0;i<res.length;i++)
        {
            h+=`<option value=${res[i].id}>${res[i].category_name}</option>`;
        }
        $("#cat13").html(h);
    })

</script>
        </div>
  </div>
</div> 

<script>

// περίπτωση που ανεβάζουμε url
    $("#frm1").submit(()=>{
        event.preventDefault();  // ακυρώνει να κάνει reload η σελίδα


            // στελνει στο backedn phpcode.php το url 
        $.post("phpcode.php?proc=6",$("#frm1").serialize(),(res)=>{
            if(res==1){  // αν τα δεδομένα φορτωθούν σωστά
                alert("ΟΚ DATA INSERTED");
            }
            else
            {
                alert("ERROR DATA INSERTED");
            }
        });


    })


// περίπτωση που ανεβάζουμε αρχείο
    $("#frm2").submit(()=>{
        event.preventDefault();

        // δημιουργούμε αντικείμενο formdata για να βάλουμε μέσα το αρχείο
        var formdata=new FormData();
        var f=$("#file1")[0].files[0];
        formdata.append("file1",f);

        // για την μεταφορά του αρχείου χρησιμοποιούμε την εντολή ajax και στέλνουμε το αρχείο στο backend
        $.ajax({
        type: "POST",
        url: "phpcode.php?proc=7",
        success: function (res) {
            if(res==1){         // αν ανέβει το αρχείο και φορτωθούν τα δεδομένα σωστά
                alert("ΟΚ DATA INSERTED");
            }
            else
            {
                alert("ERROR DATA INSERTED");
            }
        },
        async: true,
        data: formdata,  // εδώ είναι τα δεδομένα της εφαρμογής
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000
    });

      

    })


    // προσθήκη κατηγορίας
 $("#frmc").submit(()=>{
        event.preventDefault();

        $.post("phpcode.php?proc=101",$("#frmc").serialize(),(res)=>{
            if(res==1){
                alert("Η κατηγορία προστέθηκε");
            }
            else
            {
                alert("ERROR");
            }
        });


    })


     // προσθήκη προϊοντος
    $("#frmp").submit(()=>{
        event.preventDefault();

        $.post("phpcode.php?proc=102",$("#frmp").serialize(),(res)=>{
            if(res==1){
                alert("Το προϊόν προστέθηκε");
            }
            else
            {
                alert("ERROR DATA INSERTED");
            }
        });


    })


</script>

</body>
</html>    