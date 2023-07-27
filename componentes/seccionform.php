<?php
include_once("../clases/conexion.php");
include_once("../clases/seccion.php");
include_once("../clases/seccionmodel.php");
include("encabezado.php");

$txtseccionBuscado = (isset($_POST["seccionbuscado"])) ? $_POST["seccionbuscado"] : "";
$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txseccion = new Seccion();

if (isset($_POST["accion"])) {
    $txseccion->__SET("id", (isset($_POST["id"])) ? $_POST["id"] : "");
    $txseccion->__SET("nombre_seccion", (isset($_POST["nombre_seccion"])) ? $_POST["nombre_seccion"] : "");
    $txseccion->__SET("descripcion_seccion", (isset($_POST["descripcion_seccion"])) ? $_POST["descripcion_seccion"] : "");
}

switch ($txtAccion) {
    case "Agregar":
        $txseccionModel = new SeccionModel();
        $txseccionModel->Agregar($txseccion);
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            // session isn't started
            session_start();
        }
        $_SESSION["msj_normal"] = " Los datos se grabaron correctamente";
        break;
    case "Buscar":
        $txseccionModel = new SeccionModel();
        $listaseccions = $txseccionModel->Buscar($txtseccionBuscado);
        break;
    case "Cancelar":
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/seccionform.php";
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
        setTimeout(function () {
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
        <label for="titulo" class="labeltitulo" style="width: 100%;">SECCIÓN</label>
        <div class="container-fluid">
            <ul class="nav nav-pills justify-content-around id=" menu" role="tablist"">  
                <li class=" nav-item" role="presentation">
                <button class="nav-link" id="pills-consulta-tab" data-bs-toggle="pill" data-bs-target="#pills-consulta"
                    type="button" role="tab" aria-controls="pills-consulta" aria-selected="true">Consulta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-alta-tab" data-bs-toggle="pill" data-bs-target="#pills-alta"
                        type="button" role="tab" aria-controls="pills-alta" aria-selected="true">Alta</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Consulta -->
                <div class="container-fluid text-center tab-pane fade show active" id="pills-consulta" role="tabpanel"
                    aria-labelledby="pills-consulta-tab" tabindex="0">
                    <!-- Pagina de Busqueda -->
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="seccionbuscado">Sección: </span>
                                        <input type="text" id="seccionbuscado" name="seccionbuscado"
                                            class="form-control" placeholder=" ingrese dato a Buscar (Sección) "
                                            aria-label="seccion" aria-describedby="seccion">
                                        <button type="submit" name="accion" value="Buscar" class="btn btn-primary">
                                            Buscar Sección <i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($listaseccions) and !empty($listaseccions)) { ?>
                        <!-- Resultado de Busqueda -->
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Seccion</th>
                                            <th>descripcion</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listaseccions as $seccion) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $seccion['nombre_seccion'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $seccion['descripcion_seccion'] ?>
                                                </td>
                                                <td>
                                                    <form method="POST" enctype="multipart/form-data"
                                                        action="seccioneditarborrar.php">
                                                        <input type="hidden" name="id" value="<?php echo $seccion['id'] ?>" />

                                                        <button type="submit" name="accion" value="Seleccionar"
                                                            data-bs-toggle="modal" data-bs-target="#ModificarModal"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                                        </button>

                                                        <button type="submit" name="accion" value="Eliminar"
                                                            class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i>
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
                <div class="container-fluid text-center tab-pane fade" id="pills-alta" role="tabpanel"
                    aria-labelledby="pills-alta-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="id" type="hidden">ID</span>
                                        <input type="hidden" id="id" name="id" class="form-control" aria-label="id"
                                            aria-describedby="id" hide>
                                        <span class="input-group-text">Nombre</span>
                                        <input type="text" id="nombre_seccion" name="nombre_seccion"
                                            class="form-control" placeholder="" aria-label="nombre_seccion"
                                            aria-describedby="nombre_seccion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="descripcion_seccion">descripcion</span>
                                        <input type="text" id="descripcion_seccion" name="descripcion_seccion"
                                            class="form-control" placeholder="" aria-label="descripcion_seccion"
                                            aria-describedby="descripcion_seccion">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">
                                        Grabar Sección <i class="fa-solid fa-save"></i></button>
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
<?php include("pie.php"); ?>