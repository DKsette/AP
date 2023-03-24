<?php
    session_start();
    if(!$_SESSION['loggin']);
    include("bdd.php");
    $pdo=connexion_bdd();

$stmt= $pdo->prepare("SELECT * FROM `demmande`");
$executeIsOk = $stmt ->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Responsable</title>
</head>
<body>
    Loggin is Good <br/>
    Bienvenu <?php echo $_SESSION['loggin'] ?> <br/>
    Vous êtes un <?php echo $_SESSION['role'] ?> <br/>


    <form action="rechfiltre.php" method="post">
    <p>Recherche avancée ? </br>
        <!-- Rajouter le tri par employer qui travail dessus et faire la requête spécifique pour que la requête soit faite en fonction de son uid et pas son nom!--> 
        Réaliser par qui ? : <input type="text" name="emp" />
        Etat de la demande :   <SELECT name="etat" size="1">
        <OPTION>--------
        <OPTION>non assignées
        <OPTION>en cours de réalisation
        <OPTION>en attente
        <OPTION>terminée
        </SELECT>
        Priorité de la demande : <SELECT name="prio" size="1">
        <OPTION>--------
        <OPTION>1
        <OPTION>2  
        <OPTION>3
        <OPTION>4
        </SELECT></br>
        <input type="submit" value="OK"></p> 
    </form>
    Voici la list :  </br>
    <table width='100%' border='1' cellspacing='0' cellpadding='1'>
            <tr>
                <th> Assignement </th>
                <th>Demande</th>
                <th> Etat </th>
                <th> Priorité </th>
                <th> ID User </th>
                <th></th>
                <th></th>
            </tr>
        <?php 

        while($list = $stmt->fetch()){

            echo "
            <tr> 
            <td> {$list['assignement']} </td>
            <td> {$list['iddemande']} </td>
            <td> {$list['idetat']} </td>
            <td> {$list['idpriorite']} </td> 
            <td> {$list['iduser']}  </td>
            <td class='crud'> "?> <a  href='modifier.php?demande=<?=$list['iddemande'] ?>'><button class='mod' id=btn1 >Modifier </button> </a> <?php echo"</td>
            <td class='crud'> "?> <a class='del' href='supprimer.php?demande=<?=$list['iddemande'] ?>'><button class='del' id=btn2 >Supprimer </button>  </a> <?php echo"</td>
            ";
        }
        ?> </table>  
</body>
    <a href="index.html"> <button class='deco' id=btndeco1 >Déconnexion </button></a>
</html>
