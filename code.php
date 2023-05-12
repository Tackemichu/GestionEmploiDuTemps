<?php
session_start();
require 'config.php';

if(isset($_POST['ajoute']))
{
   function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
   }

   $idsalle = validate($_POST['idsalle']);
   $idclasse = validate($_POST['idclasse']);
   $idprof = validate($_POST['idprof']);
   $cours = validate($_POST['cours']);
   $date = validate($_POST['date']);


   

  if(empty($idsalle) || empty($idclasse) || empty($idprof) || empty($cours) || empty($date)){
      header("Location: createmploi.php?error=Remplire le champs");
      exit();
   }
   else{

     $sql = "INSERT INTO emploi_du_temps (idsalle, idclasse, idprof, cours, date) VALUES('$idsalle','$idclasse','$idprof','$cours','$date')";

     $result = mysqli_query($link, $sql);
     if($result){
      // Ajouter 2 heures à l'heure courante
$end_time = date('Y-m-d H:i:s', strtotime('+2 hours'));

// Mettre à jour le champ "occupation" de la table "salle" avec une durée de 2 heures
$requet = "UPDATE salle SET occupation = 'Oui', end_time = '$end_time' WHERE idsalle = $idsalle";


      $result = mysqli_query($link,  $requet);
        if($result){
         header("Location: indexemploi.php?success=Enregistrement avec succes");
         exit(0);
        }else{
         header("Location: createmploi.php?error=Un probleme est survenu veuilez remplir les champs");
         exit(0);
        }
     }
   }
}

?>


