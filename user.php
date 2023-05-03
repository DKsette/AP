<?php
    session_start();
    if(!$_SESSION['loggin']){
        header('Location: index.html');
    };
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
    <p class="guide">
        Bienvenue <?php echo $_SESSION['loggin'] ?> <br/>
        Vous êtes un <?php echo $_SESSION['role'] ?> <br/></p>
    <br/>
    <form action="creatache.php" method="post" class="guide">
        <p>Nom de la tache : <input type="text" name="tache"   /></p>
        <p><input type="submit" value="Créer la tache"></p>
    </form><br/>
</body>
<footer>
<a href="disconect.php"> <button class='deco' id=btndeco1 >Déconnexion </button></a>
</footer>
</html>


