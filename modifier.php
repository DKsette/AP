<?php
    session_start();
    if(!$_SESSION['loggin']);
    function connexion_bdd()
{
/*************************CONNEXION A LA BDD*************************************** */
$host = '127.0.0.1';
$db   = 'm2l';
$user = 'root';
$pass = 'root';
$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) {
    print"ERREUR:".$e;
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
return $pdo;
}//Fin fonction connexion_bdd

$id=$_GET['demande'];
$_SESSION['demande']= $_GET['demande'];
$pdo=connexion_bdd();
$stmt= $pdo->prepare("SELECT * FROM `demmande` WHERE iddemande = ?;");
$stmt ->execute(array($id));

//je recupère la liste a afficher
$list = $stmt->fetch();
//var_dump($list); je vérifie ce qu'il y a dedans 

/* echo "Demande: {$list['iddemande']} | 
Etat: {$list['idetat']} |
 Priorité: {$list['idpriorite']} | 
 Assignement: {$list['assignement']} | 
 IDUser: {$list['iduser']} <br> ";*/
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
   
<p class="boite">
        <?php
            if($_GET['demande']){
                //echo"J'ai bien qqchose dans mon postid <br>";
                $id=$_GET['demande'];
                $_SESSION=$id;
                echo $id;
                $stmt1= $pdo->prepare("SELECT * FROM `demmande` WHERE iddemande = ?;");
                $stmt1 ->execute(array($id));
                $list1 = $stmt1->fetch();
                ?>
                <table width='100%' border='1' cellspacing='0' cellpadding='1'>
            <tr>
                <th> Assignement </th>
                <th>Etat</th>
                <th> Priorité </th>
                <th> ID User </th>

            </tr>
            <form  action="fmodif.php" method="post">
            <?php
                echo "  
                          
                <td> {$list1['assignement']} </td>" ?>
                <td>Etat de la demande :<SELECT name="etatd" size="0.5">
                <OPTION>--------
                <OPTION>non assignées
                <OPTION>en cours de réalisation
                <OPTION>en attente
                <OPTION>terminée
                </SELECT> </td>
                <td> Priorité de la demande : <SELECT name="priod" size="1">
            <OPTION>--------
            <OPTION>1
            <OPTION>2  
            <OPTION>3
            <OPTION>4
            </SELECT></br>
            <td>Affectation : <SELECT name="affecd" size="0.5">
                <?php
                echo "<OPTION>--------";
                // Faire la requête SQL pour afficher les employes
                $stmt1= $pdo->prepare("SELECT * FROM `user` WHERE idrole = '3';");
                $stmt1 ->execute(array());
                //$list1 = $stmt1->fetch();
                while($list1 = $stmt1->fetch()){

                    echo "
                    <OPTION> {$list1['loggin']}";
                    } ?>
                </SELECT> </td>
                <?php
;
            }

             
        ?>     
        </table>
        <button type="submit">Valider</button>
        </form>
        </p>
</body>
<footer>
<a href="responsable.php"> <button class='deco' id=btndeco1 >Annuler </button></a>
</footer>
</html>