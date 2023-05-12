<?php
session_start();
?>

<?php
include 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Resource/css/style.css">
    <link rel="stylesheet" href="./Resource/css/style2.css">
    <link rel="stylesheet" href="./Resource/Bootstrap/bootstrap.min.css">
    <title>Connection</title>
</head>
<body>
<div class="container-fluid
">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <i class="fa-regular fa-user fa-flip"></i>
              <h3 style="text-align: center;">CONNECTION</h3>
              <h6 class="font-weight-light" style="text-align: center;">Connecte vous pour continuer.</h6>
              <form action="connection.php" method="POST" class="pt-3">
                        <?php
                        if(isset($_GET['error'])){
                            ?> 
                            <p class="error"><?php echo $_GET['error']; ?></p>
                            <?php
                        
                        ?>
                        <?php }
                            if(isset($_GET['email'])){
                                $email = $_GET['email'];
                            }else $email = '';           
                        ?>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" value="<?=$email?>" placeholder="Addresse email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="mdp" placeholder="Mot de passe">
                </div>
                <div class="mt-3" style="text-align: center;">
                <button type="submit" class="btn btn-block btn-primary">
                  CONNECTER
                </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                 <h6>Vous-n'avez pas de compte?</h6><a href="connection/creecompte.php" class="text-primary">Crée</a>
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



<!--  -->
<!--  -->
<script src="./Resource/Bootstrap/bootstrap.min.js"></script>

</body>
</html>