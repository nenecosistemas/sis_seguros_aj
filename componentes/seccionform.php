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
                <label for="titulo" class="labeltitulo" style="width: 100%;">SECCIÓN</label>
            </div>
            <div class="card-body">
                <form action="#" class="form-inline">
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="seccion_a_buscar">Sección: </span>
                            <input type="text" class="form-control" placeholder=" ingrese dato a Buscar " aria-label="asegurado"
                                aria-describedby="seccion">
                            <button type="submit" class="btn btn-primary"> Buscar <i
                                    class="fa-solid fa-search"></i></button>
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
                            <th>Sección</th>
                            <th>Descripción</th>                            
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-pen"></i></button>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-pen"></i></button>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"></td>
                            <td></td>                                                      
                            <td>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-pen"></i></button>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-trash"></i></button>
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
                <label for="titulo" class="labeltitulo" style="width: 100%;">SECCIÓN</label>
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
                        <button type="submit" class="btn btn-primary"> Grabar Sección <i class="fa-solid fa-save"></i></button>
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