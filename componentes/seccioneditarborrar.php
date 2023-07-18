<?php
include_once("../clases/conexion.php");
include_once("../clases/seccion.php");
include_once("../clases/seccionmodel.php");

$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txseccion = new Seccion();

if (isset($_POST["accion"])) {
    $txseccion->__SET("id", (isset($_POST["id"])) ? $_POST["id"] : "");    
    $txseccion->__SET("nombre_seccion", (isset($_POST["nombre_seccion"])) ? $_POST["nombre_seccion"] : "");    
    $txseccion->__SET("descripcion_seccion", (isset($_POST["descripcion_seccion"])) ? $_POST["descripcion_seccion"] : "");
}

switch ($txtAccion) {
    case "Seleccionar":
        $txseccionModel = new SeccionModel();
        $seccion = $txseccionModel->Seleccionar($txtId);
        $txtid = $seccion->id;        
        $txtnombre = $seccion->nombre_seccion;
        $txtdescripcion = $seccion->descripcion_seccion;
        break;
    case "Modificar":
        $txseccionModel = new SeccionModel();
        $txseccionModel->Modificar($txseccion, $txseccion->__GET("id"));
        session_start();
        $_SESSION["msj_normal"] = " Los datos se modificaron correctamente ";
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/seccionform.php";
            });
        </script>
        <?php
        break;
    case "Eliminar":
        $txseccionModel = new SeccionModel();
        $txseccionModel->Eliminar($txtId);
        session_start();
        $_SESSION["msj_normal"] = " La Sección " . $txtId . " Se elimino correctamente";
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/componentes/seccionform.php";
            });
        </script>
        <?php
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
<?php include("encabezado.php"); ?>
<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <label for="titulo" class="labeltitulo" style="width: 100%;">MODIFICAR SECCIÓN</label>
        <div class="container-fluid text-center " id="modificacompania" tabindex="0">
            <!-- abm -->
            <div class="row">
                <div class="col ">
                    <div class="card ">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">ID Sección</span>
                                    <input type="text" inputmode="numeric" id="id" readonly
                                        name="id" class="form-control" placeholder=""
                                        value="<?php echo $txtid; ?>" aria-label="id"
                                        aria-describedby="id">
                                    <span class="input-group-text">Nombre</span>
                                    <input type="text" id="nombre_seccion"
                                        name="nombre_seccion" class="form-control" placeholder=""
                                        value="<?php echo $txtnombre; ?>" aria-label="nombre_seccion"
                                        aria-describedby="nombre_seccion">
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="descripcion_seccion">Descripción</span>
                                        <input type="text" id="descripcion_seccion" name="descripcion_seccion"
                                            class="form-control" placeholder="" value="<?php echo $txtdescripcion; ?>"
                                            aria-label="descripcion_seccion" aria-describedby="descripcion_seccion">
                                    </div>
                                </div>                            

                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Modificar" class="btn btn-primary">
                                        Modificar
                                        compania <i class="fa-solid fa-save"></i></button>
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