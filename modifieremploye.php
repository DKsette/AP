<?php
    session_start();
    if(!$_SESSION['loggin']);
    include("bdd.php");
    $pdo=connexion_bdd();Fin fonction connexion_bdd

$id=$_GET['demande'];
$stmt= $pdo->prepare("SELECT * FROM `demmande` WHERE iddemande = ?;");
$stmt ->execute(array($id));

//je recupère la liste a afficher
$list = $stmt->fetch();
//var_dump($list); je vérifie ce qu'il y a dedans 

/*  Je test ce que je recois

echo "Demande: {$list['iddemande']} | 
Etat: {$list['idetat']} |
 Priorité: {$list['idpriorite']} | 
 Assignement: {$list['assignement']} | 
 IDUser: {$list['iduser']} <br> "; **/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier la demande</title>
</head>
<body>

   <h2>Quel est l'état à affecter ?</h3>

        <form method='POST' action='fmodif.php'>
        <SELECT name="Etat" size="1">
        <OPTION>--------------
        <OPTION>non assignées
        <OPTION>en cours de réalisation   
        <OPTION>en attente
        <OPTION>terminée
        </SELECT>
        <p><input type="submit" value="OK"></p>
        </form>
        
</body>
<a href="employe.php">  <button>Annuler</button> </a>
</html>