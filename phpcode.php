<?php
session_start();
$db=mysqli_connect("localhost","root","","dbakk");
mysqli_query($db,"set names 'utf8'");
$proc=$_GET['proc'];


$Root[1]="fun1";
$Root[2]="fun2";
$Root[7]="fun7";
$Root[8]="fun8";
$Root[10]="fun10";
$Root[11]="fun11";
$Root[12]="fun12";
$Root[13]="fun13";
$Root[14]="fun14";

$fun=$Root[$proc];
$fun($db);

function fun1($db){
        $sql="INSERT INTO user (id, fullname, phone, username, 
                                password, x, y, email) 
                                VALUES (NULL, '$_POST[onoma]', 
                                '$_POST[phone]', '$_POST[username2]', 
                                    '$_POST[pwd2]', '$_POST[x]', 
                                    '$_POST[y]', '$_POST[email]')";


        
        try{
                    mysqli_query($db,$sql);
                    echo "1";
            }
        catch(Exception $e)
        {
                echo "0";
            }
        }


   
function fun2($db){
        $sql="select * from user where 
        username='$_POST[usr]' 
        and password='$_POST[pwd]'";
        //Εδώ κατασκευάζεται ένα SQL ερώτημα που επιλέγει όλα τα πεδία από τον πίνακα user όπου το πεδίο username και το πεδίο password ταιριάζουν με τις τιμές που εισάγονται από τον χρήστη μέσω της φόρμας ($_POST['usr'] και $_POST['pwd']).


            try{
                    $q=mysqli_query($db,$sql);
                    if(mysqli_num_rows($q)>0)
                        {
                            $r=mysqli_fetch_assoc($q);
                            $_SESSION["id"]=$r["id"];
                            echo "1";
                        }
                        else
                        {
                            echo "0";
                        }
            }
            catch(Exception $e)
            {
                echo "0";
            }
        }



    function fun7($db){
        //Η συνάρτηση αυτή θα εισάγει ένα νέο αίτημα στον πίνακα aitimata της βάσης δεδομένων.
        $sql="INSERT INTO aitimata set item='$_POST[item]' , arithmos_atomwn='$_POST[atoma]', 
        date=now(), state='wait',user=$_SESSION[id]";
       //item='$_POST[item]': Το αντικείμενο που ζητάει ο χρήστης από τη φόρμα αποστέλλεται μέσω της POST μεταβλητής $_POST['item']. to idio k gia ta alla
       //date=now(): Η τρέχουσα ημερομηνία και ώρα καταγράφεται χρησιμοποιώντας τη MySQL συνάρτηση now().
       //state='wait': Ορίζεται σταθερά η κατάσταση του αιτήματος ως 'wait', που σημαίνει ότι είναι σε αναμονή.
       //user=$_SESSION[id]: Το ID του χρήστη που έκανε το αίτημα λαμβάνεται από τη συνεδρία του χρήστη μέσω της μεταβλητής $_SESSION['id'].


        try{
                    mysqli_query($db,$sql);
                    echo "1";
            }
        catch(Exception $e)
        {
                echo "0";
            }
        }



function fun8($db){
        //Αυτή η συνάρτηση επιστρέφει όλα τα διαθέσιμα αντικείμενα από τον πίνακα items.
        $q=mysqli_query($db,"SELECT * FROM `items`");
        echo json_encode($q->fetch_all(MYSQLI_ASSOC));
        //Η συνάρτηση fetch_all(MYSQLI_ASSOC) χρησιμοποιείται για να μετατρέψει τα αποτελέσματα του ερωτήματος σε έναν πίνακα συσχετιστικών πινάκων (associative array), όπου τα κλειδιά αντιστοιχούν στα ονόματα των στηλών του πίνακα.
        //Η json_encode() μετατρέπει τον πίνακα που δημιουργήθηκε από το fetch_all() σε μορφή JSON.
        }


    
    function fun10($db){ //db παράμετρο η οποία είναι η σύνδεση με τη βάση δεδομένων
            $q=mysqli_query($db,"SELECT * FROM aitimata, items where items.id=aitimata.item 
            and user=$_SESSION[id]");
            echo json_encode($q->fetch_all(MYSQLI_ASSOC));
        }
    

            

    function fun11($db){
        
                $q=mysqli_query($db,"SELECT * FROM `anakoinosi`"); //Εκτελεί ένα SQL ερώτημα που επιλέγει όλες τις στήλες (*) από τον πίνακα anakoinosi και αποθηκεύει το αποτέλεσμα στη μεταβλητή $q.
                $A=[]; //κενό πίνακα ο οποίος θα γεμίσει με τα δεδομένα των ανακοινώσεων και των αντίστοιχων αντικειμένων
                while($r=mysqli_fetch_assoc($q))
                {
                    $q2=mysqli_query($db,"SELECT * FROM `ananoinosi_item`, items 
                    where anakoinosi=$r[id] and items.id= ananoinosi_item.item"); //Εκτελεί ένα δεύτερο SQL ερώτημα για να επιλέξει τα αντικείμενα που σχετίζονται με την τρέχουσα ανακοίνωση για να πάρει τα αντικείμενα που σχετίζονται με την τρέχουσα ανακοίνωση
                    $itm=""; //Δημιουργεί μια κενή μεταβλητή συμβολοσειράς $itm, όπου θα αποθηκευτούν τα ονόματα των αντικειμένων της ανακοίνωσης.
                    while($r2=mysqli_fetch_assoc($q2))
                        $itm=$itm.$r2['name'].","; //Ξεκινάει έναν δεύτερο βρόχο while, ο οποίος εκτελείται για κάθε αντικείμενο που σχετίζεται με την τρέχουσα ανακοίνωση.Κάθε όνομα αντικειμένου ($r2['name']) προστίθεται στην αλφαριθμητική συμβολοσειρά $itm, χωρισμένο με κόμμα (,)
                    $r['items']=$itm;//Προσθέτει στο αρχείο της ανακοίνωσης $r ένα νέο στοιχείο με όνομα items, το οποίο περιέχει τη λίστα των ονομάτων αντικειμένων (με κόμμα μεταξύ τους).
                    $A[]=$r;//Προσθέτει την τρέχουσα ανακοίνωση με τα αντικείμενά της στον πίνακα $A.

                }
        
                echo json_encode($A); //Μετατρέπει τον πίνακα A, ο οποίος περιέχει όλες τις ανακοινώσεις και τα αντικείμενά τους, σε μορφή JSON και τον εκτυπώνει ως απόκριση.
              }

    //Συνοπτική Λειτουργία της fun11: Αυτή η συνάρτηση παίρνει όλες τις ανακοινώσεις από τον πίνακα anakoinosi, και για κάθε ανακοίνωση βρίσκει τα σχετικά αντικείμενα από τους πίνακες ananoinosi_item και items. Στη συνέχεια, τα δεδομένα αυτά συνδυάζονται και επιστρέφονται σε μορφή JSON.
    function fun12($db){
        $q2=mysqli_query($db,"SELECT * FROM `ananoinosi_item`, items where anakoinosi=$_GET[id] and items.id= ananoinosi_item.item"); //Εκτελεί ένα SQL ερώτημα που επιλέγει όλα τα δεδομένα από τους πίνακες ananoinosi_item και items για μια συγκεκριμένη ανακοίνωση. Το $_GET['id'] είναι η τιμή που παρέχεται μέσω του URL (από την παράμετρο id), και το ερώτημα παίρνει όλα τα αντικείμενα που σχετίζονται με την αντίστοιχη ανακοίνωση.
        echo json_encode($q2->fetch_all(MYSQLI_ASSOC)); //Mετατρέπει όλα τα αποτελέσματα του ερωτήματος σε έναν πίνακα συσχετιστικών πινάκων (MYSQLI_ASSOC διασφαλίζει ότι κάθε γραμμή επιστρέφεται ως συσχετιστικός πίνακας), τα μετατρέπει σε μορφή JSON και τα εκτυπώνει ως απόκριση.
 
              }
//Συνοπτική Λειτουργία της fun12: Η συνάρτηση fun12 παίρνει όλα τα αντικείμενα που σχετίζονται με μια συγκεκριμένη ανακοίνωση (χρησιμοποιώντας το id που παρέχεται μέσω του URL) και επιστρέφει αυτά τα δεδομένα σε μορφή JSON.


    function fun13($db){
            $sql="INSERT INTO prosfores set item=$_POST[itemp] , posotita=$_POST[posotita], 
            anakoinosi=$_POST[anakoinosi],date=now(), state='wait',user=$_SESSION[id]"; //Εδώ δημιουργείται ένα SQL ερώτημα τύπου INSERT, το οποίο χρησιμοποιείται για την εισαγωγή μιας νέας εγγραφής στον πίνακα prosfores. Το SQL ερώτημα χρησιμοποιεί τη σύνταξη SET για να ορίσει τις τιμές των πεδίων.Η τιμή για το πεδίο item (που αναφέρεται στο αντικείμενο που προσφέρεται) προέρχεται από τη φόρμα που υποβλήθηκε μέσω της POST μεταβλητής $_POST['itemp']. TO IDIO KAI GIA TA ALLA 2
            //date=now(): Η τρέχουσα ημερομηνία και ώρα καταγράφεται αυτόματα χρησιμοποιώντας τη συνάρτηση now() της βάσης δεδομένων. state='wait': Το πεδίο state της εγγραφής ορίζεται σταθερά ως 'wait', δηλαδή η κατάσταση της προσφοράς είναι σε αναμονή.
            //user=$_SESSION[id]: Ο χρήστης που έκανε την προσφορά αναγνωρίζεται από το $_SESSION['id'], το οποίο αναφέρεται στη συνεδρία του συνδεδεμένου χρήστη.
            try{
                        mysqli_query($db,$sql);
                        echo "1";
                }
            catch(Exception $e)
            {
                    echo "0";
                }
            }

    function fun14($db){ //Η συνάρτηση αυτή προορίζεται να επιστρέψει δεδομένα σχετικά με προσφορές που έχουν υποβληθεί από έναν συγκεκριμένο χρήστη 
        
            $q=mysqli_query($db,"SELECT * FROM prosfores, items where items.id=prosfores.item 
            and user=$_SESSION[id]"); //αναφέρεται στο ID του χρήστη που είναι αποθηκευμένο στη συνεδρία του (δηλαδή ο χρήστης που είναι συνδεδεμένος αυτή τη στιγμή).
            echo json_encode($q->fetch_all(MYSQLI_ASSOC));
            //Το αποτέλεσμα του SQL ερωτήματος ($q) επιστρέφεται ως αντικείμενο αποτελέσματος της MySQLi. Για να εξάγουμε τα δεδομένα από αυτό το αντικείμενο, χρησιμοποιείται η μέθοδος fetch_all().
            //$q->fetch_all(MYSQLI_ASSOC): Αυτή η μέθοδος επιστρέφει όλα τα αποτελέσματα του ερωτήματος ως έναν πίνακα συσχετιστικών πινάκων (associative arrays). Κάθε γραμμή αποτελέσματος αντιπροσωπεύεται ως ένας πίνακας όπου τα κλειδιά είναι τα ονόματα των στηλών της βάσης δεδομένων.
            //Η συνάρτηση json_encode() μετατρέπει τον πίνακα που δημιουργήθηκε από τη μέθοδο fetch_all() σε μορφή JSON.
            //Το αποτέλεσμα της json_encode() εκτυπώνεται με την echo
           }



