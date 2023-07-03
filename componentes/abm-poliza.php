<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <div class="card">
            <div class="card-header">
                <label for="titulo" class="labeltitulo" style="width: 100%;">POLIZA</label>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="compania">Compañia</label>
                            <select class="form-select" id="compania">
                                <option selected>Seleccione compañia...</option>
                                <option value="1">Meridional</option>
                                <option value="2">Sancor</option>
                                <option value="2">La Caja</option>
                                <option value="3">Provincia</option>
                                <option value="4">Mapfre</option>
                                <option value="5">Mercantil Andina</option>
                            </select>
                            <label class="input-group-text" for="seccion">Sección</label>
                            <select class="form-select" id="seccion">
                                <option selected>Seleccione Sección...</option>
                                <option value="1">Automotor</option>
                                <option value="2">Hogar</option>
                                <option value="2">Cristales</option>
                                <option value="3">Vida</option>
                                <option value="4">Caución</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="asegurado">Asegurado</label>
                            <select class="form-select" id="asegurado">
                                <option selected>Seleccione Asegurado...</option>
                                <option value="1">Juranovic Andrea</option>                                
                                <option value="2">De Almeida Julio Cesar</option>
                                <option value="3">Recoliza Eduardo Alfredo</option>                        
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="poliza">Poliza</span>
                            <input type="text" class="form-control" placeholder="" aria-label="poliza"
                                aria-describedby="poliza">
                            <span class="input-group-text" id="poliza">Endoso</span>
                            <input type="text" class="form-control" placeholder="" aria-label="endoso"
                                aria-describedby="endoso">
                            <span class="input-group-text" id="poliza">Renueva Poliza</span>
                            <input type="text" class="form-control" placeholder="" aria-label="renueva"
                                aria-describedby="renueva">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="textoFecha_emision">Fecha de Emisión</span>
                            <input type="date" class="form-control" placeholder="" aria-label="fecha_emision"
                                aria-describedby="fecha_emision">
                            <span class="input-group-text" id="vigencia_desde">Vigencia</span>
                            <span class="input-group-text" id="vigencia_desde">desde:</span>
                            <input type="date" class="form-control" placeholder="" aria-label="vigencia_desde"
                                aria-describedby="vigencia_desde">
                            <span class="input-group-text" id="vigencia_hasta">hasta:</span>
                            <input type="date" class="form-control" placeholder="" aria-label="vigencia_hasta"
                                aria-describedby="vigencia_hasta">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="poliza">Descripción del Riesgo Asegurado</span>
                            <textarea class="form-control" id="descripcion_asegurado" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="poliza">Descripción de Cobertura Asegurada</span>
                            <textarea class="form-control" id="cobertura_asegurada" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="poliza">Suma Asegurada</span>
                            <input type="number" class="form-control" placeholder="" aria-label="suma_asegurada"
                                aria-describedby="suma_asegurada">
                            <span class="input-group-text" id="poliza">Prima</span>
                            <input type="number" class="form-control" placeholder="" aria-label="prima"
                                aria-describedby="Prima">
                            <span class="input-group-text" id="poliza">Premio</span>
                            <input type="number" class="form-control" placeholder="" aria-label="premio"
                                aria-describedby="Premio">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary"> Grabar Poliza <i
                                class="fa-solid fa-save"></i></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
<?php include("pie.php"); ?>