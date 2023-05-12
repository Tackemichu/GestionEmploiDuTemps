<?php
 if(isset($_GET['idsalle'])){

   include "config.php";

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

        $idsalle = validate($_GET['idsalle']);

            $sql = "DELETE FROM salle WHERE idsalle='$idsalle'";
            $result = mysqli_query($link, $sql);
            if($result)
            {
                header("Location: indexsalle.php?success=Suppression avec succes");
            }else{
                header("Location: indexsalle.php?error=Suppression erreur");
            }

 }else{
    header("Location: indexsalle.php");
 }
 
?>