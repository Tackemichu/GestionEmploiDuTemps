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
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
   <title>Gestion d’emploi du temps</title>

   <link rel="stylesheet" href="./Resource/css/style.css">
   <link rel="stylesheet" href="./Resource/Bootstrap/bootstrap.min.css">

</head>

<body>

   <div class="container">
      <div id="content">

         <div class="top-navbar">
            <div class="xd-topbar">
               </div>
               <div class="xp-breadcrumbbar text-center">
                  <h4 class="page-title">Voir emploi du temps</h4>
               </div>


            </div>
         </div>
         <div class="main-content"
            style="display: flex; justify-content: center; align-items: center; margin-left: 40px;">
            <div class="">
               <div class="">
                  <div class="">
                     <div class="login-box">
                        <form action="connmodifier.php" method="POST">
                           <div class="input-box">
                              <h5><label for="">Salle:</label></h5>
                              <?php                
                          $sql = "SELECT design FROM salle";
                          $result = mysqli_query($link, $sql);
                          
                          if($row = mysqli_fetch_assoc($result))
                          {
                            echo "<p>" . $row['design'] . "</p>";
                          }
                       ?>

                           </div>

                           <div class="input-box">
                              <h5><label for="">Classe:</label></h5>
                              <?php
                          $sql = "SELECT niveau FROM classe ";
                          $result = mysqli_query($link, $sql);
                          
                          if($row = mysqli_fetch_assoc($result))
                          {
                            echo "<p>" . $row['niveau'] . "</p>";
                          }
                       ?>
                           </div>

                           <div class="input-box">
                              <h5><label for="">Professeur:</label></h5>
                              <?php
                          $sql = "SELECT idprof, nom, prenom FROM professeur ";
                          $result = mysqli_query($link, $sql);
                          
                          if($row = mysqli_fetch_assoc($result))
                          {
                            echo "<p>" . $row['nom'] . "  " . $row['prenom'] . "</p>";
                          }
                       ?>
                           </div>

                           <div class="input-box">
                              <h5><label for="">cours:</label></h5>
                              <?php
                          $sql = "SELECT * FROM emploi_du_temps ";
                          $result = mysqli_query($link, $sql);
                          
                          if($row = mysqli_fetch_assoc($result))
                          {
                            echo "<p>" . $row['cours'] . "</p>";
                          }
                       ?> 
                           </div>

                           <div class="input-box">
                              <h5><label for="">date:</label></h5>
                              <?php
                          $sql = "SELECT * FROM emploi_du_temps ";
                          $result = mysqli_query($link, $sql);
                          
                          if($row = mysqli_fetch_assoc($result))
                          {
                            echo "<p>" . $row['date'] . "</p>";
                          }
                       ?>
                           </div>


                           <a href="indexemploi.php" class="btn btn-info ml-2">Retour</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>

         </div>
         <script src="./Resource/jquery/jquery.min.js"></script>
         <script src="./Resource/Bootstrap/bootstrap.min.js"></script>
</body>

</html>