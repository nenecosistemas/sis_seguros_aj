<?php

session_start();
$_SESSION["entre"] = true;
//echo 'Ud. ha ingresado al sistema correctamente';
header('Refresh: 0; URL = /sis_seguros_aj/index.php');

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

<body>
   <div class="col-md-12 justify-content-center" id="Normalpage">
      <form>
         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
         </div>
         <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
         </div>
         <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
</body>

-->