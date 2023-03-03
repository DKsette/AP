
<?php
    //Affiche les erreurs !
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
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
$etat = $_POST['etatd'];
$prio = $_POST['priod'];
$user = $_POST['affecd'];
echo $etat;
echo $prio;
echo $user;
echo "<br> je dois faire la requête sql pour la modif et renvoyer sur responsable.php<br>";

if($etat!="--------"){
    echo"etat est diff de -------";
    if($prio!="--------"){
        echo"prio est diff de --------";
        if($user!="--------"){
            echo "user est diff de --------";
            //Faire ici la requête sql et renvoyer sur responnsable (ou faire le popup de confirmation)  

            
        }
        else{
            echo"user = --------";
        }
    }
    else{
        echo"prio = --------";
    }
}
else{
    echo "etat = --------";
}
?>