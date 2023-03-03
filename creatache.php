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
}//fin fonction connexion_bdd
$loggin=$_SESSION['loggin'];
$pdo=connexion_bdd();
$stmt= $pdo->prepare("SELECT `iduser` From `user`WHERE loggin=?;");
$stmt ->execute(array($loggin));
$iduser = $stmt->fetch();
//echo $loggin;
//echo $iduser['iduser'];



$stmt2 = $pdo->prepare("INSERT INTO demmande (iddemande, idetat, idpriorite, assignement, iduser ) VALUES (null,1,4,?,?)");
$tache = $_POST['tache'];
$stmt2->execute(array($tache,$iduser['iduser']));

echo"Votre demande a bien été pris en compte ! <br/>";
echo '<a href="user.php">Continuer</a>';
?>
