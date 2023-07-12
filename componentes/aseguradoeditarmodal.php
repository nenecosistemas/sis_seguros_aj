<div class="modal fade" id="ModificarModal" tabindex="-1" aria-labelledby="ModificarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModificarModalLabel">Modificar Asegurado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="guardar.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text">DNI Asegurado</span>
                            <input type="text" id="dni_asegurado" name="dni_asegurado" class="form-control"
                                placeholder="" aria-label="dni_asegurado" aria-describedby="dni_asegurado" disabled
                                value="<?php echo $txtdni; ?>">                                
                            <span class="input-group-text">Apellido y Nombre</span>
                            <input type="text" id="Txapellido_y_nombre_asegurado" name="Txapellido_y_nombre_asegurado"
                                class="form-control" placeholder="" aria-label="apellido_y_nombre_asegurado"
                                aria-describedby="apellido_y_nombre_asegurado"
                                value="<?php echo $txtapellido; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="domicilio_asegurado">Domicilio</span>
                            <input type="text" id="domicilio_asegurado" name="domicilio_asegurado" class="form-control"
                                placeholder="" aria-label="domicilio_asegurado" aria-describedby="domicilio_asegurado">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="telefono_asegurado">Teléfono</span>
                            <input type="tel" id="telefono_asegurado" name="telefono_asegurado" class="form-control"
                                placeholder="" aria-label="telefono_asegurado" aria-describedby="telefono_asegurado">
                            <span class="input-group-text" id="email_asegurado">Correo Electónico</span>
                            <input type="email" id="correo_asegurado" name="correo_asegurado" class="form-control"
                                placeholder="" aria-label="email_asegurado" aria-describedby="email_asegurado">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="tipoiva_asegurado">Tipo IVA</label>
                            <select id="tipoiva_asegurado" name="tipoiva_asegurado" class="form-select"
                                id="tipoiva_asegurado">
                                <option selected>Seleccione Tipo de Iva...</option>
                                <option value="1">Responsable Inscripto</option>
                                <option value="2">Responsable no Inscripto</option>
                                <option value="3">IVA no Responsable</option>
                                <option value="4">IVA Sujeto Exento</option>
                                <option value="5">Consumidor Final</option>
                                <option value="6">Monotributo</option>
                                <option value="7">Sujeto no Categorizado</option>
                                <option value="8">Proveedor del Exterior</option>
                                <option value="9">Cliente del Exterior</option>
                                <option value="10">IVA Liberado – Ley Nº 19.640</option>
                                <option value="11">IVA Responsable Inscripto – Agente de Percepción
                                </option>
                                <option value="12">Pequeño Contribuyente Eventual</option>
                                <option value="13">Monotributista Social</option>
                                <option value="14">Pequeño Contribuyente Eventual Social</option>
                            </select>
                            <span class="input-group-text" id="cuit_asegurado">C.U.I.T.</span>
                            <input type="text" id="cuit_asegurado" name="cuit_asegurado" class="form-control"
                                placeholder="99-99999999-9" aria-label="cuit_asegurado"
                                aria-describedby="cuit_asegurado">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="accion" value="Modificar" class="btn btn-primary"> Grabar
                    Asegurado <i class="fa-solid fa-save"></i></button>
                <button type="cancel" name="accion" value="Cancelar" class="btn btn-info"> Cancelar
                    <i class="fa-solid fa-save"></i></button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
