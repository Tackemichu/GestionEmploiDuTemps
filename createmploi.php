<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>creer emploi du temp</title>
  <link rel="stylesheet" href="./Resource/css/style.css">
  <link rel="stylesheet" href="./Resource/css/sidebars.css">
  <link rel="stylesheet" href="./Resource/css/stylebar.css">
  <link rel="stylesheet" href="./Resource/Bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="./Resource/font-awesome/css/font-awesome.min.css">
</head>

<body class="pt-2">

  <?php
		include './template/navbar.php';
        include './template/sidebar.php';
	 ?>

  <div class="formul_emploi">
    <div class="wrapper mb-5">
      <div id="content">

      <div class="card-header">
                        <h2 class="text-center font-weight-light my-4">Créer un emploi du temps</h2>
                        <p>Remplir les formulaires pour enregistrer une emploi du temps</p>
                    </div>

        <form action="code.php" method="POST">
          <?php
                        if(isset($_GET['error'])){
                            ?>
          <p class="error">
            <?php echo $_GET['error']; ?>
          </p>
          <?php
                        }
                    ?>
          <div class="row">

            <div class="col">
              <label for="salle" class="form-label">Salle:</label>
              <select name="idsalle" class="form-control">
                <option value="" disabled selected>Sélectionner une salle</option>
                <?php                
                          $sql = "SELECT * FROM salle WHERE occupation='non'";
                          $result = mysqli_query($link, $sql);
                          
                          while($row = mysqli_fetch_assoc($result))
                          {
                            echo "<option value='" . $row['idsalle'] . "'>" . $row['design'] ."</option>";
                          }
                       ?>
              </select>
            </div>

            <div class="col">
              <label for="classe" class="form-label">Classe:</label>
              <select name="idclasse" class="form-control">
                <option value="" disabled selected>Sélectionner une classe</option>
                <?php
                          $sql = "SELECT * FROM classe ";
                          $result = mysqli_query($link, $sql);
                          
                          while($row = mysqli_fetch_assoc($result))
                          {
                            echo "<option value='" . $row['idclasse'] . "'>" . $row['niveau'] . "</option>";
                          }
                       ?>
              </select>
            </div>
          </div>

          <div class="mb-3 mt-3">
            <label for="profe" class="form-label">Professeur:</label>
            <select name="idprof" class="form-control" style="width: 100%;">
              <option value="" disabled selected>Sélectionner un professeur</option>
              <?php
                          $sql = "SELECT * FROM professeur ";
                          $result = mysqli_query($link, $sql);
                          
                          while($row = mysqli_fetch_assoc($result))
                          {
                            echo "<option value='" . $row['idprof'] . "'>" . $row['nom'] . " " . $row['prenom'] . "</option>";
                          }
                       ?>
            </select>
          </div>

          <div class="row">
            <div class="col">
              <label for="cours" class="form-label">Cours:</label>
              <input type="text" name="cours" class="form-control">
            </div>

            <div class="col">
              <label for="date" class="form-label">Date:</label>
              <input type="datetime-local" name="date" class="form-control">
            </div>

          </div><br>

          <input type="submit" name="ajoute" class="btn btn-primary" value="Enregistrer">
          <a href="indexemploi.php" class="btn btn-secondary ml-2">Annuler</a>
        </form>
      </div>

    </div>

  </div>
  <script src="./Resource/jquery/jquery.min.js"></script>
  <script src="./Resource/Bootstrap/bootstrap.min.js"></script>
</body>

</html>