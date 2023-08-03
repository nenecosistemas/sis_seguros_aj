<?php
include_once("../../controller/conexion.php");
include_once("../../model/usuario.php");
include_once("../../controller/usuariocontroller.php");

$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txAsegurado = new Asegurado();
$txiva = new Iva();

$txivaModel = new IvaModel();
$listaivas = $txivaModel->Todos();

if (isset($_POST["accion"])) {
    $txAsegurado->__SET("dni_asegurado", (isset($_POST["dni_asegurado"])) ? $_POST["dni_asegurado"] : "");
    $txAsegurado->__SET("apellido_y_nombre_asegurado", (isset($_POST["apellido_y_nombre_asegurado"])) ? $_POST["apellido_y_nombre_asegurado"] : "");
    $txAsegurado->__SET("domicilio_asegurado", (isset($_POST["domicilio_asegurado"])) ? $_POST["domicilio_asegurado"] : "");
    $txAsegurado->__SET("telefono_asegurado", (isset($_POST["telefono_asegurado"])) ? $_POST["telefono_asegurado"] : "");
    $txAsegurado->__SET("correo_asegurado", (isset($_POST["correo_asegurado"])) ? $_POST["correo_asegurado"] : "");
    $txAsegurado->__SET("tipoiva_asegurado", (isset($_POST["tipoiva_asegurado"])) ? $_POST["tipoiva_asegurado"] : "");
    $txAsegurado->__SET("cuit_asegurado", (isset($_POST["cuit_asegurado"])) ? $_POST["cuit_asegurado"] : "");
}

switch ($txtAccion) {
    case "Seleccionar":
        $txAseguradoModel = new AseguradoModel();
        $asegurado = $txAseguradoModel->Seleccionar($txtId);
        $txtdni = $asegurado->dni_asegurado;
        $txtapellido = $asegurado->apellido_y_nombre_asegurado;
        $txtdomicilio = $asegurado->domicilio_asegurado;
        $txttelefono = $asegurado->telefono_asegurado;
        $txtcorreo = $asegurado->correo_asegurado;
        $txtiva = $asegurado->tipoiva_asegurado;
        $txtcuit = $asegurado->cuit_asegurado;
        break;
    case "Modificar":
        $txAseguradoModel = new AseguradoModel();
        $txAseguradoModel->Modificar($txAsegurado, $txAsegurado->__GET("dni_asegurado"));
        session_start();
        $_SESSION["msj_normal"] = " Los datos se modificaron correctamente ";
?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/views/aseguradoform.php";
            });
        </script>
    <?php
        break;
    case "Eliminar":
        $txAseguradoModel = new AseguradoModel();
        $txAseguradoModel->Eliminar($txtId);
        session_start();
        $_SESSION["msj_normal"] = " El documento " . $txtId . " Se elimino correctamente";
    ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/views/aseguradoform.php";
            });
        </script>
    <?php
        break;
    case "Cancelar":
    ?>
        <script>
            setTimeout(function() {
                window.location.href = "/sis_seguros_aj/views/aseguradoform.php";
            });
        </script>
<?php
        break;
}

?>
<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <label for="titulo" class="labeltitulo" style="width: 100%;">MODIFICAR ASEGURADO</label>
        <div class="container-fluid text-center " id="modificaAsegurado" tabindex="0">
            <!-- abm -->
            <div class="row">
                <div class="col ">
                    <div class="card ">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">DNI Asegurado</span>
                                    <input type="text" inputmode="numeric" id="dni_asegurado" readonly name="dni_asegurado" class="form-control" placeholder="" value="<?php echo $txtdni; ?>" aria-label="dni_asegurado" aria-describedby="dni_asegurado">
                                    <span class="input-group-text">Apellido y Nombre</span>
                                    <input type="text" id="apellido_y_nombre_asegurado" name="apellido_y_nombre_asegurado" class="form-control" placeholder="" value="<?php echo $txtapellido; ?>" aria-label="apellido_y_nombre_asegurado" aria-describedby="apellido_y_nombre_asegurado">
                                </div>

                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="domicilio_asegurado">Domicilio</span>
                                        <input type="text" id="domicilio_asegurado" name="domicilio_asegurado" class="form-control" placeholder="" value="<?php echo $txtdomicilio; ?>" aria-label="domicilio_asegurado" aria-describedby="domicilio_asegurado">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="telefono_asegurado">Teléfono</span>
                                        <input type="tel" id="telefono_asegurado" name="telefono_asegurado" class="form-control" placeholder="" value="<?php echo $txttelefono; ?>" aria-label="telefono_asegurado" aria-describedby="telefono_asegurado">
                                        <span class="input-group-text" id="email_asegurado">Correo
                                            Electónico</span>
                                        <input type="email" id="correo_asegurado" name="correo_asegurado" class="form-control" placeholder="" value="<?php echo $txtcorreo; ?>" aria-label="email_asegurado" aria-describedby="email_asegurado">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="tipoiva_asegurado">Tipo
                                            IVA</label>
                                        <select id="tipoiva_asegurado" name="tipoiva_asegurado" value="<?php echo $txtiva; ?>" class="form-select" id="tipoiva_asegurado">
                                            <option selected>Seleccione Tipo de Iva...</option>
                                            <?php foreach ($listaivas as $iva) { ?>
                                                <option value="<?php echo $iva['id'] ?>" <?php echo ($txtiva == $iva['id']) ? 'selected' : '' ?>><?php echo $iva['nombre_iva'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <script>
                                            $('select[name="tipoiva_asegurado"]').val("<?php echo $txtiva; ?>");
                                        </script>
                                        <span class="input-group-text" id="cuit_asegurado">C.U.I.T.</span>
                                        <input type="text" id="cuit_asegurado" name="cuit_asegurado" class="form-control" placeholder="99-99999999-9" value="<?php echo $txtcuit; ?>" aria-label="cuit_asegurado" aria-describedby="cuit_asegurado">
                                    </div>
                                </div>

                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Modificar" class="btn btn-primary">
                                        Modificar
                                        Asegurado <i class="fa-solid fa-save"></i></button>
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