<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}

?>

<?php
  include "reademploi.php";

$sqli = "SELECT emploi_du_temps.id, salle.design, salle.occupation, professeur.nom, professeur.prenom, professeur.grade, classe.niveau, emploi_du_temps.cours, emploi_du_temps.date 
FROM emploi_du_temps 
JOIN salle ON emploi_du_temps.idsalle=salle.idsalle
JOIN professeur ON emploi_du_temps.idprof=professeur.idprof 
JOIN classe ON emploi_du_temps.idclasse=classe.idclasse";
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

    <div class="container">

        <div class="mt-4">
            <div class="input-group">
                <input type="text" class="form-control" id="search" placeholder="Enter une classe">
            </div>

            <h2 class="mb-4">Liste d'emploi du temps</h2>
            <p>Voici notre emploi du temps !</p>
        </div>

        <div class="row-4">
            <a href="createmploi.php">
                <button class="btn btn-primary" type="button">
                    <i class="fa fa-plus"></i>&nbsp; Ajouter
                </button>
            </a>

            <a href="calendrier.php">
                <button class="btn btn-primary" type="button">
                    <i class="fa fa-calendar"></i>&nbsp; Calendrier
                </button>
            </a>
            <div class="main-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-wrapper">

                            <?php
                        if(isset($_GET['success'])){
                            ?>
                            <div class="alert alert-success alert-dismissible" style="margin-top: 3px;">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <?php echo $_GET['success']; ?>
                            </div>
                            <?php
                        }
                        $result = mysqli_query($link, $sqli);
                    ?>
                            <?php  if (mysqli_num_rows($result)){?>

                            <table class="table table-striped table-bordered mt-3">
                                <thead>
                                    <tr class="text-center sorting">
                                        <th><strong>Date et Heure</strong></th>
                                        <th class="selected"><strong>Niveau</strong></th>
                                        <th><strong>Salle</strong></th>
                                        <th><strong>Cours</strong></th>
                                        <th><strong>professeurs</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                    <?php 
                                        while($rows = mysqli_fetch_assoc($result)){
                                   ?>
                                    <tr class="emplo">
                                        <td>
                                            <?=$rows['date']?>
                                        </td>
                                        <td>
                                            <?=$rows['niveau']?>
                                        </td>
                                        <td>
                                            <?=$rows['design']?>
                                        </td>
                                        <td>
                                            <?=$rows['cours']?>
                                        </td>
                                        <td>
                                            <?=$rows['nom']?>
                                            <?=$rows['prenom']?>
                                        </td>
                                        <td>

                                            <a href="updatemploi.php" class="m-2">
                                                <i class="fa fa-edit fa-2x"></i>
                                            </a>
                                       
                                            <a href="#">
                                                <i class="fa fa-trash fa-2x" style="color: #f8300d;<?php echo $rows['id'];?>"
                                                    data-bs-toggle="modal" data-bs-target="#supModal">

                                                </i>
                                            </a>


                                            <div class="modal fade" id="supModal" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <p>etes vous sur de vouloir supprimer cette <br> emploi
                                                                du temps ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <a href="deletemploi.php?id=<?php echo $rows['id']; ?>">
                                                                <button class="btn btn-danger"
                                                                    type="button">Confirmer</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
									}
									?>

                                </tbody>
                                <?php 
                      }
                    ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#search").on("keyup", function () {
                    var selectedValue = $(this).val().toLowerCase();
                    $("#table tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(selectedValue) > -1)
                    });
                });
            });
        </script>
        <script src="./Resource/jquery/jquery.min.js"></script>
        <script src="./Resource/Bootstrap/bootstrap.min.js"></script>

        <?php
?>

</body>

</html>