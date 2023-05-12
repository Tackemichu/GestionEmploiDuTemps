<?php
// Inclure le fichier
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
 
// Definir les variables
$nom = $prenom = $grade = "";
$name_err = $prenom_err = $grade_err = "";
 
// verifier la valeur id dans le post pour la mise à jour
if(isset($_POST["idprof"]) && !empty($_POST["idprof"])){
    // recuperation du champ chaché
    $idprof = $_POST["idprof"];
    
    // Validate name
    $input_name = trim($_POST["nom"]);
    if(empty($input_name)){
        $name_err = "Veillez entrez un nom.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veillez entrez a valid name.";
    } else{
        $nom = $input_name;
    }
    
    // Validate prenom
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = "Veuillez entrez une prenom.";     
    } else{
        $prenom= $input_prenom;
    }
    
    // Validate grade
    $input_grade = trim($_POST["grade"]);
    if(empty($input_grade)){
        $grade_err = "Veuillez entrez le grade.";     
    } 
    else{
        $grade = $input_grade;
    }
    
    // verifier les erreurs avant modification
    if(empty($name_err) && empty($prenom_err) && empty($grade_err)){
        // Prepare an update statement
        $sql = "UPDATE professeur SET nom=?, prenom=?, grade=? WHERE idprof=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "sssi", $param_nom, $param_prenom, $param_grade, $param_idprof);
            
            // Set parameters
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_grade = $grade;
            $param_idprof = $idprof;
            
            // executer
            if(mysqli_stmt_execute($stmt)){
                // enregistremnt modifié, retourne
                header("location: index.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // si il existe un paramettre id
    if(isset($_GET["idprof"]) && !empty(trim($_GET["idprof"]))){
        // recupere URL parameter
        $idprof =  trim($_GET["idprof"]);
        
        // Prepare la requete
        $sql = "SELECT * FROM professeur WHERE idprof = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "i", $param_idprof);
            
            // Set parameters
            $param_idprof = $idprof;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* recupere l'enregistremnt */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // recupere les champs
                    $nom = $row["nom"];
                    $prenom = $row["prenom"];
                    $grade = $row["grade"];
                } else{
                    // pas de id parametter valid, retourne erreur
                    header("location: error.php");
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
        header("location: error.php");
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
    <title>Mise a jours prof</title>
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
                        <h2 class="mt-5">Mise à jour Professeur</h2>
                        <p>Modifier les champs </p>
                        <form action="#" method="post">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="nom"
                                    class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $nom; ?>">
                                <span class="invalid-feedback">
                                    <?php echo $name_err;?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Prenom</label>
                                <input type="text" name="prenom"
                                    class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $prenom; ?>">
                                <span class="invalid-feedback">
                                    <?php echo $prenom_err;?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Grade</label>
                                <select class="form-select" id="country" type="text" name="grade" class="form-control">
                                    <option value="">
                                        <?php echo $grade; ?>
                                    </option>
                                    <option>Professeur titulaire</option>
                                    <option>Maître de Conférences</option>
                                    <option>Assistant d’Enseignement Supérieur et de Recherche</option>
                                    <option>Docteur HDR</option>
                                    <option>Docteur en Informatique</option>
                                    <option>Doctorant en informatique</option>
                                </select>
                                <?php echo (!empty($grade_err)) ? 'is-invalid' : ''; ?>
                                <span class="invalid-feedback">
                                    <?php echo $grade_err;?>
                                </span>
                            </div><br>
                            <input type="hidden" name="idprof" value="<?php echo $idprof; ?>" />
                            <input type="submit" class="btn btn-primary" value=" Modifier">
                            <a href="index.php" class="btn btn-secondary ml-2"> Annuler</a>
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