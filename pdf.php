<?php
// Inclure le fichier de configuration
include("bdd.php");

// Inclure la bibliothèque FPDF
require('fpdf/fpdf.php');

// Créer une nouvelle instance de la classe FPDF
$pdf = new PDF_MC_Table();

// Ajouter une page
$pdf->AddPage();

// Définir la police et la taille du texte
$pdf->SetFont('Arial','B',16);

// Ajouter un titre
$pdf->Cell(0,10,'Liste des membres',0,1,'C');

// Ajouter un espace
$pdf->Ln(10);

// Définir les en-têtes de colonnes
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'ID',1,0,'C');
$pdf->Cell(30,10,'Nom',1,0,'C');
$pdf->Cell(30,10,'Prénom',1,0,'C');
$pdf->Cell(80,10,'Adresse',1,1,'C');

// Récupérer les données de la base de données
$stmt = $pdo->query('SELECT * FROM demmande');
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ajouter les données dans le tableau
$pdf->SetWidths(array(20, 30, 30, 80));

foreach($data as $row) {
  /*$pdf->Cell(20, 10, $row['id'], 1);
  $pdf->Cell(30, 10, $row['first'], 1);
  $pdf->Cell(30, 10, $row['last'], 1);
  $pdf->MultiCell(60, 10, $row['adress'], 1);*/
  $pdf->Row(array( $row['iddemande'],$row['idetat'],$row['idpriorité'], $row['assignement'], $row['iduser']));
}

// Positionnement à 1,5 cm du bas
$pdf->SetY(-20.1);
// Police Arial italique 8
$pdf->SetFont('Arial','I',8);
$pdf -> AliasNbPages();
// Numéro de page
$pdf->Cell(0,0,'Page '.$pdf->PageNo().'/{nb}',0,0,'C');


// Sortir le document PDF
$pdf->Output();


$connexion->close();
?>