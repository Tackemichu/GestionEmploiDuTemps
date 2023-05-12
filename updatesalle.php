<?php
// Inclure le fichier
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
 
// Definir les variables
$design = $occupation = "";
$design_err = $occupation_err = "";
 
// verifier la valeur id dans le post pour la mise à jour
if(isset($_POST["idsalle"]) && !empty($_POST["idsalle"])){
    // recuperation du champ chaché
    $idsalle = $_POST["idsalle"];
    
    // Validate design
    $input_design = trim($_POST["design"]);
    if(empty($input_design)){
        $design_err = "Veuillez entrer un design.";
    } else if(strlen($input_design) > 50){
        $design_err = "Le design ne doit pas dépasser 50 caractères.";
    } else{
        $design = $input_design;
    }
    
    // Validate occupation
    $input_occupation = trim($_POST["occupation"]);
    if(empty($input_occupation)){
        $occupation_err = "Veuillez entrez une occupation.";     
    } else{
        $occupation= $input_occupation;
    }
    
    // verifier les erreurs avant modification
    if(empty($design_err) && empty($occupation_err)){
        // Prepare an update statement
        $sql = "UPDATE salle SET design=?, occupation=? WHERE idsalle=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "ssi", $param_design, $param_occupation, $param_idsalle);
            
            // Set parameters
            $param_design = $design;
            $param_occupation = $occupation;
            $param_idsalle = $idsalle;
            
            // executer
            if(mysqli_stmt_execute($stmt)){
                // enregistremnt modifié, retourne
                header("location: indexsalle.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue : " . mysqli_error($link);

            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // si il existe un paramettre id
    if(isset($_GET["idsalle"]) && !empty(trim($_GET["idsalle"]))){
        // recupere URL parameter
        $idsalle =  trim($_GET["idsalle"]);
        
        // Prepare la requete
        $sql = "SELECT * FROM salle WHERE idsalle = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "i", $param_idsalle);
            
            // Set parameters
            $param_idsalle = $idsalle;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* recupere l'enregistremnt */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // recupere les champs
                    $design = $row["design"];
                    $occupation = $row["occupation"];
                } else{
                    // pas de id parametter valid, retourne erreur
                    header("location: errorsalle.php");
                    exit();
                }
                
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // pas de id parametter valid, retourne erreur
        header("location: errorsalle.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mise a jours salle</title>
	    <link rel="stylesheet" href="./Resource/css/style.css">
        <link rel="stylesheet" href="./Resource/css/stylebar.css">
        <link rel="stylesheet" href="./Resource/css/sidebars.css">
        <link rel="stylesheet" href="./Resource/Bootstrap/bootstrap.min.css">
	    <link rel="stylesheet" href="./Resource/font-awesome/css/font-awesome.min.css">
        <style>
        .wrapper {
            width: 700px;
            margin: 0 auto;
            }
         </style>
       	<style>
        .wrapper {
            width: 700px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }

        .nav-link:hover {
            background-color: rgb(33, 134, 216);
        }
        </style>

        </head>

        <?php
		include './template/navbar.php';
        include './template/sidebar.php';
	 ?>

        <body class="pt-5">
        <main>
		<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mise à jour de salle</h2>
                    <p>Modifier la salle et enregistrer</p>
                    <form action="#" method="post">
                       <div class="form-group">
                            <label>Design</label>
                            <input type="text" name="design" class="form-control <?php echo (!empty($design_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $design; ?>">
                            <span class="invalid-feedback"><?php echo $design_err;?></span>
                        </div>
                        <div class="form-group"><br>
                            <label>Occupation</label><br>
                            <label>
                                <input type="radio" name="occupation" value="Oui" <?php if($occupation =="oui" ) 
                                    echo "checked" ; ?>>
                                Oui
                            </label><br>
                            <label>
                                <input type="radio" name="occupation" value="Non" <?php if($occupation =="non")
                                 echo "checked" ; ?>>
                                Non
                            </label><br>
                            <span class="invalid-feedback">
                                <?php echo $occupation_err;?>
                            </span>
                        </div><br>
                        <input type="hidden" name="idsalle" value="<?php echo $idsalle; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Modifier">
                        <a href="indexsalle.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
 </main>
<script src="./Resource/Bootstrap/bootstrap.min.js"></script>
<script src="./Resource/jquery/js/jquery-1.12.4.min.js"></script>
    </body>
</html>
