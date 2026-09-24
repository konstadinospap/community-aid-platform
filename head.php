<?php
session_start();
if(@$_SESSION["id"]=="") { header("Location: index.php"); die();}
?>
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
</head>
<body>

<div class="jumbotron text-center myjb">
  <h1>Πλατφόρμα βοήθειας</h1>
  
</div>
  
<div class="container"> <!--Ξεκινά ένα container του Bootstrap που διασφαλίζει το responsive layout της σελίδας.-->


<nav class="navbar menu navbar-inverse"> <!--Δημιουργεί μια navbar (μπάρα πλοήγησης) με την κλάση navbar-inverse, η οποία προσφέρει σκούρο θέμα για τη μπάρα.-->
  <div class="container-fluid"> <!--Το container-fluid κάνει τη μπάρα να επεκτείνεται σε όλο το πλάτος της σελίδας-->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Πολίτης</a>
      <!--Η ενότητα navbar-header περιέχει το κουμπί toggle που εμφανίζεται σε μικρές οθόνες. Όταν ο χρήστης κάνει κλικ στο κουμπί (τρεις γραμμές icon-bar), εμφανίζει ή αποκρύπτει το μενού.Το στοιχείο <a class="navbar-brand" href="#">Πολίτης</a> προσθέτει ένα link με την ετικέτα "Πολίτης" στη navbar.-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar"> <!--Το collapse navbar-collapse επιτρέπει στο μενού να καταρρέει (collapse) σε μικρές οθόνες, δηλαδή να είναι κρυφό και να εμφανίζεται μόνο όταν πατηθεί το κουμπί toggle.-->
      <ul class="nav navbar-nav"> <!--περιέχει τα στοιχεία του μενού πλοήγησης:-->
        <li><a href="main.php">Αρχική</a></li>
        <li><a href="anak.php">Ανακοινώσεις</a></li>
        <li><a href="prosf.php">Προσφορές</a></li>
        <li><a href="requests.php">Αιτήματα</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--Η δεύτερη λίστα <ul> είναι το δεξί μέρος της navbar (navbar-right), και περιέχει ένα στοιχείο για την αποσύνδεση του χρήστη (logout).-->

        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logοut</a></li>
      </ul>
    </div>
  </div>
</nav>

