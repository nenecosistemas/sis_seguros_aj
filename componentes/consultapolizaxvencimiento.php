<?php
include_once("../clases/conexion.php");
include_once("../clases/poliza.php");
include_once("../clases/polizamodel.php");
include_once("../clases/compania.php");
include_once("../clases/companiamodel.php");
include_once("../clases/seccion.php");
include_once("../clases/seccionmodel.php");
include_once("../clases/asegurado.php");
include_once("../clases/aseguradomodel.php");

include("encabezado.php");

$vencimientodesde = (isset($_POST["fechadesde"])) ? $_POST["fechadesde"] : "";
$vencimientohasta = (isset($_POST["fechahasta"])) ? $_POST["fechahasta"] : "";
$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txPoliza = new Poliza();

$txcompaniaModel = new CompaniaModel();
$listacompanias = $txcompaniaModel->Todos();

$txseccionModel = new SeccionModel();
$listasecciones = $txseccionModel->Todos();

$txaseguradoModel = new AseguradoModel();
$listaasegurados = $txaseguradoModel->Todos();

if (isset($_POST["accion"])) {
    $txPoliza->__SET("compania_id", (isset($_POST["compania_id"])) ? $_POST["compania_id"] : "");
    $txPoliza->__SET("compania_id", (isset($_POST["compania_id"])) ? $_POST["compania_id"] : "");
    $txPoliza->__SET("seccion_id", (isset($_POST["seccion_id"])) ? $_POST["seccion_id"] : "");
    $txPoliza->__SET("asegurado_id", (isset($_POST["asegurado_id"])) ? $_POST["asegurado_id"] : "");
    $txPoliza->__SET("poliza_nro", (isset($_POST["poliza_nro"])) ? $_POST["poliza_nro"] : "");
    $txPoliza->__SET("endoso_nro", (isset($_POST["endoso_nro"])) ? $_POST["endoso_nro"] : "");
    $txPoliza->__SET("renovacion_poliza", (isset($_POST["renovacion_poliza"])) ? $_POST["renovacion_poliza"] : "");
    $txPoliza->__SET("fecha_emision", (isset($_POST["fecha_emision"])) ? $_POST["fecha_emision"] : "");
    $txPoliza->__SET("vigencia_desde", (isset($_POST["vigencia_desde"])) ? $_POST["vigencia_desde"] : "");
    $txPoliza->__SET("vigencia_hasta", (isset($_POST["vigencia_hasta"])) ? $_POST["vigencia_hasta"] : "");
    $txPoliza->__SET("descripcion_asegurado", (isset($_POST["descripcion_asegurado"])) ? $_POST["descripcion_asegurado"] : "");
    $txPoliza->__SET("cobertura_asegurado", (isset($_POST["cobertura_asegurado"])) ? $_POST["cobertura_asegurado"] : "");
    $txPoliza->__SET("suma_asegurada", (isset($_POST["suma_asegurada"])) ? $_POST["suma_asegurada"] : "");
    $txPoliza->__SET("prima", (isset($_POST["prima"])) ? $_POST["prima"] : "");
    $txPoliza->__SET("premio", (isset($_POST["premio"])) ? $_POST["premio"] : "");
}

switch ($txtAccion) {
    case "Buscarvencimiento":
        $txPolizaModel = new PolizaModel();
        $listapolizas = $txPolizaModel->BuscarporVigenciahasta($vencimientodesde, $vencimientohasta);
        break;
    case "Cancelar":
?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/componentes/polizaform.php";
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
        <label for="titulo" class="labeltitulo" style="width: 100%;">POLIZAS</label>
        <div class="container-fluid">
            <ul class="nav nav-pills justify-content-around id=" menu" role="tablist"">  
                <li class=" nav-item" role="presentation">
                <button class="nav-link" id="pills-consulta-tab" data-bs-toggle="pill" data-bs-target="#pills-consulta" type="button" role="tab" aria-controls="pills-consulta" aria-selected="true">Consulta Polizas por Vencimiento de Vigencia</button>
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
                                        <span class="input-group-text" id="vigencia">Vencimiento - Vigencia desde: </span>
                                        <input type="date" id="fechadesde" name="fechadesde" class="form-control" placeholder="" aria-label="fechadesde" aria-describedby="fechadesde">
                                        <span class="input-group-text" id="aseguradobuscado">hasta: </span>
                                        <input type="date" id="fechahasta" name="fechahasta" class="form-control" placeholder="" aria-label="fechahasta" aria-describedby="fechahasta">
                                        <button type="submit" name="accion" value="Buscarvencimiento" class="btn btn-primary">
                                            Buscar Polizas <i class="fa-solid fa-search"></i></button>
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
                                <table class="table table-bordered table-hover">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listapolizas as $poliza) { ?>
                                            <tr>
                                                <td>
                                                    <!--<a href="#" title="Consultar Poliza">-->
                                                    <?php echo $poliza['poliza_nro'] ?>
                                                    <!--</a>-->
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
                                                    <?php echo date('d/m/Y', strtotime($poliza['vigencia_desde']))  ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y', strtotime($poliza['vigencia_hasta']))  ?>
                                                </td>

                                                <td>
                                                    <?php echo $poliza['descripcion_asegurado'] ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <form method="POST" enctype="multipart/form-data" action="pdf-consultapolizaxvencimiento.php">
                                    <input type="hidden" name="fechadesde" value="<?php echo $vencimientodesde ?>" />
                                    <input type="hidden" name="fechahasta" value="<?php echo $vencimientohasta ?>" />

                                    <button type="submit" name="accion" value="imprimir" data-bs-toggle="modal" data-bs-target="#ModificarModal" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-print"></i> Imprimir
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- fin div -->
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            document.getElementById("fechadesde").focus();
        });
    </script>
</body>
<?php include("pie.php"); ?>