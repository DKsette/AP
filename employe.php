<?php
    //Affiche les erreurs !
    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);
    session_start();
    if(!$_SESSION['loggin']){
        header('Location: index.html');
    };
    include("bdd.php");
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
        <p class="guide">
        Bienvenue <?php echo $_SESSION['loggin'] ?> <br/>
        Vous êtes un <?php echo $_SESSION['role'] ?> <br/></p>

    
        <form action="responsable.php" method="post" class="guide">
        <p>Recherche avancée ? </br>

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
            </SELECT>
            <input type="submit" value="OK"></p> 
        </form>
<!--      ------------------------------------------------------La boite à modif------------------------------------------------------          -->

        <p >
        <?php
            if($_GET['demande']){
                //echo"J'ai bien qqchose dans mon postid <br>";
                $id=$_GET['demande'];
                $_SESSION['idd']=$id;
                //echo $id;
                $stmt1= $pdo->prepare("SELECT * FROM `demmande` WHERE iddemande = ?;");
                $stmt1 ->execute(array($id));
                $list1 = $stmt1->fetch();
                ?>


                <form action="modif.php" method="post" class="boite">
                <label for="cars">
                <?php
                echo "  
                          
                {$list1['assignement']} :" ?>
                </label>
                <select id="etatd" name="etatd">
                <option value="">Etat de la demande :</option>
                    <option value="1">non assignées</option>
                    <option value="2">en cours de réalisation</option>
                    <option value="3">en attente</option>
                    <option value="4">terminée</option>
                </select>
                <select name="priod" id="priod">
                    <option value="">Priorité de la demande : </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                <select name="iduserd" id="iduserd">
                    <option value="">ID User : </option>
                    <?php
                        $stmt2= $pdo->prepare("SELECT loggin FROM user where idrole = 3 OR idrole = 1;");
                        $stmt2 ->execute(array());
                        while($list2 = $stmt2->fetch()){
                            echo "<option value='{$list2['loggin']}'>  {$list2['loggin']}   </option>";}
            ?>
                </select>
                <input type="submit">
                </form>
                <?php
             }?>
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
            <td class='crud'> "?> <a class='mod' href='employe.php?demande=<?=$list['iddemande']?>'> Modifier </a> <?php echo"</td>
            ";
        }
        ?> </table>
    </body>
<a href="disconect.php"> <button class='deco' id=btndeco1 >Déconnexion </button></a>
</html>
