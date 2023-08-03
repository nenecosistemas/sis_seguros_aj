<?php
include_once("../../controller/conexion.php");
include_once("../../model/poliza.php");
include_once("../../controller/polizacontroller.php");
include_once("../../model/compania.php");
include_once("../../controller/companiacontroller.php");
include_once("../../model/seccion.php");
include_once("../../controller/seccioncontroller.php");
include_once("../../model/asegurado.php");
include_once("../../controller/aseguradocontroller.php");

include("../encabezado.php");

$txtaseguradoBuscado = (isset($_POST["aseguradobuscado"])) ? $_POST["aseguradobuscado"] : "";
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
    case "Agregar":
        $txPolizaModel = new PolizaModel();
        $txPolizaModel->Agregar($txPoliza);
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            // session isn't started
            session_start();
        }
        $_SESSION["msj_normal"] = " Los datos se grabaron correctamente";
        break;
    case "Buscar":
        $txPolizaModel = new PolizaModel();
        $listapolizas = $txPolizaModel->Buscar($txtaseguradoBuscado);
        break;
    case "Cancelar":
?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/views/poliza/polizaform.php";
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
                                        <span class="input-group-text" id="txtaseguradobuscado">Asegurado a Buscar: </span>
                                        <input type="text" id="aseguradobuscado" name="aseguradobuscado" class="form-control" placeholder=" ingrese dato a Buscar (Asegurado) " aria-label="iva" aria-describedby="iva">
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
                                <table class="table table-bordered table-hover" >
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
                                                <td>
                                                    <form method="POST" enctype="multipart/form-data" action="polizaeditarborrar.php">
                                                        <input type="hidden" name="id" value="<?php echo $poliza['id'] ?>" />

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
                                        <label class="input-group-text" for="compania_id">Compañia: </label>
                                        <select id="compania_id" name="compania_id" class="form-select" id="compania_id">
                                            <option selected>Seleccione Compañia...</option>
                                            <?php foreach ($listacompanias as $compania) { ?>
                                                <option value="<?php echo $compania['cuit_compania'] ?>"><?php echo $compania['nombre_compania'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="input-group-text" for="seccion_id">Seccion: </label>
                                        <select id="seccion_id" name="seccion_id" class="form-select" id="seccion_id">
                                            <option selected>Seleccione Sección...</option>
                                            <?php foreach ($listasecciones as $seccion) { ?>
                                                <option value="<?php echo $seccion['id'] ?>"><?php echo $seccion['nombre_seccion'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="asegurado_id">Asegurado: </label>
                                        <select id="asegurado_id" name="asegurado_id" class="form-select" id="asegurado_id">
                                            <option selected>Seleccione Asegurado...</option>
                                            <?php foreach ($listaasegurados as $asegurado) { ?>
                                                <option value="<?php echo $asegurado['dni_asegurado'] ?>"><?php echo $asegurado['apellido_y_nombre_asegurado'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="poliza_nro">Poliza</span>
                                        <input type="text" class="form-control" id="poliza_nro" name="poliza_nro" placeholder="" aria-label="poliza" aria-describedby="poliza">
                                        <span class="input-group-text" id="endoso_nro">Endoso</span>
                                        <input type="text" class="form-control" id="endoso_nro" name="endoso_nro" placeholder="" aria-label="endoso" aria-describedby="endoso">
                                        <span class="input-group-text" id="renovacion_poliza">Renueva Poliza</span>
                                        <input type="text" class="form-control" id="renovacion_poliza" name="renovacion_poliza" placeholder="" aria-label="renueva" aria-describedby="renueva">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="fecha_emision">Fecha de Emisión</span>
                                        <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" placeholder="" aria-label="fecha_emision" aria-describedby="fecha_emision">
                                        <span class="input-group-text">Vigencia</span>
                                        <span class="input-group-text">desde:</span>
                                        <input type="date" class="form-control" id="vigencia_desde" name="vigencia_desde" placeholder="" aria-label="vigencia_desde" aria-describedby="vigencia_desde">
                                        <span class="input-group-text" id="vigencia_hasta">hasta:</span>
                                        <input type="date" class="form-control" id="vigencia_hasta" name="vigencia_hasta" placeholder="" aria-label="vigencia_hasta" aria-describedby="vigencia_hasta">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="descripcion_asegurado">Descripción del Riesgo Asegurado</span>
                                        <textarea class="form-control" id="descripcion_asegurado" name="descripcion_asegurado" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="cobertura_asegurado">Descripción de Cobertura Asegurada</span>
                                        <textarea class="form-control" id="cobertura_asegurado" name="cobertura_asegurado" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">

                                        <span class="input-group-text" id="suma_asegurada">Suma Asegurada</span>
                                        <!-- data-type="currency" -->
                                        <input type="text" class="form-control" id="suma_asegurada" name="suma_asegurada" data-type="currency" placeholder="" aria-label="suma_asegurada" aria-describedby="suma_asegurada">
                                        <span class="input-group-text" id="prima">Prima</span>
                                        <input type="text" class="form-control" id="prima" name="prima" data-type="currency" placeholder="" aria-label="prima" aria-describedby="Prima">
                                        <span class="input-group-text" id="premio">Premio</span>
                                        <input type="text" class="form-control" id="premio" name="premio" data-type="currency" placeholder="" aria-label="premio" aria-describedby="Premio">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">
                                        Grabar POLIZA <i class="fa-solid fa-save"></i></button>
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
         document.getElementById("aseguradobuscado").focus();
      });
   </script>
</body>
<?php include("../pie.php"); ?>