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
	$ReadSql = "SELECT * FROM `salle` ";

	$res = mysqli_query($con, $ReadSql);

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

<body class="pt-5">

	<div class="container">
		<div class="but row mt-3">
			<h2 class="mb-4">Liste des Salle</h2>
			<p>Voici les listes des tous les salle enregistrer <br> dans le base de données</p>

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

			<div class="row-4">
				<a href="createsalle.php">
					<button class="btn btn-primary" type="button">
						<i class="fa fa-plus"></i> &nbsp; Ajouter
					</button>
				</a>
			</div>
			<div class="libre">
			<form action="sallelibre.php" method="POST">
                                    <!-- <?php if (isset($_GET['sall'])) { ?>
                                        <div class="alert alert-danger" role="alert" style="width: 50%;">
                                            <?php echo "veuillez remplire tous les champs"; ?>
                                        </div>
                                    <?php } ?> -->
                                    <h3>recherche des salles libre</h3>

									<div class="sal">
										<input type="datetime-local" class="form-control mb-2" style="width : 50%;" name="recherche" placeholder="entre l'heure">
										&nbsp;<button class="btn btn-secondary mb-2" name="libre">recherche</button>		
									</div>
                                </form>

			</div>


		</div>

		<table class="table table-striped mt-3">
			<thead>
				<tr>
					<th>ID</th>
					<th>design</th>
					<th>occupation</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<?php while ($r = mysqli_fetch_assoc($res)) {
				?>

				<tr>
					<th scope="row">
						<?php echo $r['idsalle']; ?>
					</th>
					<td>
						<?php echo $r['design'] ;?>
					</td>
					<td>
						<?php echo $r['occupation'] ;?>
					</td>

					<td>
						<a href="updatesalle.php?idsalle=<?php echo $r['idsalle']; ?>" class="m-2">
							<i class="fa fa-edit fa-2x"></i>
						</a>
						<i class="fa fa-trash fa-2x" type="button" style="color: #f8300d;" data-bs-toggle="modal"
							data-bs-target="#exampleModal<?php echo $r['idsalle']; ?>">

						</i>

						<div class="modal fade" id="exampleModal<?php echo $r['idsalle']; ?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<p>etes vous sur de vouloir supprimer cette salle ?</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary"
											data-bs-dismiss="modal">Annuler</button>
										<a href="deletesalle.php?idsalle=<?php echo $r['idsalle']; ?>">
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
	<script src="./Resource/Bootstrap/bootstrap.min.js"></script>
	<script src="./Resource/jquery/js/jquery-1.12.4.min.js"></script>
</body>

</html>