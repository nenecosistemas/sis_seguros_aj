<?php include("views/encabezado.php"); ?>      
<body class="bodyerror">
    <div class="d-flex align-items-center justify-content-center" id="Errorpage">
        <div class="text-center row">
            <div class=" col-md-6">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlLMlXwvbF60jB0rocckO1Ko9xgjanobQVIQ&usqp=CAU"
                    alt="" class="img-fluid">
            </div>
            <div class=" col-md-6">
                <p class="fs-3"> <span class="text-danger">Opps!</span> Pagina no encontrada.</p>
                <p class="lead">
                    La página que busca NO existe.
                </p>

                <a href="/sis_seguros_aj/index.php" class="btn btn-primary" id="pills-inicio-tab" type="button" role="tab"
                    aria-controls="pills-inicio" aria-selected="true"><i class="fa-solid fa-house"></i> Ir al
                    Inicio
                </a>
            </div>
        </div>
    </div>
</body>
<?php include("views/pie.php"); ?>       