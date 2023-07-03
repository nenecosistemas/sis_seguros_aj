<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <div class="card">
            <div class="card-header">
                <label for="titulo" class="labeltitulo" style="width: 100%;">COMPAÑIA</label>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group row">
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="cuit_compania">C.U.I.T.</span>
                            <input type="number" class="form-control" placeholder="99-99999999-9" aria-label="cuit_compania" aria-describedby="cuit_compania">
                            <span class="input-group-text" id="nombre_compania">Compañia</span>
                            <input type="text" class="form-control" placeholder="" aria-label="nombre_compania" aria-describedby="nombre_compania">
                            <label class="input-group-text" for="tipoiva_compania">I.V.A.</label>
                            <select class="form-select" id="tipoiva_compania">
                                <option selected>Seleccione Tipo de Iva...</option>
                                <option value="1">Monotributo</option>
                                <option value="2">Inscripto</option>
                                <option value="3">Exento</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="domicilio_compania">Domicilio</span>
                            <input type="text" class="form-control" placeholder="" aria-label="domicilio_compania" aria-describedby="domicilio_compania">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="telefono_asegurado">Teléfono</span>
                            <input type="tel" class="form-control" placeholder="" aria-label="telefono_compania" aria-describedby="telefono_compania">
                            <span class="input-group-text" id="email_compania">Correo Electónico</span>
                            <input type="tel" class="form-control" placeholder="" aria-label="email_compania" aria-describedby="email_asegurado">
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