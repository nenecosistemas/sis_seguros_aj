<?php
include("../config/bd.php");

$txtAsegurado = (isset($_POST["aseguradobuscado"])) ? $_POST["aseguradobuscado"] : "";
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";

$listaAsegurados = [];

switch ($txtAccion) {
    case "Buscar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM aj_asegurado 
        WHERE apellido_y_nombre_asegurado LIKE CONCAT('%', :apellido_y_nombre_asegurado, '%') ");
        $sentenciaSQL->bindParam(':apellido_y_nombre_asegurado', $txtAsegurado, PDO::PARAM_STR);

        $sentenciaSQL->execute();
        $listaAsegurados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo "Boton Buscar";
        break;
    case "Cancelar":
        echo "Boton Cancelar";
        break;
}
?>

<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">

        <?php echo $txtAsegurado; ?>

        <!-- Pagina de Busqueda -->
        <div class="card">
            <div class="card-header">
                <label for="titulo" class="labeltitulo" style="width: 100%;">ASEGURADO</label>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="#" class="form-inline">
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="aseguradobuscado">Asegurado: </span>
                            <input type="text" id="aseguradobuscado" name="aseguradobuscado" class="form-control"
                                placeholder=" ingrese dato a Buscar (Apellido) " aria-label="asegurado"
                                aria-describedby="asegurado">
                            <button type="submit" name="accion" value="Buscar" class="btn btn-primary"> Buscar Asegurado
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
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen"></i></button>
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>
<?php include("pie.php"); ?>