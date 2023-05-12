<?php
require('fpdf/fpdf.php');

// Connexion à la base de données
include "config.php";

// Requête SQL pour récupérer les cours triés par date et heure, en français
$requete = "SELECT EMPLOI_DU_TEMPS.idclasse,EMPLOI_DU_TEMPS.idprof,EMPLOI_DU_TEMPS.idsalle, CLASSE.niveau, EMPLOI_DU_TEMPS.cours, EMPLOI_DU_TEMPS.date, PROFESSEUR.NOM, PROFESSEUR.PRENOM,PROFESSEUR.GRADE,SALLE.design, SALLE.occupation
        FROM EMPLOI_DU_TEMPS JOIN CLASSE ON EMPLOI_DU_TEMPS.idclasse = CLASSE.idclasse
        JOIN PROFESSEUR ON EMPLOI_DU_TEMPS.idprof = PROFESSEUR.idprof
        JOIN SALLE ON EMPLOI_DU_TEMPS.idsalle = SALLE.idsalle
        ORDER BY EMPLOI_DU_TEMPS.date";
$resultat = mysqli_query($link, $requete);

// Création d'un nouveau document PDF
$pdf = new FPDF();
$pdf->AddPage();

// Définition de la locale en français
setlocale(LC_TIME, 'fr_FR.utf8');
function jourEnFrancais($jour) {
    $joursEnFrancais = array(
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
        'Sunday' => 'Dimanche'
    );
    return $joursEnFrancais[$jour];
}

// Récupération de la date locale en français
$date = strftime('Aujord\'hui %d avril %Y');

// Ajout du contenu HTML
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, ($date), 0, 1, 'C');
$pdf->Cell(0, 15, "CALENDRIER PENDANT UNE SEMAINE", 0, 1, "C");
$pdf->Ln(15);

// Ajout du tableau
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(38, 10, "Date", 1, 0, "C");
$pdf->Cell(20, 10, "Heure", 1, 0, "C");
$pdf->Cell(30, 10, "Salle", 1, 0, "C");
$pdf->Cell(50, 10, "Professeur", 1, 0, "C");
$pdf->Cell(25, 10, "Classe", 1, 0, "C");
$pdf->Cell(25, 10, "Cours", 1, 0, "C");
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
if (mysqli_affected_rows($link) > 0) {
    while ($ligne = mysqli_fetch_assoc($resultat)) {
        $jour = date('l', strtotime($ligne['date']));
        $jourEnFrancais = jourEnFrancais($jour); // appel de la fonction
        $pdf->Cell(38, 10, "$jourEnFrancais\n".date('Y-m-d', strtotime($ligne['date'])), 1); // affichage du jour en français
        $pdf->Cell(20, 10, date('H:i', strtotime($ligne['date'])), 1);
        $pdf->Cell(30, 10, "{$ligne['design']}", 1);
        $pdf->Cell(50, 10, "{$ligne['NOM']} {$ligne['PRENOM']}", 1);
        $pdf->Cell(25, 10, "{$ligne['niveau']}", 1);
        $pdf->Cell(25, 10, "{$ligne['cours']}", 1);
        $pdf->Ln();
    }
    
}

// Appliquer les styles
$pdf->SetFillColor(150,150,150);
$pdf->SetMargins(20,0,10);
$pdf->Ln(10);

// Génération du fichier PDF
$pdf->Output('calendrier.pdf', 'D');
?>
