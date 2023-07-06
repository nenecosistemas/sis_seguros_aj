<?php   
   session_start();  
   unset($_SESSION["entre"]);      
   //$_SESSION["loggedin"] = false; 
   //echo 'Ud. ha salido del sistema';
   header('Refresh: 1; URL = /sis_seguros_aj/index.php');
?>
