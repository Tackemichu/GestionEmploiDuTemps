<?php
 if(isset($_GET['id'])){

   include "config.php";

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

        $id = validate($_GET['id']);
        $idsalle = validate($_GET['idsalle']);

            $sql = "DELETE FROM emploi_du_temps WHERE id='$id'";
            $result = mysqli_query($link, $sql);
            if($result){
                $rqt = "UPDATE salle SET occupation = 'Non' WHERE idsalle = $idsalle";
          
                $result = mysqli_query($link, $rqt);
                if($result)
                {
                    header("Location: indexemploi.php?success=Suppression avec succes");
                }else{
                    header("Location: indexemploi.php?error=Suppression erreur");
                }
            }

 }else{
    header("Location: indexemploi.php");
 }
 
?>