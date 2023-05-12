<?php
// Connexion à la base de données
require "config.php";

// Requête SQL pour récupérer les cours triés par date et heure
$requete = "SELECT EMPLOI_DU_TEMPS.idclasse,EMPLOI_DU_TEMPS.idprof,EMPLOI_DU_TEMPS.idsalle, CLASSE.niveau, EMPLOI_DU_TEMPS.cours, EMPLOI_DU_TEMPS.date, PROFESSEUR.NOM, PROFESSEUR.PRENOM,PROFESSEUR.GRADE,SALLE.design, SALLE.occupation
        FROM EMPLOI_DU_TEMPS JOIN CLASSE ON EMPLOI_DU_TEMPS.idclasse = CLASSE.idclasse
        JOIN PROFESSEUR ON EMPLOI_DU_TEMPS.idprof = PROFESSEUR.idprof
        JOIN SALLE ON EMPLOI_DU_TEMPS.idsalle = SALLE.idsalle ORDER BY EMPLOI_DU_TEMPS.date";
$resultat = mysqli_query($link, $requete);

?>
<!DOCTYPE html>
<html>

<head>
<title>Renseignement-emploi</title>
    <link rel="stylesheet" href="./Resource/css/style.css">
    <link rel="stylesheet" href="./Resource/css/stylebar.css">
    <link rel="stylesheet" href="./Resource/css/sidebars.css">
    <link rel="stylesheet" href="./Resource/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./Resource/Bootstrap/bootstrap.min.css">
</head>

<?php
		include './template/navbar.php';
		include './template/sidebar.php';
	 ?>

<body>
    <!-------sidebar--design------------>
    <div id="content">
        <div class="top-navbar mb-5 pt-3">
        <div class="container mt-5 mb-5 " style="width: 100%;">
            <h2>Calendrier pendant une semaine</h2><br>
            <table class="table table-bordered table-striped table-hover dataTable no-footer">
                <thead class="table table-striped table-bordered mt-3">
                    <tr class="text-center sort">
                        <th><strong>Date</strong></th>
                        <th><strong>Heure</strong></th>
                        <th><strong>salle</strong></th>
                        <th><strong>professeur</strong></th>
                        <th><strong>classe</strong></th>
                        <th><strong>cours</strong></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 

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

                    
                    if (mysqli_affected_rows($link) > 0) {
                        while ($ligne = mysqli_fetch_assoc($resultat)) {
                            $jour = date('l', strtotime($ligne['date']));
                            $jourEnFrancais = jourEnFrancais($jour); ?>

                    <tr class="text-center sort">
                        <td>
                            <?= "$jourEnFrancais\n" ." ". date('Y-m-d', strtotime($ligne['date'])) ?>
                        </td>
                        <td>
                            <?= date('H:i', strtotime($ligne['date']))?>
                            
                        </td>
                        <td>
                            <?= $ligne['design'] ?>
                        </td>
                        <td>
                            <?= $ligne['NOM'] ?>
                            <?= $ligne['PRENOM'] ?>
                        </td>
                        <td>
                            <?= $ligne['niveau'] ?>
                        </td>
                        <td>
                            <?= $ligne['cours'] ?>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
            <?php } ?>
            <a href="pdf.php" class="btn btn-primary"><i class="fa fa-print"></i>&nbsp;Pdf</a>
            <a href="indexemploi.php" class="btn btn-secondary">retour</a><br><br>
        </div>
</body>

</html>