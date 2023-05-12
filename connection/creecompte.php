<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Resource/css/style.css">
    <link rel="stylesheet" href="../Resource/css/style2.css">
    <link rel="stylesheet" href="../Resource/Bootstrap/bootstrap.min.css">
    <title>Crée un compte</title>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4  style="text-align: center;">CREE UN COMPTE</h4>
              <h6 class="font-weight-light"></h6>
              <form action="conncreecompte.php" method="POST" class="pt-3">

              <?php if(isset($_GET['success']))
                        {        
                            ?> <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php  
                        }
                    ?>

                    <?php if(isset($_GET['error']))
                        {        
                            ?> <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php  
                        }
                    ?>
                    
              <?php 
                if(isset($_GET['nom'])){
                    $nom = $_GET['nom'];
                }else $nom = '';

                if(isset($_GET['prenom'])){
                    $prenom = $_GET['prenom'];
                }else $prenom = '';

                if(isset($_GET['email'])){
                    $email = $_GET['email'];
                }else $email = '';
              
              ?>
                <div class="form-group">
                  <input type="text" name="nom" value="<?=$nom?>" class="form-control form-control-lg"  placeholder="Nom">
                </div>
                <div class="form-group">
                  <input type="prenom" name="prenom" value="<?=$prenom?>" class="form-control form-control-lg"  placeholder="Prénom">
                </div>
                <div class="form-group">
                  <input type="email" name="email" value="<?=$email?>" class="form-control form-control-lg"  placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="mdp" class="form-control form-control-lg"  placeholder="Mot de passe">
                </div>
                <div class="mt-3"  style="text-align: center;">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                  CREE
                </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Vous avez deja un compte ?<a href="../login.php" class="text-primary"><span></span>Connecte</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>       
</body>
</html>


              
