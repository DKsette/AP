
<?php
    //Affiche les erreurs !
    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);
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

$pdo=connexion_bdd();

if($_POST['etat']){

    if ($_POST['etat']=="non assignées"){
    $etats = 1;
}
    elseif ($_POST['etat']=="en cours de réalisation"){
    $etats = 2;
}
    elseif ($_POST['etat']=="en attente"){
    $etats = 3;
}
    elseif ($_POST['etat']=="terminée"){
    $etats = 4;
}
    elseif ($_POST['etat']=="--------"){
    $etats=0;
}}
if($_POST['prio']){
if ($_POST['prio']=="--------"){
    $prio=0;
}
if ($_POST['prio']=="1"){
    $prio = 1;
}
if ($_POST['prio']=="2"){
    $prio = 2;
}
if ($_POST['prio']=="3"){
    $prio = 3;
}
if ($_POST['prio']=="4"){
    $prio = 4;
}}  
if($_POST['emp']){
$emp = $_POST['emp'];
}
/* je vois ce que je récupère dans le post pour les tests
echo "Etat de la demande : ".$etats. " = ".$_POST['etat'];
echo "  Priorité de la demande : " .$prio."</br></br>";
echo $emp;*/
if($nom =="")//1ère condition ou tout les chants sont remplis
{
    if($etats==0){
        if($prio==0){
            $stmt= $pdo->prepare("SELECT * FROM `demmande` ");
            $stmt ->execute(array());}
        if($prio){
            echo "bprio";
            $stmt= $pdo->prepare("SELECT * FROM `demmande` WHERE  idpriorite = $prio   ");
            $stmt ->execute(array());}
    }

    if($etats){// Choix Etat{echo "boucle 1 ";
            if($prio){
                $stmt= $pdo->prepare("SELECT * FROM `demmande` WHERE  idetat = $etats AND idpriorite = $prio ");
                $stmt ->execute(array());
            }
            else{
                //echo "belse";
                $stmt= $pdo->prepare("SELECT * FROM `demmande` WHERE  idetat = $etats   ");
                $stmt ->execute(array());}
    }


    



}
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

    
        <form action="responsable.php" method="post">
        <p>Recherche avancée ? </br>
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
<!--      ------------------------------------------------------La boite à modif------------------------------------------------------          -->

        <p class="boite">
        <?php
            if($_GET['demande']){
                //echo"J'ai bien qqchose dans mon postid <br>";
                $id=$_GET['demande'];
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
                <th>  </th>

            </tr>
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
                <OPTION>--------
                <OPTION>Faire SQL Requête pour sortir les employes
                <OPTION>--------
                </SELECT> </td>
                <?php
                echo"<td class='crud'> "?> <a class='del' href='supprimer.php?demande=<?=$list['iddemande'] ?>'> Confirmer </a> <?php echo"</td>";
            }

             
        ?></table>
        </p>

<!--      ------------------------------------------------------Fin La boite à modif------------------------------------------------------          -->

       <!-- Voici la list : --> </br>
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
            <td class='crud'> "?> <a class='mod' href='responsable.php?demande=<?=$list['iddemande']?>'> ModifierR </a> <?php echo"</td>
            <td class='crud'> "?> <a class='mod' href='modifier.php?demande=<?=$list['iddemande']?>'> Modifier </a> <?php echo"</td>
            <td class='crud'> "?> <a class='del' href='supprimer.php?demande=<?=$list['iddemande'] ?>'> Supprimer </a> <?php echo"</td>
            ";
        }
        ?> </table>
    </body>
    <a href="index.html"> <button class='deco' id=btndeco1 >Déconnexion </button></a>
 </html>