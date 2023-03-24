<?php
    session_start();
    if(!$_SESSION['loggin']);
    include("bdd.php");
    $pdo=connexion_bdd();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User</title>
</head>
<body>
    Login is Good <br/>
    
    Bienvenu <?php echo $_SESSION['loggin'] ?> <br/>
    Vous êtes un <?php echo $_SESSION['role'] ?> <br/>
    <br/>
    <form action="creatache.php" method="post">
        <p>Nom de la tache : <input type="text" name="tache"   /></p>
        <p><input type="submit" value="Créer la tache"></p>
</body>
<footer>
<a href="index.html"> Déconnexion </a>
</footer>
</html>


