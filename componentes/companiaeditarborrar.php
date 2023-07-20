<?php
include_once("../clases/conexion.php");
include_once("../clases/compania.php");
include_once("../clases/iva.php");
include_once("../clases/companiamodel.php");
include_once("../clases/ivamodel.php");

$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txcompania = new Compania();
$txiva = new Iva();

$txivaModel = new IvaModel();
$listaivas = $txivaModel->Todos();


if (isset($_POST["accion"])) {
    $txcompania->__SET("cuit_compania", (isset($_POST["cuit_compania"])) ? $_POST["cuit_compania"] : "");
    $txcompania->__SET("nombre_compania", (isset($_POST["nombre_compania"])) ? $_POST["nombre_compania"] : "");
    $txcompania->__SET("tipoiva_compania", (isset($_POST["tipoiva_compania"])) ? $_POST["tipoiva_compania"] : "");
    $txcompania->__SET("domicilio_compania", (isset($_POST["domicilio_compania"])) ? $_POST["domicilio_compania"] : "");
    $txcompania->__SET("telefono_compania", (isset($_POST["telefono_compania"])) ? $_POST["telefono_compania"] : "");
    $txcompania->__SET("correo_compania", (isset($_POST["correo_compania"])) ? $_POST["correo_compania"] : "");
}

switch ($txtAccion) {
    case "Seleccionar":
        $txcompaniaModel = new CompaniaModel();
        $compania = $txcompaniaModel->Seleccionar($txtId);
        $txtcuit = $compania->cuit_compania;
        $txtiva = $compania->tipoiva_compania;
        $txtnombre = $compania->nombre_compania;
        $txtdomicilio = $compania->domicilio_compania;
        $txttelefono = $compania->telefono_compania;
        $txtcorreo = $compania->correo_compania;
        break;
    case "Modificar":
        $txcompaniaModel = new companiaModel();
        $txcompaniaModel->Modificar($txcompania, $txcompania->__GET("cuit_compania"));
        session_start();
        $_SESSION["msj_normal"] = " Los datos se modificaron correctamente ";
?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/componentes/companiaform.php";
            });
        </script>
    <?php
        break;
    case "Eliminar":
        $txcompaniaModel = new CompaniaModel();
        $txcompaniaModel->Eliminar($txtId);
        session_start();
        $_SESSION["msj_normal"] = " El documento " . $txtId . " Se elimino correctamente";
    ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/componentes/companiaform.php";
            });
        </script>
    <?php
        break;
    case "Cancelar":
    ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/componentes/companiaform.php";
            });
        </script>
<?php
        break;
}

?>
<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <label for="titulo" class="labeltitulo" style="width: 100%;">MODIFICAR COMPAÑIA</label>
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
                                    <span class="input-group-text">CUIT Compañia</span>
                                    <input type="text" inputmode="numeric" id="cuit_compania" readonly name="cuit_compania" class="form-control" placeholder="" value="<?php echo $txtcuit; ?>" aria-label="cuit_compania" aria-describedby="cuit_compania">
                                    <span class="input-group-text">Apellido y Nombre</span>
                                    <input type="text" id="nombre_compania" name="nombre_compania" class="form-control" placeholder="" value="<?php echo $txtnombre; ?>" aria-label="nombre_compania" aria-describedby="nombre_compania">
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="domicilio_compania">Domicilio</span>
                                        <input type="text" id="domicilio_compania" name="domicilio_compania" class="form-control" placeholder="" value="<?php echo $txtdomicilio; ?>" aria-label="domicilio_compania" aria-describedby="domicilio_compania">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="telefono_compania">Teléfono</span>
                                        <input type="tel" id="telefono_compania" name="telefono_compania" class="form-control" placeholder="" value="<?php echo $txttelefono; ?>" aria-label="telefono_compania" aria-describedby="telefono_compania">
                                        <span class="input-group-text" id="email_compania">Correo
                                            Electónico</span>
                                        <input type="email" id="correo_compania" name="correo_compania" class="form-control" placeholder="" value="<?php echo $txtcorreo; ?>" aria-label="email_compania" aria-describedby="email_compania">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="tipoiva_compania">Tipo
                                            IVA</label>
                                        <select id="tipoiva_compania" name="tipoiva_compania" value="<?php echo $txtiva; ?>" class="form-select" id="tipoiva_compania">
                                            <option selected>Seleccione Tipo de Iva...</option>
                                            <?php foreach ($listaivas as $iva) { ?>
                                                <option value="<?php echo $iva['id'] ?>" <?php echo ($txtiva == $iva['id']) ? 'selected' : '' ?>><?php echo $iva['nombre_iva'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <script>
                                            $('select[name="tipoiva_compania"]').val("<?php echo $txtiva; ?>");
                                        </script>
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