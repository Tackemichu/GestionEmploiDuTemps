<?php

session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
// Definir les variables
$nom = $prenom = $grade = "";
$name_err = $prenom_err = $grade_err = "";
 
// Traitement
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["nom"]);
    if(empty($input_name)){
        $name_err = "Veuillez entrez un nom.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veuillez entrez a valid name.";
    } else{
        $nom = $input_name;
    }
    
    // Validate prenom
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = "Veuillez entrez une prenom.";     
    } else{
        $prenom = $input_prenom;
    }
    
    // Validate grade
    $input_grade = trim($_POST["grade"]);
  
    if(empty($input_grade)){
        $grade_err = "Veuillez entrez le grade";    
       // echo $_POST["prenom"];
        header('location:create.php');
    } else{
        $grade = $input_grade;

    }
    
    // verifiez les erreurs avant enregistrement
    if(empty($name_err) && empty($prenom_err) && empty($grade_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO professeur (nom, prenom, grade) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables à la requette preparée
            mysqli_stmt_bind_param($stmt, "sss", $param_nom, $param_prenom, $param_grade);
            
            // Set parameters
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_grade = trim($_POST["grade"]);
            echo trim($_POST["grade"]);
           // return;
            
            // executer la requette
            if(mysqli_stmt_execute($stmt)){
                // opération effectuée, retour
                header("Location: index.php?success=Enregistrement avec succes");
                exit();
            } else{
                header("Location: index.php?error=L'enregistrement avait une erreur");
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
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
    <title>ajout-prof</title>
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
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h2 class="text-center font-weight-light my-4">Créer un enregistrement</h2>
                        <p>Remplir les formulaires pour enregistrer les professeurs dans la base de
                            données</p>
                    </div>
                    <div class="card-body">
                        <form action="#" method="post">
                            <div class="form-group">
                                <label>Nom</label>
                                <input required type="text" name="nom"
                                    class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $nom; ?>">
                                <span class="invalid-feedback">
                                    <?php echo $name_err;?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Prenom</label>
                                <input required type="text" name="prenom"
                                    class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $prenom; ?>">
                                <span class="invalid-feedback">
                                    <?php echo $prenom_err;?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Grade</label>
                                <select required class="form-select" id="country" type="text" name="grade"
                                    class="form-control">
                                    <option hidden value=""></option>
                                    <option>Professeur titulaire</option>
                                    <option>Maître de Conférences</option>
                                    <option>Assistant d’Enseignement Supérieur et de Recherche</option>
                                    <option>Docteur HDR</option>
                                    <option>Docteur en Informatique</option>
                                    <option>Doctorant en informatique</option>
                                </select>
                                <?php echo $grade; ?>
                                <span class="invalid-feedback">
                                    <?php echo $grade_err;?>
                                </span> <br>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Enregistrer">
                            <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="./Resource/Bootstrap/bootstrap.min.js"></script>
</body>

</html>