<?php   
   session_start();  
   unset($_SESSION["entre"]);         
   //echo 'Ud. ha salido del sistema';
   header('Refresh: 0; URL = /sis_seguros_aj/index.php');
?>
