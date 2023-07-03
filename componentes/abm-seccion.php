<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <div class="card">
            <div class="card-header">
                <label for="titulo" class="labeltitulo" style="width: 100%;">ASEGURADO</label>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="nombre_seccion">Sección</span>
                            <input type="text" class="form-control" placeholder="" aria-label="nombre_seccion" aria-describedby="nombre_seccion">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="descripcion_seccion">Descripción</span>
                            <textarea class="form-control" id="descripcion_seccion" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-primary"> Grabar Asegurado <i class="fa-solid fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php include("pie.php"); ?>