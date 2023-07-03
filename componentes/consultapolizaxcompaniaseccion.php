<?php include("encabezado.php"); ?>

<body>
    <div class="col-md-12 justify-content-center" id="Normalpage">
        <!-- Pagina de Busqueda -->
        <div class="card">
            <div class="card-header">
                <label for="titulo" class="labeltitulo" style="width: 100%;">Polizas por Compañia</label>
            </div>
            <div class="card-body">
                <form action="#" class="form-inline">
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="compania_a_buscar">Compañia: </span>
                            <select class="form-select" id="compania">
                                <option selected>Seleccione compañia...</option>
                                <option value="1">Meridional</option>
                                <option value="2">Sancor</option>
                                <option value="2">La Caja</option>
                                <option value="3">Provincia</option>
                                <option value="4">Mapfre</option>
                                <option value="5">Mercantil Andina</option>
                            </select>
                            <span class="input-group-text" id="compania_a_buscar">Seccion: </span>
                            <select class="form-select" id="seccion">
                                <option selected>Seleccione Sección...</option>
                                <option value="1">Automotor</option>
                                <option value="2">Hogar</option>
                                <option value="2">Cristales</option>
                                <option value="3">Vida</option>
                                <option value="4">Caución</option>
                            </select>
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
                            <th>Nº Poliza</th>
                            <th>Endoso</th>
                            <th>Asegurado</th>
                            <th>Compañia</th>
                            <th>Sección</th>
                            <th>Emision</th>
                            <th>Vigencia desde</th>
                            <th>Vigencia Hasta</th>
                            <th>Descripcion Asegurado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-print"></i></button>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-pen"></i></button>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-print"></i></button>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-pen"></i></button>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>                                      
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td></td>                           
                            <td>
                                <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-print"></i></button>
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

</body>
<?php include("pie.php"); ?>