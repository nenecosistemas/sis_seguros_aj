<?php

include_once("../clases/conexion.php");
include_once("../clases/usuario.php");
include_once("../clases/usuariomodel.php");

if (isset($_POST["emailusuario"])) {
   $txtcorreo = (isset($_POST["emailusuario"])) ? $_POST["emailusuario"] : "";
   $txtclave = (isset($_POST["claveusuario"])) ? $_POST["claveusuario"] : "";

   $txUsuario = new Usuario($txtcorreo, $txtclave);
   $txUsuarioModel = new UsuarioModel();

   if ($txUsuarioModel->esUsuarioHabilitado($txUsuario->__GET('correo'), $txUsuario->__GET('clave'))) {
      session_start();
      $_SESSION["entre"] = true;
      $_SESSION["msj_normal"] = " Usuario Logeado correctamente";
   } else {      
      session_start();
      $_SESSION["msj_error"] = " Usuario o Clave erronea";
   }
}

?>

<?php include("encabezado.php"); ?>
<?php
## Mensajes comunes
if (isset($_SESSION["msj_normal"])) {
   $mensaje = $_SESSION["msj_normal"];
?>
   <script>
      Swal.fire('Mensaje!', '<?php echo $mensaje ?>', 'success');
      setTimeout(function() {
         window.location.href = "/sis_seguros_aj/index.php";
      }, 1500);
   </script>
<?php
   //header("Location:/sis_seguros_aj/index.php");
   unset($_SESSION["msj_normal"]);
}

## Mensajes de Errores
if (isset($_SESSION["msj_error"])) {
   $mensaje = $_SESSION["msj_error"];
?>
   <script>
      Swal.fire('Error!', '<?php echo $mensaje ?>', 'error');
      setTimeout(function() {
         window.location.href = "/sis_seguros_aj/index.php";
      }, 1500);
   </script>
<?php
   unset($_SESSION["msj_error"]);
}
?>

<body>
   <div class="col-md-12 justify-content-center" id="Normalpage">

      <div class="container-fluid text-center w-50">
         <div class="card justify-content-center">
            <div class="card-header">
               <label for="titulo" class="labeltitulo" style="width: 100%;">LOGIN</label>
            </div>
            <div class="card-body">
               <form method="POST" enctype="multipart/form-data" action="#">
                  <div class="form-group row">
                     <div class="form-floating">
                        <input type="email" class="form-control" id="email_asegurado" name="emailusuario" placeholder="name@example.com">
                        <label for="email_asegurado"> Correo Electrónico </label>
                     </div>
                     <div class="form-floating">
                        <input type="password" class="form-control" id="claveusuario" name="claveusuario" placeholder="name@example.com">
                        <label for="claveusuario"> Clave </label>

                     </div>
                  </div>
            </div>
            <div class="col-sm-12 ">
               <button type="submit" name="accion" value="Agregar" class="btn btn-primary"> Verificar Usuario <i class="fa-solid fa-solid fa-user-shield"></i></button>
            </div>
            </form>
         </div>
      </div>
   </div>
   </div>
   <script>
      $(document).ready(function() {
         document.getElementById("email_asegurado").focus();
      });
   </script>
</body>
<?php include("pie.php"); ?>