<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
?>
<?php
	require_once ('connect.php');
	$ReadSql = "SELECT * FROM `professeur` ";
	$res = mysqli_query($con, $ReadSql);
 ?>


<!DOCTYPE html>
<html>

<head>
    <title>Renseignement-prof</title>
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
    <div class="container pt-3">
        <div class="row">
            <div class="recherche input-group mb-4">
                <input type="text" class="form-control" id="search" placeholder="Recherche...">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" disabled><i class="fa fa-search"></i></button>
                </span>
            </div>

            <h2 class="mb-4">Liste des Professeurs</h2>
            <p>Voici les listes des tout(e) les professeurs enregistrer <br> dans le base de données</p>

            <div class="row-4">
                <a href="create.php">
                    <button class="btn btn-primary" type="button">
                        <i class="fa fa-plus"></i> &nbsp; Ajouter
                    </button>
                </a>
                <?php
                        if(isset($_GET['success'])){
                            ?>
            <div class="alert alert-success alert-dismissible" style="margin-top: 3px;">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?php echo $_GET['success']; ?>
            </div>
            <?php
                        }
                    ?>
            </div>

        </div>
        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="searchable">Nom</th>
                    <th class="searchable">Prenom</th>
                    <th class="searchable">grade</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody id="table">
                <?php while ($r = mysqli_fetch_assoc($res)) { ?>

                <tr>
                    <th scope="row">
                        <?php echo $r['idprof']; ?>
                    </th>
                    <td>
                        <?php echo $r['nom'] ;?>
                    </td>
                    <td>
                        <?php echo $r['prenom']; ?>
                    </td>
                    <td>
                        <?php echo $r['grade']; ?>
                    </td>

                    <td>
                        <a href="update.php?idprof=<?php echo $r['idprof']; ?>" class="m-2">
                            <i class="fa fa-edit fa-2x"></i>
                        </a>
                        <i class="fa fa-trash fa-2x" type="button" style="color: #f8300d;" data-bs-toggle="modal"
                            data-bs-target="#exampleModal<?php echo $r['idprof']; ?>">

                        </i>

                        <div class="modal fade" id="exampleModal<?php echo $r['idprof']; ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>etes vous sur de vouloir supprimer cette professeur ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <a href="delete.php?idprof=<?php echo $r['idprof']; ?>">
                                            <button class="btn btn-danger" type="button">Confirmer</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1 )
                });
            });
        });
    </script>
    <script src="./Resource/Bootstrap/bootstrap.min.js"></script>
    <script src="./Resource/jquery/jquery.min.js"></script>

</body>

</html>