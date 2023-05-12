<?php
if(isset($_SESSION['message'])) :

?>


<div class="w3-panel w3-pale-red w3-display-container w3-border">
  <span onclick="this.parentElement.style.display='none'" class="w3-button w3-large w3-display-topright">×</span>
  <h2>Alert !</h2><?php $_SESSION['message']; ?> 
</div>


<?php
unset($_SESSION['message']);
endif;
?>
