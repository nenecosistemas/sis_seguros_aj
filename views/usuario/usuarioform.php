<?php
include_once("../../controller/conexion.php");
include_once("../../model/usuario.php");
include_once("../../controller/usuariocontroller.php");

include("../encabezado.php");

$txtUsuarioBuscado = (isset($_POST["usuariobuscado"])) ? $_POST["usuariobuscado"] : "";
$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txusuario = new Usuario();

if (isset($_POST["accion"])) {
    $txusuario->__SET("dni_usuario", (isset($_POST["dni_usuario"])) ? $_POST["dni_usuario"] : "");
    $txusuario->__SET("apellido_y_nombre_usuario", (isset($_POST["apellido_y_nombre_usuario"])) ? $_POST["apellido_y_nombre_usuario"] : "");
    $txusuario->__SET("domicilio_usuario", (isset($_POST["domicilio_usuario"])) ? $_POST["domicilio_usuario"] : "");
    $txusuario->__SET("telefono_usuario", (isset($_POST["telefono_usuario"])) ? $_POST["telefono_usuario"] : "");
    $txusuario->__SET("correo_usuario", (isset($_POST["correo_usuario"])) ? $_POST["correo_usuario"] : "");
    $txusuario->__SET("tipoiva_usuario", (isset($_POST["tipoiva_usuario"])) ? $_POST["tipoiva_usuario"] : "");
    $txusuario->__SET("cuit_usuario", (isset($_POST["cuit_usuario"])) ? $_POST["cuit_usuario"] : "");
}

switch ($txtAccion) {
    case "Agregar":
        $txusuarioModel = new usuarioModel();
        $txusuarioModel->Agregar($txusuario);
        session_start();
        $_SESSION["msj_normal"] = " Los datos se grabaron correctamente";
        break;
    case "Buscar":
        $txusuarioModel = new usuarioModel();
        $listausuarios = $txusuarioModel->Buscar($txtusuarioBuscado);
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
        <label for="titulo" class="labeltitulo" style="width: 100%;">usuario</label>
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
                                        <span class="input-group-text" id="txusuariobuscado">usuario: </span>
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
                                            <th>DNI</th>
                                            <th>Apellido y Nombre</th>
                                            <th>Telefono</th>
                                            <th>Correo Electrónico</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listausuarios as $usuario) { ?>
                                            <tr>
                                                <td scope="row">
                                                    <?php echo $usuario['dni_usuario'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $usuario['apellido_y_nombre_usuario'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $usuario['telefono_usuario'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $usuario['correo_usuario'] ?>
                                                </td>
                                                <td>
                                                    <form method="POST" enctype="multipart/form-data" action="usuarioeditarborrar.php">
                                                        <input type="hidden" name="id" value="<?php echo $usuario['dni_usuario'] ?>" />

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
                                        <span class="input-group-text">DNI usuario</span>
                                        <input type="text" inputmode="numeric" id="dni_usuario" name="dni_usuario" class="form-control" placeholder="" aria-label="dni_usuario" aria-describedby="dni_usuario">
                                        <span class="input-group-text">Apellido y Nombre</span>
                                        <input type="text" id="apellido_y_nombre_usuario" name="apellido_y_nombre_usuario" class="form-control" placeholder="" aria-label="apellido_y_nombre_usuario" aria-describedby="apellido_y_nombre_usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="domicilio_usuario">Domicilio</span>
                                        <input type="text" id="domicilio_usuario" name="domicilio_usuario" class="form-control" placeholder="" aria-label="domicilio_usuario" aria-describedby="domicilio_usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="telefono_usuario">Teléfono</span>
                                        <input type="tel" id="telefono_usuario" name="telefono_usuario" class="form-control" placeholder="" aria-label="telefono_usuario" aria-describedby="telefono_usuario">
                                        <span class="input-group-text" id="email_usuario">Correo Electónico</span>
                                        <input type="email" id="correo_usuario" name="correo_usuario" class="form-control" placeholder="" aria-label="email_usuario" aria-describedby="email_usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="tipoiva_usuario">Tipo IVA</label>
                                        <select id="tipoiva_usuario" name="tipoiva_usuario" class="form-select" id="tipoiva_usuario">
                                            <option value="">Seleccione Tipo de Iva...</option>
                                            <?php foreach ($listaivas as $iva) { ?>
                                                <option value="<?php echo $iva['id'] ?>"><?php echo $iva['nombre_iva'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="input-group-text" id="cuit_usuario">C.U.I.T.</span>
                                        <input type="text" id="cuit_usuario" name="cuit_usuario" class="form-control" placeholder="99-99999999-9" pattern="[0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]-[0-9]" title="99-99999999-9" aria-label="cuit_usuario" aria-describedby="cuit_usuario">
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
</body>
<?php include("../pie.php"); ?>