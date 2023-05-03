<?php
    //Affiche les erreurs !
    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);
    session_start();
    if(!$_SESSION['loggin']){
        header('Location: index.html'); };
    include("bdd.php");
    $pdo=connexion_bdd();

$etat=$_POST['etatd'];
$prio=$_POST['priod'];
$emp=$_POST['iduserd'];
$id=$_SESSION['idd'];
$user=$_SESSION['loggin']; // pour faire la redirection
//récup des infos
echo $_POST['etatd'] ." ";
echo $_POST['priod'] ." ";
echo $_POST['iduserd'] ." ";
echo $id ." ";
echo $user ." ";
if($prio!=""){
    if($emp!=""){
        if($etat!=""){
            echo "tout les éléments sont remplies ";
            //faire la requête sql pour retrouver l'id de qui ont vas attribuer la demande
            $stmt1= $pdo->prepare("SELECT iduser FROM user WHERE loggin = ?;");
            $stmt1 ->execute(array($emp));
            while($list1 = $stmt1->fetch()){
                $iduser= $list1['iduser'];}
            echo $iduser;
            //faire la requête sql
            $stmt= $pdo->prepare("UPDATE demmande SET idetat =?, idpriorite = ?, iduser = ? WHERE iddemande = $id");
            $stmt ->execute(array($etat,$prio,$iduser));
            echo " c'est bon";
            //récupérer le role du user connecter et le rediriger
            $stmt2= $pdo->prepare("SELECT idrole FROM user WHERE loggin = ?;");
            $stmt2 ->execute(array($user));
            while($list2 = $stmt2->fetch()){
                $idrole= $list2['idrole'];}
            echo $idrole;
            if($idrole==1){
                header('Location: responsable.php');
            }
            elseif($idrole==3){
                header('Location: employe.php');
            }


    }
    else{
        echo"erreur";}
}
else
{echo"erreur";}
}
else{echo"erreur";}
?>