<?php
include_once("../clases/conexion.php");
include_once("../clases/poliza.php");
include_once("../clases/polizamodel.php");
include("encabezado.php");

$txtaseguradoBuscado = (isset($_POST["aseguradobuscado"])) ? $_POST["aseguradobuscado"] : "";
$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txpoliza = new Poliza();

if (isset($_POST["accion"])) {
    $txpoliza->__SET("id", (isset($_POST["id"])) ? $_POST["id"] : "");
    $txpoliza->__SET("nombre_iva", (isset($_POST["nombre_iva"])) ? $_POST["nombre_iva"] : "");
    $txpoliza->__SET("descripcion_iva", (isset($_POST["descripcion_iva"])) ? $_POST["descripcion_iva"] : "");
}

switch ($txtAccion) {
    case "Agregar":
        $txpolizaModel = new PolizaModel();
        $txpolizaModel->Agregar($txpoliza);
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            // session isn't started
            session_start();
        }
        $_SESSION["msj_normal"] = " Los datos se grabaron correctamente";
        break;
    case "Buscar":
        $txpolizaModel = new PolizaModel();
        $listapolizas = $txpolizaModel->Buscar($txtaseguradoBuscado);
        break;
    case "Cancelar":
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/ivaform.php";
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
        <label for="titulo" class="labeltitulo" style="width: 100%;">POLIZAS</label>
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
                                        <span class="input-group-text" id="aseguradobuscado">Asegurado a Buscar: </span>
                                        <input type="text" id="aseguradobuscado" name="aseguradobuscado"
                                            class="form-control" placeholder=" ingrese dato a Buscar (Asegurado) "
                                            aria-label="iva" aria-describedby="iva">
                                        <button type="submit" name="accion" value="Buscar" class="btn btn-primary">
                                            Buscar Poliza <i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($listapolizas) and !empty($listapolizas)) { ?>
                        <!-- Resultado de Busqueda -->
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Poliza</th>
                                            <th>Endoso</th>
                                            <th>Compañia</th>
                                            <th>Sección</th>
                                            <th>Asegurado</th>
                                            <th>Vigencia desde</th>
                                            <th>hasta</th>
                                            <th>Descripción</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listapolizas as $poliza) { ?>
                                            <tr>
                                                <td>
                                                    <a href="#" title="Consultar Poliza">
                                                        <?php echo $poliza['poliza_nro'] ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $poliza['endoso_nro'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $poliza['nombre_compania'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $poliza['nombre_seccion'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $poliza['apellido_y_nombre_asegurado'] ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y',strtotime($poliza['vigencia_desde']))  ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y',strtotime($poliza['vigencia_hasta']))  ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $poliza['descripcion_asegurado'] ?>
                                                </td>
                                                <td>
                                                    <form method="POST" enctype="multipart/form-data"
                                                        action="polizaeditarborrar.php">
                                                        <input type="hidden" name="id" value="<?php echo $poliza['id'] ?>" />

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
                                        <input type="hidden" id="id" name="id" class="form-control" aria-label="id"
                                            aria-describedby="id" hide>
                                        <span class="input-group-text">POLIZA</span>
                                        <input type="text" id="nombre_iva" name="nombre_iva" class="form-control"
                                            placeholder="" aria-label="nombre_iva" aria-describedby="nombre_iva">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="descripcion_iva">Descripción</span>
                                        <input type="text" id="descripcion_iva" name="descripcion_iva"
                                            class="form-control" placeholder="" aria-label="descripcion_iva"
                                            aria-describedby="descripcion_iva">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">
                                        Grabar I.V.A. <i class="fa-solid fa-save"></i></button>
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