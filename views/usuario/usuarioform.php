<?php
include_once("../../controller/conexion.php");
include_once("../../model/usuario.php");
include_once("../../controller/usuariocontroller.php");
include_once("../../model/rol.php");
include_once("../../controller/rolcontroller.php");


include("../encabezado.php");

$txtUsuarioBuscado = (isset($_POST["usuariobuscado"])) ? $_POST["usuariobuscado"] : "";
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
    case "Agregar":
        $txUsuarioController = new UsuarioController();
        $txUsuarioController->Agregar($txusuario);
        session_start();
        $_SESSION["msj_normal"] = " Los datos se grabaron correctamente";
        break;
    case "Buscar":
        $txUsuarioController = new UsuarioController();
        $listausuarios = $txUsuarioController->Buscar($txtUsuarioBuscado);
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

<?php
## Mensajes comunes
if (isset($_SESSION["msj_normal"])) {
    $mensaje = $_SESSION["msj_normal"];
?>
    <script>
        Swal.fire('Mensaje!', '<?php echo $mensaje ?>', 'success');
    </script>
    <?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        // session isn't started
        session_start();
    }
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
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        // session isn't started
        session_start();
    }
    unset($_SESSION["msj_normal"]);
}
?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <label for="titulo" class="labeltitulo" style="width: 100%;">Usuario</label>
        <div class="container-fluid">
            <ul class="nav nav-pills justify-content-around id=" menu" role="tablist"">  
                <li class=" nav-item" role="presentation">
                <button class="nav-link" id="pills-consulta-tab" data-bs-toggle="pill" data-bs-target="#pills-consulta" type="button" role="tab" aria-controls="pills-consulta" aria-selected="true">Consulta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-alta-tab" data-bs-toggle="pill" data-bs-target="#pills-alta" type="button" role="tab" aria-controls="pills-alta" aria-selected="true">Alta</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Consulta -->
                <div class="container-fluid text-center tab-pane fade show active" id="pills-consulta" role="tabpanel" aria-labelledby="pills-consulta-tab" tabindex="0">
                    <!-- Pagina de Busqueda -->
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="txtUsuarioBuscado">Usuario: </span>
                                        <input type="text" id="usuariobuscado" name="usuariobuscado" class="form-control" placeholder=" ingrese dato a Buscar (Apellido) " aria-label="usuario" aria-describedby="usuario">
                                        <button type="submit" name="accion" value="Buscar" class="btn btn-primary">
                                            Buscar usuario
                                            <i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($listausuarios) and !empty($listausuarios)) { ?>
                        <!-- Resultado de Busqueda -->
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Apellido y Nombre</th>
                                            <th>Correo Electrónico</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listausuarios as $usuario) { ?>
                                            <tr>
                                                <td scope="row">
                                                    <?php echo $usuario['usuario'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $usuario['nombrereal'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $usuario['correo'] ?>
                                                </td>                                                
                                                <td>
                                                    <form method="POST" enctype="multipart/form-data" action="usuarioeditarborrar.php">
                                                        <input type="hidden" name="id" value="<?php echo $usuario['correo'] ?>" />

                                                        <button type="submit" name="accion" value="Seleccionar" data-bs-toggle="modal" data-bs-target="#ModificarModal" class="btn btn-sm btn-warning">
                                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                                        </button>
                                                        <button type="submit" name="accion" value="Eliminar" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i>
                                                            Eliminar </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- fin div -->
                    <?php } ?>
                </div>
                <!-- Alta -->
                <div class="container-fluid text-center tab-pane fade" id="pills-alta" role="tabpanel" aria-labelledby="pills-alta-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Correo Electrónico</span>
                                        <input type="email" inputmode="text" id="correo" name="correo" required class="form-control" placeholder="correo@correo.com.ar" aria-label="correo" aria-describedby="correo">
                                        <span class="input-group-text">Clave</span>
                                        <input type="password" id="clave" name="clave" required class="form-control" placeholder="" aria-label="clave" aria-describedby="clave">
                                        <span class="input-group-text fa-solid fa-eye-slash" style="cursor: pointer;" id="eye" onclick="showPassword()"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="nombre">Apellido y Nombre: </span>
                                        <input type="text" id="nombrereal" name="nombrereal" required class="form-control" placeholder="" aria-label="nombrereal" aria-describedby="nombrereal">
                                        <span class="input-group-text" id="usuario">Usuario corto: </span>
                                        <input type="text" id="usuario" name="usuario" required class="form-control" placeholder="" aria-label="usuario" aria-describedby="usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="rol">Rol</label>
                                        <select id="rol" name="rol" class="form-select" id="rol">
                                            <option value="">Seleccione Rol de Usuario</option>
                                            <?php foreach ($listaroles as $rol) { ?>
                                                <option value="<?php echo $rol['id'] ?>" <?php echo ($rol['id']=="0") ? 'selected' : '' ?>><?php echo $rol['nombre_rol'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">
                                        Grabar
                                        usuario <i class="fa-solid fa-save"></i></button>
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
      $(document).ready(function() {
         document.getElementById("usuariobuscado").focus();
      });
   </script>
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