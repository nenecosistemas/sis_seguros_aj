<?php include("encabezado.php"); ?>
<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <div class="container-fluid">
            <ul class="nav nav-pills justify-content-around id=" menu" role="tablist"">  
                <li class=" nav-item" role="presentation">                    
                    <button class="nav-link" id="pills-consulta-tab" data-bs-toggle="pill" data-bs-target="#pills-consulta" type="button" role="tab" aria-controls="pills-consulta" aria-selected="true">Consulta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-alta-tab" data-bs-toggle="pill" data-bs-target="#pills-alta" type="button" role="tab" aria-controls="pills-alta" aria-selected="true">Alta</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Consulta -->
                <div class="container-fluid text-center tab-pane fade show active" id="pills-consulta" role="tabpanel" aria-labelledby="pills-consulta-tab" tabindex="0">
                    <!-- Pagina de Busqueda -->
                    <div class="card">
                        <div class="card-header">
                            <label for="titulo" class="labeltitulo" style="width: 100%;">COMPAÑIA</label>
                        </div>
                        <div class="card-body">
                            <form action="#" class="form-inline">
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="asegurado_a_buscar">Compañia: </span>
                                        <input type="text" class="form-control" placeholder=" ingrese compañia a Buscar " aria-label="compania" aria-describedby="compania">
                                        <button type="submit" class="btn btn-primary"> Buscar Compañia <i class="fa-solid fa-search"></i></button>
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
                                        <th>C.U.I.T</th>
                                        <th>Compañia</th>
                                        <th>Domicilio</th>
                                        <th>Telefono</th>
                                        <th>Correo Electrónico</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen"></i></button>
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen"></i></button>
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen"></i></button>
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- Alta -->
                <div class="container-fluid text-center tab-pane fade" id="pills-alta" role="tabpanel" aria-labelledby="pills-alta-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header">
                            <label for="titulo" class="labeltitulo" style="width: 100%;">COMPAÑIA</label>
                        </div>
                        <div class="card-body">
                            <form action="#">
                                <div class="form-group row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="cuit_compania">C.U.I.T.</span>
                                        <input type="number" class="form-control" placeholder="99-99999999-9" pattern="[0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]-[0-9]" aria-label="cuit_compania" aria-describedby="cuit_compania">
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
                                        <span class="input-group-text" id="telefono_compania">Teléfono</span>
                                        <input type="tel" class="form-control" placeholder="" aria-label="telefono_compania" aria-describedby="telefono_compania">
                                        <span class="input-group-text" id="email_compania">Correo Electónico</span>
                                        <input type="tel" class="form-control" placeholder="" aria-label="email_compania" aria-describedby="email_compania">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-primary"> Grabar <i class="fa-solid fa-save"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<?php include("pie.php"); ?>