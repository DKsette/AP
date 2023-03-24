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

echo"Votre demande a bien été pris en compte ! <br/>";
echo '<a href="user.php">Continuer</a>';
?>
