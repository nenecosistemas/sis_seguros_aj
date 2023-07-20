<?php
include_once("../clases/conexion.php");
include_once("../clases/iva.php");
include_once("../clases/ivamodel.php");

$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txiva = new Iva();

if (isset($_POST["accion"])) {
    $txiva->__SET("id", (isset($_POST["id"])) ? $_POST["id"] : "");
    $txiva->__SET("nombre_iva", (isset($_POST["nombre_iva"])) ? $_POST["nombre_iva"] : "");
    $txiva->__SET("descripcion_iva", (isset($_POST["descripcion_iva"])) ? $_POST["descripcion_iva"] : "");
}

switch ($txtAccion) {
    case "Seleccionar":
        $txivaModel = new IvaModel();
        $iva = $txivaModel->Seleccionar($txtId);
        $txtid = $iva->id;
        $txtnombre = $iva->nombre_iva;
        $txtdescripcion = $iva->descripcion_iva;
        break;
    case "Modificar":
        $txivaModel = new IvaModel();
        $txivaModel->Modificar($txiva, $txiva->__GET("id"));
        session_start();
        $_SESSION["msj_normal"] = " Los datos se modificaron correctamente ";
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/ivaform.php";
            });
        </script>
        <?php
        break;
    case "Eliminar":
        $txivaModel = new IvaModel();
        $txivaModel->Eliminar($txtId);
        session_start();
        $_SESSION["msj_normal"] = " La Sección " . $txtId . " Se elimino correctamente";
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/ivaform.php";
            });
        </script>
        <?php
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
<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <label for="titulo" class="labeltitulo" style="width: 100%;">MODIFICAR I.V.A.</label>
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
                                        <span class="input-group-text">Nombre</span>
                                        <input type="text" id="nombre_iva" name="nombre_iva" class="form-control"
                                            placeholder="" value="<?php echo $txtnombre; ?>" aria-label="nombre_iva"
                                            aria-describedby="nombre_iva">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="descripcion_iva">Descripción</span>
                                        <input type="text" id="descripcion_iva" name="descripcion_iva"
                                            class="form-control" placeholder="" value="<?php echo $txtdescripcion; ?>"
                                            aria-label="descripcion_iva" aria-describedby="descripcion_iva">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">ID I.V.A.</span>
                                        <input type="text" inputmode="numeric" id="id" readonly name="id"
                                            class="form-control" placeholder="" value="<?php echo $txtid; ?>"
                                            aria-label="id" aria-describedby="id">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Modificar" class="btn btn-primary">
                                        Modificar
                                        I.V.A. <i class="fa-solid fa-save"></i></button>
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