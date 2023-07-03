<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sistema de Seguros AJ</title>
  <!-- 
  <base href="/sis_seguros_aj">
  -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="/sis_seguros_aj/assets/favicon.ico">    
  <link rel="stylesheet" href="/sis_seguros_aj/css/styles.css" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <!-- fontawesome CSS -->
  <script src="https://kit.fontawesome.com/b56caa63bd.js" crossorigin="anonumous">
  </script>
</head>  
<div class="container-fluid" id="Encabezado">
    <nav class="navbar navbar-expand-lg bg-primary fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/sis_seguros_aj/index.php">
                <img src="/sis_seguros_aj/assets/logo.png" alt="" width="40%" />
            </a>
            <ul class="list-group list-group-horizontal" id="menu">
                <li class="list-group-item border-0">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Polizas
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/abm-poliza.php">Alta Poliza</a></li>
                        </ul>
                    </div>
                </li>
            </ul>    
            <ul class="list-group list-group-horizontal" id="menu">
                <li class="list-group-item border-0">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Consulta Poliza
                        </button>
                        <ul class="dropdown-menu">                            
                            <li><a class="dropdown-item" href="/consultapolizaxasegurado">Por Asegurado</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="/consultapoliza">Por Nro de Poliza</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="/consultapolizaxcompaniaseccion">Por Compañia - Sección</a></li>
                            <li><a class="dropdown-item" href="/consultapolizaxriesgo">Por Detalle de Riesgo</a></li>
                            <li><a class="dropdown-item" href="/consultapolizaxvencimiento">Por Vencimiento</a></li>
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
                            <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/abm-asegurado.php">Alta Asegurados</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="/abm-compania">Alta Compañias</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="/abm-seccion">Alta Secciones</a></li>
                            
                        </ul>
                    </div>
                </li>
            </ul>    
            <ul class="list-group list-group-horizontal" id="menu">    
                <li class="list-group-item border-0">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Otras Consultas
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/sis_seguros_aj/componentes/consultaasegurado.php">Consulta Asegurados</a></li>
                            <li><a class="dropdown-item" href="/consultacompania">Consulta Compañias</a></li>
                            <li><a class="dropdown-item" href="/consultaseccion">Consulta Secciones</a></li>
                        </ul>
                    </div>
                </li>
                <li class="list-group-item border-0">
                    <!-- Button trigger modal LOGIN-->
                    <?php
                    if (empty($_SESSION['loggedin'])) {
                        ?>
                        <i type="button" data-bs-toggle="modal" data-bs-target="#loginModal"
                            class="fa-solid fa-user-lock fa-2xl">
                        </i>
                        <?php
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        ?>
                        <!-- Button LOGOUT-->
                        fa-right-from-bracket
                        fa-2xl"
                        (click)="miLogout()">
                        <?php
                    }
                    ?>
                </li>
            </ul>            
        </div>
    </nav>
</div>
 