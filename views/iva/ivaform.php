<?php
include_once("../../controller/conexion.php");
include_once("../../model/iva.php");
include_once("../../controller/ivacontroller.php");
include("../encabezado.php");

$txtivaBuscado = (isset($_POST["ivabuscado"])) ? $_POST["ivabuscado"] : "";
$txtId = (isset($_POST["id"])) ? $_POST["id"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$txiva = new Iva();

if (isset($_POST["accion"])) {
    $txiva->__SET("id", (isset($_POST["id"])) ? $_POST["id"] : "");
    $txiva->__SET("nombre_iva", (isset($_POST["nombre_iva"])) ? $_POST["nombre_iva"] : "");
    $txiva->__SET("descripcion_iva", (isset($_POST["descripcion_iva"])) ? $_POST["descripcion_iva"] : "");
}

switch ($txtAccion) {
    case "Agregar":
        $txIvaController = new IvaController();
        $txIvaController->Agregar($txiva);
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            // session isn't started
            session_start();
        }
        $_SESSION["msj_normal"] = " Los datos se grabaron correctamente";
        break;
    case "Buscar":
        $txIvaController = new IvaController();
        $listaivas = $txIvaController->Buscar($txtivaBuscado);
        break;
    case "Cancelar":
        ?>
        <script>
            setTimeout(function () {
                window.location.href = "/sis_seguros_aj/views/iva/ivaform.php";
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
        setTimeout(function () {
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
        <label for="titulo" class="labeltitulo" style="width: 100%;">I.V.A.</label>
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
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="txivabuscado">Sección: </span>
                                        <input type="text" id="ivabuscado" name="ivabuscado"
                                            class="form-control" placeholder=" ingrese dato a Buscar (I.V.A.) "
                                            aria-label="iva" aria-describedby="iva">
                                        <button type="submit" name="accion" value="Buscar" class="btn btn-primary">
                                            Buscar I.V.A. <i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($listaivas) and !empty($listaivas)) { ?>
                        <!-- Resultado de Busqueda -->
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>I.V.A.</th>
                                            <th>Descripción</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listaivas as $iva) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $iva['nombre_iva'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $iva['descripcion_iva'] ?>
                                                </td>
                                                <td>
                                                    <form method="POST" enctype="multipart/form-data"
                                                        action="ivaeditarborrar.php">
                                                        <input type="hidden" name="id" value="<?php echo $iva['id'] ?>" />

                                                        <button type="submit" name="accion" value="Seleccionar"
                                                            data-bs-toggle="modal" data-bs-target="#ModificarModal"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                                        </button>

                                                        <button type="submit" name="accion" value="Eliminar"
                                                            class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i>
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
                <div class="container-fluid text-center tab-pane fade" id="pills-alta" role="tabpanel"
                    aria-labelledby="pills-alta-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="#">
                                <div class="form-group row">
                                    <div class="input-group mb-3">                                        
                                        <input type="hidden" id="id" name="id" class="form-control" aria-label="id"
                                            aria-describedby="id" hide>
                                        <span class="input-group-text">I.V.A.</span>
                                        <input type="text" id="nombre_iva" name="nombre_iva"
                                            class="form-control" placeholder="" aria-label="nombre_iva"
                                            aria-describedby="nombre_iva">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="descripcion_iva">Descripción</span>
                                        <input type="text" id="descripcion_iva" name="descripcion_iva"
                                            class="form-control" placeholder="" aria-label="descripcion_iva"
                                            aria-describedby="descripcion_iva">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">
                                        Grabar I.V.A. <i class="fa-solid fa-save"></i></button>
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
         document.getElementById("ivabuscado").focus();
      });
   </script>
</body>
<?php include("../pie.php"); ?>