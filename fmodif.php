<?php
session_start();
if(!$_SESSION['loggin']);
include("bdd.php");
$pdo=connexion_bdd();

$demande=$_SESSION['demande'];
$etat=$_POST['Etat'];
echo $demande;
echo "<br/>";
echo $etat;
echo "<br/>";
/*
$pdo=connexion_bdd();
$stmt= $pdo->prepare("");
$executeIsOk = $stmt ->execute();
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modif.css">
    <title>Modifier la demande</title>
    <script>
        function Good()//nom de la fonction réussite
        {
           alert("Succès !"); //this is the message in ""
        }
        function Bad()
        {
            alert("Erreur !");
        }
    </script>
</head>
<body>
            <?php
            if($_REQUEST){ //Faire une requête pour verifier que ce qu'on a mis est dans la BDD 
                echo '<script>Good()</script>';
            }
            else{
                echo '<script>Bad()</script>';
            }
            ?>
   
        <form class="form" method='POST' action='fmodif.php'>
        <h2>Quel est l'état à modifer ?</h2>
        <SELECT name="Etat" size="1">
        <OPTION>--------------
        <OPTION>non assignées
        <OPTION>en cours de réalisation   
        <OPTION>en attente
        <OPTION>terminée
        </SELECT>
        <p><input class="btn" type="submit" value="OK"></p>
</body>
<footer>
<a href="responsable.php"> Annuler </a>
</footer>
</html>