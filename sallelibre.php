<?php
include "config.php";
function validate($donne)
{
    $donne = trim($donne);
    $donne = htmlspecialchars($donne);
    $donne = stripslashes($donne);
    return $donne;
}
if (isset($_POST['libre'])) {
    $Non = validate($_POST['recherche']);
    // if(empty($libre)){
    //     header("location:indexsalle.php?sall=");
    // }

 
    $rech =  "SELECT idsalle,design FROM salle WHERE occupation = 'Non' AND idsalle NOT IN (
    SELECT idsalle FROM EMPLOI_DU_TEMPS WHERE date = '$Non')";
    $resultat = mysqli_query($link, $rech);
}

?>
<!DOCTYPE html>
<html>

<head>
<title>Renseignement-salle</title>
    <link rel="stylesheet" href="./Resource/css/style.css">
    <link rel="stylesheet" href="./Resource/css/stylebar.css">
    <link rel="stylesheet" href="./Resource/css/sidebars.css">
    <link rel="stylesheet" href="./Resource/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./Resource/font-awesome/css/font-awesome.min.css">
</head>


<?php
		include './template/navbar.php';
		include './template/sidebar.php';
	 ?>


<body>
    <div class="content pt-5 mt-5">
        <center><h3 >liste des salles libre</h3></center>
        <div class="container mt-5 mb-5 " style="width: 60%;">
    <div class="main-container" style="color: #000;">
        <table class="table table-bordered table-striped table-hover dataTable no-footer">
            <thead>
                <tr  class="text-center sorting">
                    <th><strong>idsalle</strong></th>
                    <th><strong>design</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_affected_rows($link) > 0) {
                    while ($rows = mysqli_fetch_assoc($resultat)) {
                        $idsalle = $rows['idsalle']
                ?>
                        <tr class="text-center sorting">
                            <td>S<?= $idsalle ?></td>
                            <td><?= $rows['design'] ?></td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Aucun salle trouver a cette heure.</p>
    <?php } ?>
    <a href="indexsalle.php" class="btn btn-primary mb-2">retour</a>

    </div>
</div>
</body>

</html>