<?php
include_once("../../controller/conexion.php");
include_once("../../model/usuario.php");
include_once("../../controller/usuariocontroller.php");
include_once("../../model/rol.php");
include_once("../../controller/rolcontroller.php");


$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txusuario = new Usuario();

$txRolController = new RolController();
$listaroles = $txRolController->Todos();

if (isset($_POST["accion"])) {
    $txusuario->__SET("correo", (isset($_POST["correo"])) ? $_POST["correo"] : "");
    $txusuario->__SET("clave", (isset($_POST["clave"])) ? $_POST["clave"] : "");
    $txusuario->__SET("usuario", (isset($_POST["usuario"])) ? $_POST["usuario"] : "");
    $txusuario->__SET("nombrereal", (isset($_POST["nombrereal"])) ? $_POST["nombrereal"] : "");
    $txusuario->__SET("rol", (isset($_POST["rol"])) ? $_POST["rol"] : "");
}

switch ($txtAccion) {
    case "Seleccionar":
        $txUsuarioController = new UsuarioController();
        $usuario = $txUsuarioController->Seleccionar($txtId);
        $txtcorreo = $usuario->correo;
        $txtclave = $usuario->clave;
        $txtusercorto = $usuario->usuario;
        $txtnombre = $usuario->nombrereal;
        $txtrol = $usuario->rol;
        break;
    case "Modificar":
        $txUsuarioController = new UsuarioController();
        $txUsuarioController->Modificar($txusuario, $txusuario->__GET("correo"));
        session_start();
        $_SESSION["msj_normal"] = " Los datos se modificaron correctamente "; ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/views/usuario/usuarioform.php";
            });
        </script>
    <?php
        break;
    case "Eliminar":
        $txUsuarioController = new UsuarioController();
        $txUsuarioController->Eliminar($txtId);
        session_start();
        $_SESSION["msj_normal"] = " El usuario " . $txtId . " Se elimino correctamente";
    ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/views/usuario/usuarioform.php";
            });
        </script>
    <?php
        break;
    case "Cancelar":
    ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/views/usuario/usuarioform.php";
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
                                    <input type="text" id="clave" name="clave" class="form-control" placeholder="" value="<?php echo $txtclave; ?>" aria-label="clave" aria-describedby="clave">
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="nombrereal">Apellido y Nombre: </span>
                                        <input type="text" id="nombrereal" name="nombrereal" class="form-control" placeholder="" value="<?php echo $txtnombre; ?>" aria-label="nombrereal" aria-describedby="nombrereal">
                                        <span class="input-group-text" id="usuario">Usuario corto: </span>
                                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="" value="<?php echo $txtusercorto; ?>" aria-label="usuario" aria-describedby="usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="rol">Rol: </label>
                                        <select id="rol" name="rol" class="form-select" >
                                            <option selected>Seleccione Rol...</option>
                                            <?php foreach ($listaroles as $rol) { ?>
                                                <option value="<?php echo $rol['id'] ?>" <?php echo ($txtrol == $rol['id']) ? 'selected' : '' ?>><?php echo $rol['nombre_rol'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Modificar" class="btn btn-primary">
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
</body>
<?php include("../pie.php"); ?>