<!DOCTYPE html>
<html lang="en">
<head>
  <title>WEB24</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="my.css">
</head>
<body>

<div class="jumbotron text-center myjb">
  <h1>Πλατφόρμα Βοήθειας</h1>
  
  
</div>
  
<div class="container" style="display: flex; justify-content: center; align-items: center;">
    <!--Δημιουργεί ένα container με χρήση του CSS Flexbox, ώστε να ευθυγραμμίζεται και να κεντράρεται το περιεχόμενο οριζόντια και κάθετα.--> 
  <div class="row">

    <div class="col-sm-12 frm2" style="width: 600px;">
      <h3>Σύνδεση Χρήστη</h3>
      <form id="frmcon"> <!--Ξεκινά μια φόρμα με το ID frmcon. ΤΗΝ ΕΧΜ ΑΠΟ ΚΑΤΩ-->
    
        <div class="form-group">
          <label for="usr">Username:</label>
          <input type="text" class="form-control" id="usr" name="usr" >
        </div> 
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" name="pwd">
        </div>
        
        <!--Δημιουργεί ένα κουμπί υποβολής της φόρμας που γράφει "Σύνδεση". Η κλάση btn btn-default είναι από το Bootstrap για την εμφάνιση του κουμπιού.--> 
        <button type="submit" id="logbtn" class="btn btn-default">Σύνδεση</button>
      </form><br><br>
      <a href='admin/'><button id="admlog" class="btn btn-default">Σύνδεση σαν διαχεριστής</button></a>
      <a href='diasostis/'><button id="savlog" class="btn btn-default">Σύνδεση σαν διασώστης</button></a>

      <div id="signred" style="margin-top: 15px;">Για να κάνεις εγγραφή κάνε κλικ <a href='./signup.php'><button id="signbtn" class="btn btn-default" style="margin-left:5px;">Εγγραφή</button></a></div>
      <!--Παρέχει τη δυνατότητα εγγραφής, με σύνδεσμο προς το signup.php και ένα κουμπί για "Εγγραφή".--> 
    </div>
    
    
</div>


<script>
    
    $("#frmcon").submit(()=>{
        event.preventDefault();
        $.post("phpcode.php?proc=2", $("#frmcon").serialize(),(res)=>{
            if(res=="1")
            {
              window.location.href="main.php";
            }
            else
            {
              alert("Ο χρήστης δεν βρέθηκε");
            }

        });

    })


</script>


</body>
</html>
