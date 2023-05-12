<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "SELECT * FROM emploi_du_temps WHERE id='$id'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['update'])){
  $id = $_POST['id'];
  $idsalle = $_POST['idsalle'];
  $idprof = $_POST['idprof'];
  $idclasse = $_POST['idclasse'];
  $cours = $_POST['cours'];
  $date = $_POST['date'];

  $sql = "UPDATE emploi_du_temps SET idsalle='$idsalle', idprof='$idprof', idclasse='$idclasse', cours='$cours', date='$date' WHERE id='$id'";
  $result = mysqli_query($link, $sql);

  if($result){
    header("Location: index.php?success=Mise à jour effectuée avec succès.");
    exit();
  } else {
    header("Location: index.php?error=La mise à jour a échoué. Veuillez réessayer.");
    exit();
  }
}
?>