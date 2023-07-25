<?php
if (!isset($_SESSION["entre"])) {
    ob_start();
    if (session_id() == "" && !headers_sent()) {
        session_start(["read_and_close" => true]);
        } 
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <html lang="es">
    <title>Sistema de Seguros AJ</title>
    <!-- 
  <base href="/sis_seguros_aj">
  -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/sis_seguros_aj/assets/favicon.ico">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- fontawesome CSS -->
    <script src="https://kit.fontawesome.com/b56caa63bd.js" crossorigin="anonumous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/sis_seguros_aj/css/styles.css" />
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<?php
$_SESSION['loggedin'] = (isset($_SESSION["entre"])) ? true : false;
?>

<div class="container-fluid" id="Encabezado">
    <nav class="navbar navbar-expand-lg bg-primary fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/sis_seguros_aj/index.php">
                <img src="/sis_seguros_aj/assets/logo.png" id="logo" alt="logo" width="40%" />
            </a>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            ?>

                <ul class="list-group list-group-horizontal" id="menu">
                    <li class="list-group-item border-0">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Polizas
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/polizaform.php">ABM - Poliza</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/consultapoliza.php">Consulta
                                        por Nro de Poliza</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/consultapolizaxcompaniaseccion.php">Consulta por
                                        Compañia -
                                        Sección</a></li>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/consultapolizaxriesgo.php">Consulta por Detalle de
                                        Riesgo</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/consultapolizaxvencimiento.php">Consulta por
                                        Vencimiento</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="list-group list-group-horizontal" id="menu">
                    <li class="list-group-item border-0">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Archivos Auxiliares
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/aseguradoform.php">Asegurados</a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/companiaform.php">Compañias</a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/seccionform.php">Secciones</a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/ivaform.php">I.V.A.</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            <?php
            }
            ?>
            <ul class="list-group list-group-horizontal" id="menu">
                <li class="list-group-item border-0">
                    <!-- Button trigger modal LOGIN-->
                    <?php
                    if (empty($_SESSION['loggedin'])) {
                    ?>
                        <a href="/sis_seguros_aj/componentes/login.php">
                            <i class="fa-solid fa-user-lock fa-2xl">
                            </i>
                        </a>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    ?>
                        <!-- Button LOGOUT-->
                <li>
                    <a href="/sis_seguros_aj/componentes/logout.php">
                        <i class="fa-solid fa-right-from-bracket fa-2xl">
                        </i>
                    </a>
                </li>
            <?php
                    }
            ?>
            </li>
            </ul>
        </div>
    </nav>
</div>

<?php
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
    unset($_SESSION["msj_error"]);    
}
?>