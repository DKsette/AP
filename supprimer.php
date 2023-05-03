<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!$_SESSION['loggin']);
include("bdd.php");
$pdo=connexion_bdd();
$id=$_GET['demande'];
echo $id;


$stmt = $pdo->prepare(" DELETE FROM demmande  WHERE iddemande=?"); 
$stmt->execute(array($id));
header("Location: responsable.php");
?>