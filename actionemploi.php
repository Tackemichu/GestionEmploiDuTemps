
<?php
DELETE e FROM emploi_du_temps e
INNER JOIN salle s ON e.id_salle = s.id
INNER JOIN professeur p ON e.id_professeur = p.id
INNER JOIN classe c ON e.id_classe = c.id
WHERE e.id = 1;
?>