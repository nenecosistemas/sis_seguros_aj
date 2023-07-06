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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <!-- fontawesome CSS -->
    <script src="https://kit.fontawesome.com/b56caa63bd.js" crossorigin="anonumous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/sis_seguros_aj/css/styles.css" />
</head>
<?php

$_SESSION["loggedin"] = true;

/*
include("../config/bd.php");
$txAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
//echo "<br><br><br><br><br><br>";
echo $txAccion;
switch ($txAccion) {
   case "login":
       echo "Boton login";
       session_start();
       //$_SESSION["loggedin"] = true;
       break;
   case "logout":
       echo "Boton logout";
       //unset($_SESSION["loggedin"]);
       break;
   case "Cancelar":
       echo "Boton Cancelar";
       break;
}
*/
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
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Polizas
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/abm-poliza.php">Alta
                                        Poliza</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item"
                                        href="/sis_seguros_aj/componentes/consultapolizaxasegurado.php">Consulta por
                                        Asegurado</a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/consultapoliza.php">Consulta
                                        por Nro de Poliza</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item"
                                        href="/sis_seguros_aj/componentes/consultapolizaxcompaniaseccion.php">Consulta por
                                        Compañia -
                                        Sección</a></li>
                                <li><a class="dropdown-item"
                                        href="/sis_seguros_aj/componentes/consultapolizaxriesgo.php">Consulta por Detalle de
                                        Riesgo</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item"
                                        href="/sis_seguros_aj/componentes/consultapolizaxvencimiento.php">Consulta por
                                        Vencimiento</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="list-group list-group-horizontal" id="menu">
                    <li class="list-group-item border-0">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Archivos Auxiliares
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/asegurado.php">Asegurados</a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/compania.php">Compañias</a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/seccion.php">Secciones</a>
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
                        <i type="button" id="login" data-bs-toggle="modal" data-bs-target="#loginModal"
                            class="fa-solid fa-user-lock fa-2xl">
                        </i>
                        <?php
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        ?>
                        <!-- Button LOGOUT-->
                        <i type="button" id="logout" data-bs-toggle="modal" data-bs-target="#logoutModal"
                            class="fa-solid fa-right-from-bracket fa-2xl">
                        </i>
                        <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Modal Login-->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LogIn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="login" name="login" enctype="multipart/form-data" action="#"
                        class="form-inline">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo Electrónico</label>
                            <input type="email" class="form-control" id="CorreoUsuario" aria-describedby="emailHelp"
                                placeholder="Ingrese correo electronico">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Clave</label>
                            <input type="password" class="form-control" id="ClaveUsuario" placeholder="Clave">
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="accion" value="login" class="btn btn-primary">Ingresar</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Logout-->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <?php $_SESSION["loggedin"] = false; ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LogOut</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="login" name="login" enctype="multipart/form-data" action="#"
                        class="form-inline">                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="accion" value="logout" class="btn btn-primary">Salir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->
</div>

<?php
if (isset($_SESSION["msj_error"])) {
    $mensaje = $_SESSION["msj_error"];
    ?>
    <script>
        Swal.fire('Error!', '<?php echo $mensaje ?>', 'error');
        setTimeout(function () { window.location.href = "/sis_seguros_aj/index.php"; }, 1500);                
    </script>
    <?php
    unset($_SESSION["msj_error"]);
}
?>