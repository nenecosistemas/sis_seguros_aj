<?php
include_once("../../controller/conexion.php");
include_once("../../model/usuario.php");
include_once("../../controller/usuariocontroller.php");
include_once("../../model/rol.php");
include_once("../../controller/rolcontroller.php");

if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
}

$txtId = (isset($_SESSION["email_login"])) ? $_SESSION["email_login"] : "";

$txtAccion = $txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "Seleccionar";
$txusuario = new Usuario();

if (isset($_POST["accion"])) {
    $txusuario->__SET("correo", (isset($_POST["correo"])) ? $_POST["correo"] : "");
    $txusuario->__SET("clave", (isset($_POST["clave"])) ? $_POST["clave"] : "");
    $txusuario->__SET("usuario", (isset($_POST["usuario"])) ? $_POST["usuario"] : "");
    $txusuario->__SET("nombrereal", (isset($_POST["nombrereal"])) ? $_POST["nombrereal"] : "");    
}

switch ($txtAccion) {
    case "Seleccionar":
        $txUsuarioController = new UsuarioController();
        $usuario = $txUsuarioController->Seleccionar($txtId);        
        $txtcorreo = $usuario->correo;
        $txtclave = $usuario->clave;
        $txtusercorto = $usuario->usuario;
        $txtnombre = $usuario->nombrereal;        
        break;
    case "ModificarClave":
        $txUsuarioController = new UsuarioController();
        $txUsuarioController->ModificarClave($txusuario, $txusuario->__GET("correo"));
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            // session isn't started
            session_start();
        }        $_SESSION["msj_normal"] = " Los datos se modificaron correctamente "; ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/index.php";
            });
        </script>
    <?php
        break;
    case "Cancelar":
    ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/index.php";
            });
        </script>
<?php
        break;
}
?>
<?php include("../encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <label for="titulo" class="labeltitulo" style="width: 100%;">MODIFICAR USUARIO</label>
        <div class="container-fluid text-center " id="modificaAsegurado" tabindex="0">
            <!-- abm -->
            <div class="row">
                <div class="col ">
                    <div class="card ">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Correo Electrónico</span>
                                    <input type="email" inputmode="text" id="correo" readonly name="correo" class="form-control" placeholder="" value="<?php echo $txtcorreo; ?>" aria-label="correo" aria-describedby="correo">
                                    <span class="input-group-text">Clave</span>                                    
                                    <input type="password" id="clave" name="clave" class="form-control" placeholder="" value="<?php echo $txtclave; ?>" aria-label="clave" aria-describedby="clave">
                                    <span class="input-group-text fa-solid fa-eye-slash" style="cursor: pointer;" id="eye" onclick="showPassword()"></span>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="nombrereal">Apellido y Nombre: </span>
                                        <input type="text" id="nombrereal" name="nombrereal" class="form-control" placeholder="" value="<?php echo $txtnombre; ?>" aria-label="nombrereal" aria-describedby="nombrereal">
                                        <span class="input-group-text" id="usuario">Usuario corto: </span>
                                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="" value="<?php echo $txtusercorto; ?>" aria-label="usuario" aria-describedby="usuario">
                                    </div>
                                </div>                                
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="ModificarClave" class="btn btn-primary">
                                        Modificar Usuario <i class="fa-solid fa-save"></i></button>
                                    <button type="cancel" name="accion" value="Cancelar" class="btn btn-info">
                                        Cancelar
                                        <i class="fa-solid fa-cancel"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showPassword() {
            var x = document.getElementById("clave");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("eye").className = "input-group-text fa-solid fa-eye";
            } else {
                x.type = "password";
                document.getElementById("eye").className = "input-group-text fa-solid fa-eye-slash";
            }
            
        }
    </script>
</body>
<?php include("../pie.php"); ?>