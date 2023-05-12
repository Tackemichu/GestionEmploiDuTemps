<?php
 if(isset($_GET['idclasse'])){

   include "config.php";

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

        $idclasse = validate($_GET['idclasse']);

            $sql = "DELETE FROM classe WHERE idclasse='$idclasse'";
            $result = mysqli_query($link, $sql);
            if($result)
            {
                header("Location: indexclasse.php?success=Suppression avec succes");
            }else{
                header("Location: indexclasse.php?error=Suppression erreur");
            }

 }else{
    header("Location: indexclasse.php");
 }
 
?>