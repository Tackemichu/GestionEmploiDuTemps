<?php
// Inclure le fichier config
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
// Définir les variables
$niveau = "";
$niveau_err = "";
 
// Traitement
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validation du champ design
    $input_niveau = trim($_POST["niveau"]);
    if(empty($input_niveau)){
        $niveau_err = "Veuillez entrer un niveau.";
    } else if(strlen($input_niveau) > 10){
        $niveau_err = "Le niveau ne doit pas dépasser 10 caractères.";
    } else{
        $niveau = $input_niveau;
    }
    
    
    // Vérification des erreurs avant enregistrement
    if(empty($niveau_err)){
        // Préparation de la requête préparée
        $sql = "INSERT INTO classe (niveau) VALUES (?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables à la requête préparée
            mysqli_stmt_bind_param($stmt, "s", $param_niveau);
            
            // Définir les paramètres
            $param_niveau = $niveau;
            
            // Exécution de la requête
            if(mysqli_stmt_execute($stmt)){
                // Opération effectuée, redirection
                header("location: indexclasse.php");
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
    <title>ajout-classe</title>
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
                        <p>Remplir le formulaire pour enregistrer le niveau dans la base de données</p>

                        <form action="#" method="post">
                            <div class="form-group">
                                <label>niveau</label>
                                <input type="text" name="niveau"
                                    class="form-control <?php echo (!empty($niveau_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $niveau; ?>">
                                <span class="invalid-feedback">
                                    <?php echo $niveau_err;?>
                                </span>
                            </div><br>
                            <input type="submit" class="btn btn-primary" value="Enregistrer">
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