<?php
 if(isset($_GET['idprof'])){

   include "config.php";

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

        $idprof = validate($_GET['idprof']);

            $sql = "DELETE FROM professeur WHERE idprof='$idprof'";
            $result = mysqli_query($link, $sql);
            if($result)
            {
                header("Location: index.php?success=Suppression avec succes");
            }else{
                header("Location: index.php?error=Suppression erreur");
            }

 }else{
    header("Location: professeur.php");
 }
 
?>