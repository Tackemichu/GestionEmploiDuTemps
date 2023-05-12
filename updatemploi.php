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
                        <h2 class="text-center font-weight-light my-4">Modifier emploi du temps</h2>
                        <p>Modifier les champs et enregistrer</p>
                    </div>

        <form action="modifemploi.php" method="POST">
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
                          $sql = "SELECT emploi_du_temps.id, salle.design, salle.occupation, professeur.nom, professeur.prenom, professeur.grade, classe.niveau, emploi_du_temps.cours, emploi_du_temps.date 
                         FROM emploi_du_temps 
                          JOIN salle ON emploi_du_temps.idsalle=salle.idsalle
                          JOIN professeur ON emploi_du_temps.idprof=professeur.idprof 
                          JOIN classe ON emploi_du_temps.idclasse=classe.idclasse";
                          $result = mysqli_query($link, $sql);
                          
                          while($rows = mysqli_fetch_assoc($result))
                          {
                            $selected = "";
                            if ($rox["idsalle"] == $idsalle)
                            {
                              $selected = "selected";
                            }
                            echo "<option value='" . $rows['idsalle'] . "' " .$selected . ">" . $rows['design'] ."</option>";
                          }
                       ?>
              </select>
            </div>

            <div class="col">
              <label for="classe" class="form-label">Classe:</label>
              <select name="idclasse" class="form-control">
                <option value="" disabled selected>Sélectionner une classe</option>
                <?php
                          $sql = "SELECT emploi_du_temps.id, salle.design, salle.occupation, professeur.nom, professeur.prenom, professeur.grade, classe.niveau, emploi_du_temps.cours, emploi_du_temps.date 
                         FROM emploi_du_temps 
                          JOIN salle ON emploi_du_temps.idsalle=salle.idsalle
                          JOIN professeur ON emploi_du_temps.idprof=professeur.idprof 
                          JOIN classe ON emploi_du_temps.idclasse=classe.idclasse";
                          $result = mysqli_query($link, $sql);
                          
                          while($rows = mysqli_fetch_assoc($result))
                          {
                            $selected = "";
                            if ($rox["idclasse"] == $idclasse)
                            {
                              $selected = "selected";
                            }
                            echo "<option value='" . $rows['idclasse'] . "' " .$selected . ">" . $rows['niveau'] . "</option>";
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
                          $sql = "SELECT emploi_du_temps.id, salle.design, salle.occupation, professeur.nom, professeur.prenom, professeur.grade, classe.niveau, emploi_du_temps.cours, emploi_du_temps.date 
                         FROM emploi_du_temps 
                          JOIN salle ON emploi_du_temps.idsalle=salle.idsalle
                          JOIN professeur ON emploi_du_temps.idprof=professeur.idprof 
                          JOIN classe ON emploi_du_temps.idclasse=classe.idclasse";
                          $result = mysqli_query($link, $sql);
                          
                          while($rows = mysqli_fetch_assoc($result))
                          {
                            $selected = "";
                            if ($rows["idprof"] == $idprof)
                            {
                              $selected = "selected";
                            }
                            echo "<option value='" . $rows['idprof'] ."' " .$selected .  ">" . $rows['nom'] . "</option>";
                          }
                       ?>
            </select>
          </div>

          <div class="rows">
            <div class="col">
            <label>cours:</label>
                                <input type="text" name="cours"
                                    class="form-control <?php echo (!empty($cours)) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback">
                                    <?php echo $cours;?>
                                </span>
            </div>

            <div class="col">
              <label for="date" class="form-label">Date:</label>
              <input type="datetime-local" name="date" class="form-control">
            </div>

          </div><br>

          <input type="submit" name="modifier" class="btn btn-primary" value="Modifier">
          <a href="indexemploi.php" class="btn btn-secondary ml-2">Annuler</a>
        </form>
      </div>

    </div>

  </div>
  <script src="./Resource/jquery/jquery.min.js"></script>
  <script src="./Resource/Bootstrap/bootstrap.min.js"></script>
</body>

</html>