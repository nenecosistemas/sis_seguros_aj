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
    $txPoliza->__SET("id", (isset($_POST["id"])) ? $_POST["id"] : "");
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
    case "Seleccionar":
        $txpolizaModel = new PolizaModel();
        $poliza = $txpolizaModel->Seleccionar($txtId);
        $txtid = $poliza->id;
        $compania = $poliza->compania_id;
        $seccion = $poliza->seccion_id;
        $asegurado = $poliza->asegurado_id;
        $polizanro = $poliza->poliza_nro;
        $endoso = $poliza->endoso_nro;
        $renueva = $poliza->renovacion_poliza;
        $emision = $poliza->fecha_emision;
        $desde = $poliza->vigencia_desde;
        $hasta = $poliza->vigencia_hasta;
        $descripcion = $poliza->descripcion_asegurado;
        $cobertura = $poliza->cobertura_asegurado;
        $suma = $poliza->suma_asegurada;
        $prima = $poliza->prima;
        $premio = $poliza->premio;
        break;
    case "Modificar":
        $txpolizaModel = new PolizaModel();
        $txpolizaModel->Modificar($txPoliza, $txPoliza->__GET("id"));
        session_start();
        $_SESSION["msj_normal"] = " Los datos se modificaron correctamente ";
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/polizaform.php";
            });
        </script>
        <?php
        break;
    case "Eliminar":
        $txpolizaModel = new PolizaModel();
        $txpolizaModel->Eliminar($txtId);
        session_start();
        $_SESSION["msj_normal"] = " La Sección " . $txtId . " Se elimino correctamente";
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/polizaform.php";
            });
        </script>
        <?php
        break;
    case "Cancelar":
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/polizaform.php";
            });
        </script>
        <?php
        break;
}

?>
<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <label for="titulo" class="labeltitulo" style="width: 100%;">MODIFICAR POLIZA</label>
        <div class="container-fluid text-center " id="modificacompania" tabindex="0">
            <!-- abm -->
            <div class="row">
                <div class="col ">
                    <div class="card ">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="compania_id">Compañia: </label>
                                        <select id="compania_id" name="compania_id" class="form-select"
                                            id="compania_id">
                                            <option selected>Seleccione Compañia...</option>
                                            <?php foreach ($listacompanias as $companias) { ?>
                                                <option value="<?php echo $companias['cuit_compania'] ?>" <?php echo ($compania == $companias['cuit_compania']) ? 'selected' : '' ?>><?php echo $companias['nombre_compania'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <script>
                                            $('select[name="compania_id"]').val("<?php echo $compania; ?>");
                                        </script>        
                                        <label class="input-group-text" for="seccion_id">Seccion: </label>
                                        <select id="seccion_id" name="seccion_id" class="form-select" id="seccion_id">
                                            <option selected>Seleccione Sección...</option>
                                            <?php foreach ($listasecciones as $secciones) { ?>
                                                <option value="<?php echo $secciones['id'] ?>" <?php echo ($seccion == $secciones['id']) ? 'selected' : '' ?>><?php echo $secciones['nombre_seccion'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <script>
                                            $('select[name="seccion_id"]').val("<?php echo $seccion; ?>");
                                        </script>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="asegurado_id">Asegurado: </label>
                                        <select id="asegurado_id" name="asegurado_id" class="form-select"
                                            id="asegurado_id">
                                            <option selected>Seleccione Asegurado...</option>
                                            <?php foreach ($listaasegurados as $asegurados) { ?>
                                                <option value="<?php echo $asegurados['dni_asegurado'] ?>" <?php echo ($asegurado == $asegurados['dni_asegurado']) ? 'selected' : '' ?>><?php echo $asegurados['apellido_y_nombre_asegurado'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="poliza_nro">Poliza</span>
                                        <input type="text" class="form-control" id="poliza_nro" name="poliza_nro"
                                            value="<?php echo $polizanro ?>" placeholder="" aria-label="poliza"
                                            aria-describedby="poliza">
                                        <span class="input-group-text" id="endoso_nro">Endoso</span>
                                        <input type="text" class="form-control" id="endoso_nro" name="endoso_nro"
                                            value="<?php echo $endoso ?>" placeholder="" aria-label="endoso"
                                            aria-describedby="endoso">
                                        <span class="input-group-text" id="renovacion_poliza">Renueva Poliza</span>
                                        <input type="text" class="form-control" id="renovacion_poliza"
                                            name="renovacion_poliza" value="<?php echo $renueva ?>" placeholder=""
                                            aria-label="renueva" aria-describedby="renueva">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="fecha_emision">Fecha de Emisión</span>
                                        <input type="date" class="form-control" id="fecha_emision" name="fecha_emision"
                                            value="<?php echo date('Y-m-d', strtotime($emision)) ?>" placeholder="" aria-label="fecha_emision"
                                            aria-describedby="fecha_emision">
                                        <span class="input-group-text">Vigencia</span>
                                        <span class="input-group-text">desde:</span>
                                        <input type="date" class="form-control" id="vigencia_desde"
                                            name="vigencia_desde" value="<?php echo date('Y-m-d', strtotime($desde)) ?>" placeholder=""
                                            aria-label="vigencia_desde" aria-describedby="vigencia_desde">
                                        <span class="input-group-text" id="vigencia_hasta">hasta:</span>
                                        <input type="date" class="form-control" id="vigencia_hasta"
                                            name="vigencia_hasta" value="<?php echo date('Y-m-d', strtotime($hasta)) ?>" placeholder=""
                                            aria-label="vigencia_hasta" aria-describedby="vigencia_hasta">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="descripcion_asegurado">Descripción del Riesgo
                                            Asegurado</span>
                                        <textarea class="form-control" id="descripcion_asegurado"
                                            name="descripcion_asegurado" value="<?php echo $descripcion ?>"
                                            rows="3"><?php echo $descripcion ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="cobertura_asegurado">Descripción de Cobertura
                                            Asegurada</span> 
                                        <textarea class="form-control" id="cobertura_asegurado"
                                            name="cobertura_asegurado" value="<?php echo $cobertura ?>"
                                            rows="3"><?php echo $cobertura ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="suma_asegurada">Suma Asegurada</span>
                                        <input type="number" class="form-control" id="suma_asegurada"
                                            name="suma_asegurada" value="<?php echo $suma ?>" placeholder=""
                                            aria-label="suma_asegurada" aria-describedby="suma_asegurada">
                                        <span class="input-group-text" id="prima">Prima</span>
                                        <input type="number" class="form-control" id="prima" name="prima"
                                            value="<?php echo $prima ?>" placeholder="" aria-label="prima"
                                            aria-describedby="Prima">
                                        <span class="input-group-text" id="premio">Premio</span>
                                        <input type="number" class="form-control" id="premio" name="premio"
                                            value="<?php echo $premio ?>" placeholder="" aria-label="premio"
                                            aria-describedby="Premio">
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">ID POLIZA</span>
                                        <input type="text" inputmode="numeric" id="id" readonly name="id"
                                            class="form-control" placeholder="" value="<?php echo $txtid; ?>"
                                            aria-label="id" aria-describedby="id">
                                    </div>
                                </div>                             
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Modificar" class="btn btn-primary">
                                        Modificar
                                        POLIZA <i class="fa-solid fa-save"></i></button>
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