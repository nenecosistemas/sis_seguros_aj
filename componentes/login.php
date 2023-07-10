<?php

//include_once("../config/bd.php");
include_once("../clases/usuario.php");

if (isset($_POST["emailusuario"])) {
   $txtcorreo = (isset($_POST["emailusuario"])) ? $_POST["emailusuario"] : "";
   $txtclave = (isset($_POST["claveusuario"])) ? $_POST["claveusuario"] : "";

   $txUsuario = new Usuario($txtcorreo, $txtclave);

   if ($txUsuario->esUsuarioHabilitado()) {
      session_start();
      $_SESSION["entre"] = true;
      $_SESSION["msj_normal"] = " Usuario Logeado correctamente";
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
   unset($_SESSION["msj_normal"]);
}
?>

<body>
   <div class="col-md-12 justify-content-center" id="Normalpage">
      <label for="titulo" class="labeltitulo" style="width: 100%;">LOGIN</label>
      <div class="container-fluid text-center ">
         <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
               <form method="POST" enctype="multipart/form-data" action="#">
                  <div class="form-group row">
                     <div class="input-group mb-2">
                        <span class="input-group-text" id="email_asegurado">Correo Electónico</span>
                        <input type="email" id="emailusuario" name="emailusuario" class="form-control" placeholder="" aria-label="email_asegurado" aria-describedby="email_asegurado">
                     </div>
                     <div class="input-group mb-2">
                        <span class="input-group-text" id="clave_asegurado">Clave</span>
                        <input type="password" id="claveusuario" name="claveusuario" class="form-control" placeholder="" aria-label="clave_asegurado" aria-describedby="clave_asegurado">
                     </div>
                  </div>
            </div>
            <div class="col-sm-12 ">
               <button type="submit" name="accion" value="Agregar" class="btn btn-primary"> Verificar Usuario <i class="fa-solid fa-save"></i></button>
            </div>
            </form>
         </div>
      </div>
   </div>
   </div>
</body>
<?php include("pie.php"); ?>