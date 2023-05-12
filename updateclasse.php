<?php
// Inclure le fichier
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
 
// Definir les variables
$niveau = "";
$niveau_err = "";
 
// verifier la valeur id dans le post pour la mise à jour
if(isset($_POST["idclasse"])){
    // recuperation du champ chaché
    $idclasse = $_POST["idclasse"];
    
    // Validate niveau
    $input_niveau = trim($_POST["niveau"]);
    if(empty($input_niveau)){
        $niveau_err = "Veuillez entrez le niveau.";     
    } 
    else{
        $niveau = $input_niveau;
    }
    // verifier les erreurs avant modification
    if(empty($niveau_err)){
        // Prepare an update statement
        $sql = "UPDATE classe SET niveau=? WHERE idclasse=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "si", $param_niveau, $param_idclasse);
            
            // Set parameters
            $param_niveau = $niveau;
            $param_idclasse = $idclasse;
            
            // executer
            if(mysqli_stmt_execute($stmt)){
                // enregistremnt modifié, retourne
                header("location: indexclasse.php");
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
    if(isset($_GET["idclasse"]) && !empty(trim($_GET["idclasse"]))){
        // recupere URL parameter
        $idclasse =  trim($_GET["idclasse"]);
        
        // Prepare la requete
        $sql = "SELECT * FROM classe WHERE idclasse = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "i", $param_idclasse);
            
            // Set parameters
            $param_idclasse = $idclasse;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* recupere l'enregistremnt */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // recupere les champs
                    $niveau = $row["niveau"];
                } else{
                    // pas de id parametter valid, retourne erreur
                    header("location: errorclasse.php");
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
        header("location: errorclasse.php");
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
    <title>Mise a jours classe</title>
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
                        <h2 class="mt-5">Mise à jour de classe</h2>
                        <p>Modifier les classe et enregistrer</p>
                        <form action="#" method="post">
                            <div class="form-group">
                                <label>Niveau</label>
                                <input type="text" name="niveau"
                                    class="form-control <?php echo (!empty($niveau_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $niveau; ?>">
                                <span class="invalid-feedback">
                                    <?php echo $niveau_err;?>
                                </span>
                            </div><br>
                            <input type="hidden" name="idclasse" value="<?php echo $idclasse; ?>" />
                            <input type="submit" class="btn btn-primary" value="Modifier">
                            <a href="indexclasse.php" class="btn btn-secondary ml-2">Annuler</a>
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