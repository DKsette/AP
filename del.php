
<?php
    //Affiche les erreurs !
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();
    if(!$_SESSION['loggin']);
    include("bdd.php");
$pdo=connexion_bdd();
$etat = $_POST['etatd'];
$prio = $_POST['priod'];
$user = $_POST['affecd'];
echo $etat;
echo $prio;
echo $user;
echo "<br> je dois faire la requête sql pour la modif et renvoyer sur responsable.php<br>";

if($etat!="--------"){
    echo"etat est diff de -------";
    if($prio!="--------"){
        echo"prio est diff de --------";
        if($user!="--------"){
            echo "user est diff de --------";
            //Faire ici la requête sql et renvoyer sur responnsable (ou faire le popup de confirmation)  

            
        }
        else{
            echo"user = --------";
        }
    }
    else{
        echo"prio = --------";
    }
}
else{
    echo "etat = --------";
}
?>