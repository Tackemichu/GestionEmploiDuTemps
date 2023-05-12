<?php
// Inclure le fichier config
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
 
// Définir les variables
$design = $occupation = "";
$design_err = $occupation_err = "";
 
// Traitement
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validation du champ design
    $input_design = trim($_POST["design"]);
    if(empty($input_design)){
        $design_err = "Veuillez entrer un design.";
    } else if(strlen($input_design) > 50){
        $design_err = "Le design ne doit pas dépasser 50 caractères.";
    } else{
        $design = $input_design;
    }
    
    // Validation du champ occupation
    $input_occupation = trim($_POST["occupation"]);
    if(empty($input_occupation)){
        $occupation_err = "Veuillez entrer une occupation.";
    } else if(strlen($input_occupation) > 50){
        $occupation_err = "L'occupation ne doit pas dépasser 50 caractères.";
    } else if($input_design == $input_occupation){
        $occupation_err = "Le champ occupation doit être différent du champ design.";
    } else{
        $occupation = $input_occupation;
    }
    
    // Vérification des erreurs avant enregistrement
    if(empty($design_err) && empty($occupation_err)){
        // Préparation de la requête préparée
        $sql = "INSERT INTO salle (design, occupation) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables à la requête préparée
            mysqli_stmt_bind_param($stmt, "ss", $param_design, $param_occupation);
            
            // Définir les paramètres
            $param_design = $design;
            $param_occupation = $occupation;
            
            // Exécution de la requête
            if(mysqli_stmt_execute($stmt)){
                // Opération effectuée, redirection
                header("location: indexsalle.php");
                exit();
            } else{
             echo 'Erreur: ' . mysqli_error($link);
            }
        } else {
            echo "Oops! Une erreur est survenue lors de la préparation de la requête préparée.";
        }
         
        // Fermeture de la requête préparée
        mysqli_stmt_close($stmt);
    }
    
    // Fermeture de la connexion
    mysqli_close($link);
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
    <title>Voir le renseignement</title>
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
                        <h2 class="mt-5">Créer un enregistrement</h2>
                        <p>Remplir le formulaire pour enregistrer les salle dans la base de données</p>

                        <form action="#" method="post">
                            <div class="form-group">
                                <label>design</label>
                                <input type="text" name="design"
                                    class="form-control <?php echo (!empty($design_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $design; ?>">
                                <span class="invalid-feedback">
                                    <?php echo $design_err;?>
                                </span>
                            </div><br>
                            <div class="form-group">
                                <label>Occupation</label><br>
                                <label>
                                    <input type="radio" name="occupation" value="Oui" <?php if($occupation=="oui" )
                                        echo "checked" ; ?>>
                                    Oui
                                </label><br>
                                <label>
                                    <input type="radio" name="occupation" value="Non" <?php if($occupation=="non" )
                                        echo "checked" ; ?>>
                                    Non
                                </label><br>
                                <span class="invalid-feedback">
                                    <?php echo $occupation_err;?>
                                </span>
                            </div>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Enregistrer">
                            <a href="indexsalle.php" class="btn btn-secondary ml-2">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>
    <script src="./Resource/Bootstrap/bootstrap.min.js"></script>
</body>

</html>