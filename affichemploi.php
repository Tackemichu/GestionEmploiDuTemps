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
  


<div class="container mb-6">
   
      <div class="row pt-5">
		     
		 
	  <h2 class="mb-4">Liste d'Emploi du temps</h2>
            <p>Voici notre emploi du temps !</p>

            <div>
                <a href="createmploi.php">
                    <button class="btn btn-primary" type="button">
                        <i class="fa fa-plus"></i> &nbsp; Ajouter
                    </button>
                </a>

                <a href="emploi-du-temps.php" target="_blank">
    <button class="btn btn-primary" type="button">
        <i class="fa fa-calendar"></i> &nbsp; voir plus
    </button>
</a>
            </div>
		     
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
                    ?>
                  <?php  if (mysqli_num_rows($result)){?>
					   
					   <table class="table table-striped table-bordered mt-3">
					      <thead>
						     <tr class="text-center sorting">
							 <th><strong>Date et Heure</strong></th>
							 <th><strong>Niveau</strong></th>
							 <th><strong>Salle</strong></th>
							 <th><strong>Cours</strong></th>
							 <th><strong>professeurs</strong></th>
							 <th><strong>Actions</strong></th>
							 </tr>
						  </thead>		  
						  <tbody>
									<?php 
                                        while($rows = mysqli_fetch_assoc($result)){
                                   ?>
									<tr class="emplo">
										<td><?=$rows['date']?></td>
										<td><?=$rows['niveau']?></td>
										<td><?=$rows['design']?></td>
										<td><?=$rows['cours']?></td>
										<td><?=$rows['nom']?> <?=$rows['prenom']?></td>
										<td>
                                      <a href="modif-emtem.php?idprof=<?=$rows['idprof']?>&idclasse=<?=$rows['idclasse']?>&idsalle=<?=$rows['idsalle']?>">
	<i class="mdi mdi-pencil"></i>
</a>
<a href="supprime.php" class="delete">
	<i class="mdi mdi-delete"></i>
</a>

                        <div class="modal fade" id="exampleModal<?php echo $rows['idprof']; ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>etes vous sur de vouloir supprimer cette professeur ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <a href="delete.php?idprof=<?php echo $rows['idprof']; ?>">
                                            <button class="btn btn-danger" type="button">Confirmer</button>
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
    <script src="./Resource/jquery/jquery.min.js"></script>
   <script src="./Resource/Bootstrap/bootstrap.min.js"></script>
  </body> 
  </html>


