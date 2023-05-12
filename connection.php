<?php
session_start();
?>
<!-- Pour connecte   login -->
<?php

  

if (isset($_POST['email']) && isset($_POST['mdp']))
{
  include "config.php";
  
  function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $email = validate($_POST['email']);
  $mdp = validate($_POST['mdp']);

  if(empty($email) && empty($mdp)){
    header("Location: login.php?error=Veuille remplire le champ");
    exit();
  }
  if(empty($email))
  {
    header("Location: login.php?error=Entre votre email");
    exit();
  }else if(empty($mdp)){
    header("Location: login.php?error=Entre votre mot de passe");
    exit();
  }
  else{

    $sql = "SELECT * FROM user WHERE email='$email' AND mdp='$mdp'";

    $result = mysqli_query($link, $sql);

    if(mysqli_num_rows($result) > 0)
     {
        $row = mysqli_fetch_assoc($result);
        if($row['email'] === $email && $row['mdp'] === $mdp)
        { 
               $_SESSION['idu'] = $row['idu'];
               $_SESSION['email'] = $row['email'];
               $_SESSION['mdp'] = $row['mdp'];

               header("Location: tbord.php");
               exit();
        }
           else
           {
              header("Location: login.php?error=Email ou le mot de passe sont incorrect.Reseuillez encore");
              exit();
            }
      }
    else{
          header("Location: login.php?success=Email et le mot de passe sont correct.");
          exit();
        }
  }


}
else
{
  header("Location: login.php");
  exit();
}
?>