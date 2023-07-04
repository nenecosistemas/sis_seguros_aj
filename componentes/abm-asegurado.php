<?php
include("../config/bd.php");

$txtDni = (isset($_POST["dni_asegurado"])) ? $_POST["dni_asegurado"] : "";
$txtApellido = (isset($_POST["apellido_y_nombre_asegurado"])) ? $_POST["apellido_y_nombre_asegurado"] : "";
$txtDomicilio = (isset($_POST["domicilio_asegurado"])) ? $_POST["domicilio_asegurado"] : "";
$txtTelefono = (isset($_POST["telefono_asegurado"])) ? $_POST["telefono_asegurado"] : "";
$txtCorreo = (isset($_POST["correo_asegurado"])) ? $_POST["correo_asegurado"] : "";
$txtIva = (isset($_POST["tipoiva_asegurado"])) ? $_POST["tipoiva_asegurado"] : "";
$txtCuit = (isset($_POST["cuit_asegurado"])) ? $_POST["cuit_asegurado"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";

switch ($txtAccion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO aj_asegurado 
                (dni_asegurado,apellido_y_nombre_asegurado,domicilio_asegurado,
                telefono_asegurado,correo_asegurado,tipoiva_asegurado,cuit_asegurado) 
                values 
                (:dni_asegurado,:apellido_y_nombre_asegurado,:domicilio_asegurado,
                :telefono_asegurado,:correo_asegurado,:tipoiva_asegurado,:cuit_asegurado );");
        $sentenciaSQL->bindParam(':dni_asegurado', $txtDni);
        $sentenciaSQL->bindParam(':apellido_y_nombre_asegurado', $txtApellido);
        $sentenciaSQL->bindParam(':domicilio_asegurado', $txtDomicilio);
        $sentenciaSQL->bindParam(':telefono_asegurado', $txtTelefono);
        $sentenciaSQL->bindParam(':correo_asegurado', $txtCorreo);
        $sentenciaSQL->bindParam(':tipoiva_asegurado', $txtIva);
        $sentenciaSQL->bindParam(':cuit_asegurado', $txtCuit);
        $sentenciaSQL->execute();        
        break;
    case "Cancelar":
        echo "Boton Cancelar";
        break;
}
?>

<?php include("encabezado.php"); ?>
<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">

        <div class="card">
            <div class="card-header">
                <label for="titulo" class="labeltitulo" style="width: 100%;">ASEGURADO</label>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="#">
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text">DNI Asegurado</span>
                            <input type="text" id="dni_asegurado" name="dni_asegurado" class="form-control"
                                placeholder="" aria-label="dni_asegurado" aria-describedby="dni_asegurado">
                            <span class="input-group-text">Apellido y Nombre</span>
                            <input type="text" id="apellido_y_nombre_asegurado" name="apellido_y_nombre_asegurado"
                                class="form-control" placeholder="" aria-label="apellido_y_nombre_asegurado"
                                aria-describedby="apellido_y_nombre_asegurado">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="domicilio_asegurado">Domicilio</span>
                            <input type="text" id="domicilio_asegurado" name="domicilio_asegurado" class="form-control"
                                placeholder="" aria-label="domicilio_asegurado" aria-describedby="domicilio_asegurado">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="telefono_asegurado">Teléfono</span>
                            <input type="tel" id="telefono_asegurado" name="telefono_asegurado" class="form-control"
                                placeholder="" aria-label="telefono_asegurado" aria-describedby="telefono_asegurado">
                            <span class="input-group-text" id="email_asegurado">Correo Electónico</span>
                            <input type="email" id="correo_asegurado" name="correo_asegurado" class="form-control"
                                placeholder="" aria-label="email_asegurado" aria-describedby="email_asegurado">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="tipoiva_asegurado">Tipo IVA</label>
                            <select id="tipoiva_asegurado" name="tipoiva_asegurado" class="form-select"
                                id="tipoiva_asegurado">
                                <option selected>Seleccione Tipo de Iva...</option>
                                <option value="1">Responsable Inscripto</option>
                                <option value="2">Responsable no Inscripto</option>
                                <option value="3">IVA no Responsable</option>
                                <option value="4">IVA Sujeto Exento</option>
                                <option value="5">Consumidor Final</option>
                                <option value="6">Monotributo</option>
                                <option value="7">Sujeto no Categorizado</option>
                                <option value="8">Proveedor del Exterior</option>
                                <option value="9">Cliente del Exterior</option>
                                <option value="10">IVA Liberado – Ley Nº 19.640</option>
                                <option value="11">IVA Responsable Inscripto – Agente de Percepción</option>
                                <option value="12">Pequeño Contribuyente Eventual</option>
                                <option value="13">Monotributista Social</option>
                                <option value="14">Pequeño Contribuyente Eventual Social</option>
                            </select>
                            <span class="input-group-text" id="cuit_asegurado">C.U.I.T.</span>
                            <input type="text" id="cuit_asegurado" name="cuit_asegurado" class="form-control"
                                placeholder="99-99999999-9" aria-label="cuit_asegurado"
                                aria-describedby="cuit_asegurado">
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <button type="submit" name="accion" value="Agregar" class="btn btn-primary"> Grabar Asegurado <i
                                class="fa-solid fa-save"></i></button>
                        <button type="cancel" name="accion" value="Cancelar" class="btn btn-info"> Cancelar <i
                                class="fa-solid fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php include("pie.php"); ?>