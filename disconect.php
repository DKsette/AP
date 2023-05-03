<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!$_SESSION['loggin']);
include("bdd.php");
$pdo=connexion_bdd();

session_destroy();
header('Location: index.html');
?>