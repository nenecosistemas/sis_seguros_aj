<?php
include_once("../clases/conexion.php");
include_once("../clases/compania.php");
include_once("../clases/iva.php");
include_once("../clases/companiamodel.php");
include_once("../clases/ivamodel.php");

include("encabezado.php");

$txtcompaniaBuscado = (isset($_POST["companiabuscado"])) ? $_POST["companiabuscado"] : "";
$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txcompania = new Compania();
$txiva = new Iva();

$txivaModel = new CompaniaModel();
$listaivas = $txivaModel->Buscar("");

if (isset($_POST["accion"])) {
    $txcompania->__SET("cuit_compania", (isset($_POST["cuit_compania"])) ? $_POST["cuit_compania"] : "");
    $txcompania->__SET("nombre_compania", (isset($_POST["nombre_compania"])) ? $_POST["nombre_compania"] : "");
    $txcompania->__SET("tipoiva_compania", (isset($_POST["tipoiva_compania"])) ? $_POST["tipoiva_compania"] : "");
    $txcompania->__SET("domicilio_compania", (isset($_POST["domicilio_compania"])) ? $_POST["domicilio_compania"] : "");
    $txcompania->__SET("telefono_compania", (isset($_POST["telefono_compania"])) ? $_POST["telefono_compania"] : "");
    $txcompania->__SET("correo_compania", (isset($_POST["correo_compania"])) ? $_POST["correo_compania"] : "");
}

switch ($txtAccion) {
    case "Agregar":
        $txcompaniaModel = new CompaniaModel();
        $txcompaniaModel->Agregar($txcompania);
        session_start();
        $_SESSION["msj_normal"] = " Los datos se grabaron correctamente";
        break;
    case "Buscar":
        $txcompaniaModel = new CompaniaModel();
        $listacompanias = $txcompaniaModel->Buscar($txtcompaniaBuscado);
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
        <label for="titulo" class="labeltitulo" style="width: 100%;">COMPAÑIA</label>
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
                                        <span class="input-group-text" id="companiabuscado">Compañia: </span>
                                        <input type="text" id="companiabuscado" name="companiabuscado" class="form-control" placeholder=" ingrese dato a Buscar (Compañia) " aria-label="compania" aria-describedby="compania">
                                        <button type="submit" name="accion" value="Buscar" class="btn btn-primary">
                                            Buscar compañia
                                            <i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($listacompanias) and !empty($listacompanias)) { ?>
                        <!-- Resultado de Busqueda -->
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>CUIT</th>
                                            <th>Nombre</th>
                                            <th>Domicilio</th>
                                            <th>Teléfono</th>
                                            <th>Correo Electrónico</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listacompanias as $compania) { ?>
                                            <tr>
                                                <td scope="row">
                                                    <?php echo $compania['cuit_compania'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $compania['nombre_compania'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $compania['domicilio_compania'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $compania['telefono_compania'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $compania['correo_compania'] ?>
                                                </td>
                                                <td>
                                                    <form method="POST" enctype="multipart/form-data" action="companiaeditarborrar.php">
                                                        <input type="hidden" name="id" value="<?php echo $compania['cuit_compania'] ?>" />

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
                                        <span class="input-group-text" id="cuit_compania">C.U.I.T.</span>
                                        <input type="text" id="cuit_compania" name="cuit_compania" class="form-control" placeholder="99-99999999-9" required pattern="[0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]-[0-9]" title="99-99999999-9" aria-label="cuit_compania" aria-describedby="cuit_compania">
                                        <span class="input-group-text">Nombre</span>
                                        <input type="text" id="nombre_compania" name="nombre_compania" class="form-control" placeholder="" aria-label="nombre_compania" aria-describedby="nombre_compania">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="domicilio_compania">Domicilio</span>
                                        <input type="text" id="domicilio_compania" name="domicilio_compania" class="form-control" placeholder="" aria-label="domicilio_compania" aria-describedby="domicilio_compania">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="telefono_compania">Teléfono</span>
                                        <input type="tel" id="telefono_compania" name="telefono_compania" class="form-control" placeholder="" aria-label="telefono_compania" aria-describedby="telefono_compania">
                                        <span class="input-group-text" id="email_compania">Correo Electónico</span>
                                        <input type="email" id="correo_compania" name="correo_compania" class="form-control" placeholder="" aria-label="correo_compania" aria-describedby="correo_compania">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="tipoiva_compania">Tipo IVA</label>
                                        <select id="tipoiva_compania" name="tipoiva_compania" class="form-select" id="tipoiva_compania">
                                            <option value="">Seleccione Tipo de Iva...</option>
                                            <?php foreach ($listaivas as $iva) { ?>
                                                <option value="<?php echo $iva['id'] ?>"><?php echo $iva['nombre_iva'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">
                                        Grabar
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