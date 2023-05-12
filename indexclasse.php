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
	$ReadSql = "SELECT * FROM `classe` ";

	$res = mysqli_query($con, $ReadSql);

 ?>


<!DOCTYPE html>
<html>

<head>
	<title>Renseignement-classe</title>
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

	<div class="container col-ml-4">
		<div class="row mt-3">
			<h2 class="mb-4"> Liste des Classe</h2>
			<p>Voici les listes des tous les classe enregistrer <br> dans le base de données</p>

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
				<a href="createclasse.php">
					<button class="btn btn-primary" type="button">
						<i class="fa fa-plus"></i> &nbsp; Ajouter
					</button>
				</a>
			</div>

		</div>

		<table class="table table-striped mt-3">
			<thead>
				<tr>
					<th>ID</th>
					<th>niveau</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<?php while ($r = mysqli_fetch_assoc($res)) {
				?>

				<tr>
					<th scope="row">
						<?php echo $r['idclasse']; ?>
					</th>
					<td>
						<?php echo $r['niveau'] ;?>
					</td>

					<td>
						<a href="updateclasse.php?idclasse=<?php echo $r['idclasse']; ?>" class="m-2">
							<i class="fa fa-edit fa-2x"></i>
						</a>
						<i class="fa fa-trash fa-2x" type="button" style="color: #f8300d;" data-bs-toggle="modal"
							data-bs-target="#exampleModal<?php echo $r['idclasse']; ?>">

						</i>

						<div class="modal fade" id="exampleModal<?php echo $r['idclasse']; ?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<p>etes vous sur de vouloir supprimer cette classe ?</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary"
											data-bs-dismiss="modal">Annuler</button>
										<a href="deleteclasse.php?idclasse=<?php echo $r['idclasse']; ?>">
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