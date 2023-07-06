<?php   
   session_start();  
   unset($_SESSION["entre"]);      
   //$_SESSION["loggedin"] = false; 
   //echo 'Ud. ha salido del sistema';
   header('Refresh: 2; URL = /sis_seguros_aj/index.php');
?>
