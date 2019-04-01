<button data-id="<?php echo $proyecto['id'];?>" type="button" class="btn-editarProyecto btn" data-toggle="modal" data-target="#modalEditar">
    <i class="fas fa-pen-square"></i>
</button>
<div class="modal" id="modalEditar">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Editar Proyecto</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <!-- Modal body -->
            <div class="modal-body">                               
                <label for="editarNombre">Nombre Poyecto: </label>
                <input type="text" name="editarNombre" id="editarNombre" placeholder="Nombre Proyecto" autocomplete="off" class="form-control input-sm">
                <label for="editarDescripcion">Descripcion Poyecto: </label>
                <textarea name="editarDescripcion" id="editarDescripcion" cols="5" rows="5" class="form-control input-sm"></textarea>
                <label for="editarInicio">Fecha de Inicio: </label>
                <input type="date" name="editarInicio" id="editarInicio" value="<?php echo date('Y-m-d') ?>" class="form-control input-sm">                               
                <label for="editarFin">Fecha de Finalizacion: </label>
                <input type="date" name="editarFin" id="editarFin" value="<?php echo date('Y-m-d') ?>" class="form-control input-sm">
            </div>

                <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editarP" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>