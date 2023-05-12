<?php 
session_start();

unset($_SESSION['idu']);
unset($_SESSION['email']);
unset($_SESSION['mdp']);

header("Location: login.php");
die();

?>