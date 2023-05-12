<?php  

   $per_page = 5;
   $comp = 0;
   $active = 1;
   if(isset($_GET['comp'])){
       $comp = $_GET['comp'];
       if($comp<=0){
         $comp = 0;
         $active = 1;
       }
       else{
            $active = $comp;
            $comp--;
            $comp = $comp*$per_page;
           }
}

    $record = mysqli_num_rows(mysqli_query($link, "SELECT salle.design,salle.occupation,professeur.nom,professeur.prenom,professeur.grade,classe.niveau,emploi_du_temps.cours,emploi_du_temps.date 
    FROM emploi_du_temps 
    JOIN salle ON emploi_du_temps.idsalle=salle.idsalle
    JOIN professeur ON emploi_du_temps.idprof=professeur.idprof 
    JOIN classe ON emploi_du_temps.idclasse=classe.idclasse"));


    $page = ceil($record/$per_page);
    $sql = "SELECT salle.design,salle.occupation,professeur.nom,professeur.prenom,professeur.grade,classe.niveau,emploi_du_temps.cours,emploi_du_temps.date 
    FROM emploi_du_temps 
    JOIN salle ON emploi_du_temps.idsalle=salle.idsalle
    JOIN professeur ON emploi_du_temps.idprof=professeur.idprof 
    JOIN classe ON emploi_du_temps.idclasse=classe.idclasse
    LIMIT $comp,$per_page";
    $result = mysqli_query($link, $sql);
?> 
