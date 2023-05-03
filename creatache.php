<?php
    session_start();
    if(!$_SESSION['loggin']);
    include("bdd.php");
$pdo=connexion_bdd();
$loggin=$_SESSION['loggin'];
$stmt= $pdo->prepare("SELECT `iduser` From `user`WHERE loggin=?;");
$stmt ->execute(array($loggin));
$iduser = $stmt->fetch();
//echo $loggin;
//echo $iduser['iduser'];



$stmt2 = $pdo->prepare("INSERT INTO demmande (iddemande, idetat, idpriorite, assignement, iduser ) VALUES (null,1,4,?,?)");
$tache = $_POST['tache'];
$stmt2->execute(array($tache,$iduser['iduser']));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Page crée</title>
</head>
<p class="boite">
Votre demande a bien été pris en compte !
</p>
<body><a href="user.php"> <button class='deco' id=btndeco1 >Continuer </button></a>
<a href="disconect.php"> <button class='deco' id=btndeco1 >Déconnexion </button></a>    
</body>
</html>