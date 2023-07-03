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
                            <span class="input-group-text" id="dni_asegurado">DNI Asegurado</span>
                            <input type="text" class="form-control" placeholder="" aria-label="dni_asegurado"
                                aria-describedby="dni_asegurado">
                            <span class="input-group-text" id="apellido_y_nombre_asegurado">Apellido y Nombre</span>
                            <input type="text" class="form-control" placeholder=""
                                aria-label="apellido_y_nombre_asegurado" aria-describedby="apellido_y_nombre_asegurado">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="domicilio_asegurado">Domicilio</span>
                            <input type="text" class="form-control" placeholder="" aria-label="dni_asegurado"
                                aria-describedby="domicilio_asegurado">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="telefono_asegurado">Teléfono</span>
                            <input type="tel" class="form-control" placeholder="" aria-label="telefono_asegurado"
                                aria-describedby="telefono_asegurado">
                            <span class="input-group-text" id="email_asegurado">Correo Electónico</span>
                            <input type="tel" class="form-control" placeholder="" aria-label="email_asegurado"
                                aria-describedby="email_asegurado">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="tipoiva_asegurado">Tipo IVA</label>
                            <select class="form-select" id="tipoiva_asegurado">
                                <option selected>Seleccione Tipo de Iva...</option>
                                <option value="1">Consumidor Final</option>
                                <option value="2">Monotributo</option>
                                <option value="3">Inscripto</option>
                                <option value="4">Exento</option>
                            </select>
                            <span class="input-group-text" id="cuit_asegurado">C.U.I.T.</span>
                            <input type="number" class="form-control" placeholder="99-99999999-9"
                                aria-label="cuit_asegurado" aria-describedby="cuit_asegurado">
                        </div>
                    </div>
                    <div class="col-md-12 " >
                        <button type="submit" class="btn btn-primary"> Grabar Asegurado <i
                                class="fa-solid fa-save"></i></button>
                    </div>
                </form>
            </div>                        
        </div>
    </div>
</body>
<?php include("pie.php"); ?>