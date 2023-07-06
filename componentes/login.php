<?php

session_start();
$_SESSION["entre"] = true;
//echo 'Ud. ha ingresado al sistema correctamente';
header('Refresh: 2; URL = /sis_seguros_aj/index.php');

/*
$txtusuario = (isset($_POST["emailusuario"])) ? $_POST["emailusuario"] : "";

switch ($txtusuario) {
   case "andrea@andrea.com":
      session_start();
      $_SESSION["entre"] = true;
      echo 'Ud. ha ingresado al sistema correctamente';
      header('Refresh: 2; URL = /sis_seguros_aj/index.php');
      break;
}
*/
?>

<!--

<div class="card">
   <img class="card-img-top" src="holder.js/100x180/" alt="">
   <div class="card-body">
      <form method="POST" enctype="multipart/form-data" action="#">
         <div class="form-group">
            <label for="exampleInputEmail1">Correo Electronico</label>
            <input type="email" class="form-control" id="emailusuario" aria-describedby="emailHelp" placeholder="Enter email">
         </div>
         <div class="form-group">
            <label for="exampleInputPassword1">Clave</label>
            <input type="password" class="form-control" id="claveusuario" placeholder="Password">
         </div>
         <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
         </div>
         <button type="submit" class="btn btn-primary">Sign In</button>
      </form>
   </div>
</div>
-->