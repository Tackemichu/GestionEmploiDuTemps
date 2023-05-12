<?php
session_start();
?>
<!-- Pour connecte   logout -->
<?php

  include "../config.php";

if (isset($_POST['nom'])   &&
    isset($_POST['prenom']) &&
    isset($_POST['email'])   &&
    isset($_POST['mdp']))    
{
  function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $nom = validate($_POST['nom']);
  $prenom = validate($_POST['prenom']);
  $email = validate($_POST['email']);
  $mdp = validate($_POST['mdp']);

  $user_data = 'nom='. $nom. '&prenom='. $prenom;

  if(empty($nom) && empty($prenom) && empty($email) && empty($mdp)){
    header("Location: creecompte.php?error=Veuille remplire le champ");
    exit();
  }
  if(empty($nom))
  {
    header("Location: creecompte.php?error=Entre votre nom&$user_data");
    exit();
  }else if(empty($prenom)){
    header("Location: creecompte.php?error=Entre votre prenom&$user_data");
    exit();
  }else if(empty($email)){
    header("Location: creecompte.php?error=Entre votre email&$user_data");
    exit();
  }else if(empty($mdp)){
    header("Location: creecompte.php?error=Entre le mot de passe&$user_data");
    exit();
  }
  
  
  else{

        $sql = "SELECT * FROM user WHERE nom='$nom'";
    
        $result = mysqli_query($link, $sql);
    

    if(mysqli_num_rows($result) > 0){
        header("Location: creecompte.php?error=Le mot de passe ne ressemble pas au confirme&$user_data");
        exit();
    }else{
        $sql2 = "INSERT INTO user (nom,prenom,email,mdp) VALUES ('$nom','$prenom','$email','$mdp')";

        $result2 = mysqli_query($link, $sql2); 

        if($result2){
            header("Location: creecompte.php?success=Votre compte est crée evec succes");
            exit();
        }else{
            header("Location: creecompte.php?error=Votre compte ne pas crée");
            exit();
        }
    }

 }


  }
else
{
  header("Location: creecompte.php");
  exit();
}
?>
