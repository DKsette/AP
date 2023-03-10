<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("bdd.php");
$pdo=connexion_bdd();
session_start();


$stmt = $pdo->prepare(" SELECT count(*) FROM user where loggin=? and mdp=?"); // Compte le nombre de fois ou l'on trouve $_POST['loggin'] et $_POST['mdp']
$loggin = $_POST['loggin'];
$mdp = $_POST['mdp'];
$stmt->execute(array($loggin,$mdp));
$_SESSION['loggin']= $_POST['loggin'];


while ($row = $stmt->fetch() ) 
{   
    $res=$row['count(*)'];
    echo $res;     
    if($res==1){
        $stmt= $pdo->prepare("SELECT `typerole` From `role`AS R Inner join `user` as U ON R.idrole=U.idrole WHERE loggin=?;");
        $stmt ->execute(array($_POST['loggin']));
        $trole = $stmt->fetch();
        $role = $trole['typerole'];
        $_SESSION['role']=$role;

        echo $role ;
        if($role=='Utilisateur'){
            echo "ca marche";
            header('location:user.php');
        }
        if($role=='Responsable'){
            echo "ca marche";
            header('location:responsable.php');
        }
        if($role=='Employé'){
            echo "ca marche";
            header('location:employe.php');
        }
       
}
    else{
    header('location:index.html');
     //echo"fail";
 }

}
?>