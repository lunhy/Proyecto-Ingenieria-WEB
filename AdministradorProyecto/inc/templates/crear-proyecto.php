<div class="panel crear-proyecto">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistro">
                Nuevo Proyecto
            </button>   
            <!-- The Modal -->
            <div class="modal" id="modalRegistro">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Nuevo Proyecto</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">                               
                            <label for="nombreProyecto">Nombre Poyecto: </label>
                            <input type="text" name="nombreProyecto" id="nombreProyecto" placeholder="Nombre Proyecto" autocomplete="off" class="form-control input-sm">
                            <label for="descripcionProyecto">Descripcion Poyecto: </label>
                            <textarea name="descripcionProyecto" id="descripcionProyecto" cols="5" rows="5" class="form-control input-sm"></textarea>
                            <label for="fechaInicio">Fecha de Inicio: </label>
                            <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo date('Y-m-d') ?>" class="form-control input-sm">                               
                            <label for="fechaFin">Fecha de Finalizacion: </label>
                            <input type="date" name="fechaFin" id="fechaFin" value="<?php echo date('Y-m-d') ?>" class="form-control input-sm">
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="crearP" data-dismiss="modal">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    