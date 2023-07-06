<?php
include("../config/bd.php");

$txtAsegurado = (isset($_POST["aseguradobuscado"])) ? $_POST["aseguradobuscado"] : "";
$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";

$txtDni = (isset($_POST["dni_asegurado"])) ? $_POST["dni_asegurado"] : "";
$txtApellido = (isset($_POST["apellido_y_nombre_asegurado"])) ? $_POST["apellido_y_nombre_asegurado"] : "";
$txtDomicilio = (isset($_POST["domicilio_asegurado"])) ? $_POST["domicilio_asegurado"] : "";
$txtTelefono = (isset($_POST["telefono_asegurado"])) ? $_POST["telefono_asegurado"] : "";
$txtCorreo = (isset($_POST["correo_asegurado"])) ? $_POST["correo_asegurado"] : "";
$txtIva = (isset($_POST["tipoiva_asegurado"])) ? $_POST["tipoiva_asegurado"] : "";
$txtCuit = (isset($_POST["cuit_asegurado"])) ? $_POST["cuit_asegurado"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";

$txtAsegurado = (isset($_POST["aseguradobuscado"])) ? $_POST["aseguradobuscado"] : "";

$listaAsegurados = [];

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
        session_start();
        $_SESSION["msj_normal"] = " Los datos se grabaron correctamente";
        break;
    case "Eliminar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM aj_asegurado WHERE dni_asegurado=:dni_asegurado");
        $sentenciaSQL->bindParam(':dni_asegurado', $txtId);
        $sentenciaSQL->execute();

        $_SESSION["msj_normal"] = " El documento " . $txtId . " Se elimino correctamente";
        echo $txtDni;
        break;
    case "Buscar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM aj_asegurado 
        WHERE apellido_y_nombre_asegurado LIKE CONCAT('%', :apellido_y_nombre_asegurado, '%') ");
        $sentenciaSQL->bindParam(':apellido_y_nombre_asegurado', $txtAsegurado, PDO::PARAM_STR);
        $sentenciaSQL->execute();
        $listaAsegurados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        //$_SESSION["msj_normal"] = " Se realizó la siguiente busqueda: ";
        echo "Boton Buscar";
        break;
    case "Cancelar":
        echo "Boton Cancelar";
        break;
}
?>
<?php include("encabezado.php"); ?>
<?php
## Mensajes comunes
if (isset($_SESSION["msj_normal"])) {
    $mensaje = $_SESSION["msj_normal"];
    ?>
    <script>
        Swal.fire('Mensaje!', '<?php echo $mensaje ?>', 'success');        
    </script>
    <?php
    unset($_SESSION["msj_normal"]);
}

## Mensajes de Errores
if (isset($_SESSION["msj_error"])) {
    $mensaje = $_SESSION["msj_error"];
    ?>
    <script>
        Swal.fire('Error!', '<?php echo $mensaje ?>', 'error');
        setTimeout(function () { window.location.href = "/sis_seguros_aj/index.php"; }, 1500);                
    </script>
    <?php
    unset($_SESSION["msj_normal"]);
}
?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <label for="titulo" class="labeltitulo" style="width: 100%;">ASEGURADO</label>
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
                            <form method="POST" enctype="multipart/form-data" action="#" >
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="aseguradobuscado">Asegurado: </span>
                                        <input type="text" id="aseguradobuscado" name="aseguradobuscado"
                                            class="form-control" placeholder=" ingrese dato a Buscar (Apellido) "
                                            aria-label="asegurado" aria-describedby="asegurado">
                                        <button type="submit" name="accion" value="Buscar" class="btn btn-primary">
                                            Buscar Asegurado
                                            <i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Resultado de Busqueda -->
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Apellido y Nombre</th>
                                        <th>Telefono</th>
                                        <th>Correo Electrónico</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listaAsegurados as $Asegurado) { ?>
                                        <tr>
                                            <td scope="row">
                                                <?php echo $Asegurado['dni_asegurado'] ?>
                                            </td>
                                            <td>
                                                <?php echo $Asegurado['apellido_y_nombre_asegurado'] ?>
                                            </td>
                                            <td>
                                                <?php echo $Asegurado['telefono_asegurado'] ?>
                                            </td>
                                            <td>
                                                <?php echo $Asegurado['correo_asegurado'] ?>
                                            </td>
                                            <td>
                                                <form method="POST" enctype="multipart/form-data" action="#">
                                                    <input type="hidden" name="id"
                                                        value="<?php echo $Asegurado['dni_asegurado'] ?>" />
                                                    <button type="button" name="accion" value="Modificar"
                                                        class="btn btn-info"><i class="fa-solid fa-pen"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ModificarModal"></i></button>
                                                    <button type="submit" name="accion" value="Eliminar"
                                                        class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="ModificarModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar Asegurado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" action="#">
                                    <div class="form-group row">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">DNI Asegurado</span>
                                            <input type="text" id="dni_asegurado" name="dni_asegurado"
                                                class="form-control" placeholder="" aria-label="dni_asegurado"
                                                aria-describedby="dni_asegurado" disabled>
                                            <span class="input-group-text">Apellido y Nombre</span>
                                            <input type="text" id="apellido_y_nombre_asegurado"
                                                name="apellido_y_nombre_asegurado" class="form-control" placeholder=""
                                                aria-label="apellido_y_nombre_asegurado"
                                                aria-describedby="apellido_y_nombre_asegurado">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="domicilio_asegurado">Domicilio</span>
                                            <input type="text" id="domicilio_asegurado" name="domicilio_asegurado"
                                                class="form-control" placeholder="" aria-label="domicilio_asegurado"
                                                aria-describedby="domicilio_asegurado">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="telefono_asegurado">Teléfono</span>
                                            <input type="tel" id="telefono_asegurado" name="telefono_asegurado"
                                                class="form-control" placeholder="" aria-label="telefono_asegurado"
                                                aria-describedby="telefono_asegurado">
                                            <span class="input-group-text" id="email_asegurado">Correo Electónico</span>
                                            <input type="email" id="correo_asegurado" name="correo_asegurado"
                                                class="form-control" placeholder="" aria-label="email_asegurado"
                                                aria-describedby="email_asegurado">
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
                                                <option value="11">IVA Responsable Inscripto – Agente de Percepción
                                                </option>
                                                <option value="12">Pequeño Contribuyente Eventual</option>
                                                <option value="13">Monotributista Social</option>
                                                <option value="14">Pequeño Contribuyente Eventual Social</option>
                                            </select>
                                            <span class="input-group-text" id="cuit_asegurado">C.U.I.T.</span>
                                            <input type="text" id="cuit_asegurado" name="cuit_asegurado"
                                                class="form-control" placeholder="99-99999999-9"
                                                aria-label="cuit_asegurado" aria-describedby="cuit_asegurado">
                                        </div>
                                    </div>                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="accion" value="Modificar" class="btn btn-primary"> Grabar
                                    Asegurado <i class="fa-solid fa-save"></i></button>
                                <button type="cancel" name="accion" value="Cancelar" class="btn btn-info"> Cancelar
                                    <i class="fa-solid fa-save"></i></button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin Modal -->

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
                                        <span class="input-group-text">DNI Asegurado</span>
                                        <input type="text" id="dni_asegurado" name="dni_asegurado" class="form-control"
                                            placeholder="" aria-label="dni_asegurado" aria-describedby="dni_asegurado">
                                        <span class="input-group-text">Apellido y Nombre</span>
                                        <input type="text" id="apellido_y_nombre_asegurado"
                                            name="apellido_y_nombre_asegurado" class="form-control" placeholder=""
                                            aria-label="apellido_y_nombre_asegurado"
                                            aria-describedby="apellido_y_nombre_asegurado">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="domicilio_asegurado">Domicilio</span>
                                        <input type="text" id="domicilio_asegurado" name="domicilio_asegurado"
                                            class="form-control" placeholder="" aria-label="domicilio_asegurado"
                                            aria-describedby="domicilio_asegurado">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="telefono_asegurado">Teléfono</span>
                                        <input type="tel" id="telefono_asegurado" name="telefono_asegurado"
                                            class="form-control" placeholder="" aria-label="telefono_asegurado"
                                            aria-describedby="telefono_asegurado">
                                        <span class="input-group-text" id="email_asegurado">Correo Electónico</span>
                                        <input type="email" id="correo_asegurado" name="correo_asegurado"
                                            class="form-control" placeholder="" aria-label="email_asegurado"
                                            aria-describedby="email_asegurado">
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
                                        <input type="text" id="cuit_asegurado" name="cuit_asegurado"
                                            class="form-control" placeholder="99-99999999-9" aria-label="cuit_asegurado"
                                            aria-describedby="cuit_asegurado">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary"> Grabar
                                        Asegurado <i class="fa-solid fa-save"></i></button>
                                    <button type="cancel" name="accion" value="Cancelar" class="btn btn-info"> Cancelar
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