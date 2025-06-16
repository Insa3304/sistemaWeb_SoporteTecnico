<div id="ventanaRegistro_categoria" class="modal fade bd-example-modal-lg"	role="dialog"aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
									<i class="font-icon-close-2"></i>
								</button>
								<h4 class="modal-title" id="ventanaTitulo_categoria"></h4>
							</div>
							<form method="post" id="formularioCategoria">
							<div class="modal-body">
								<input type="hidden" id="id_categoria" name="id_categoria">
								<div class = "form-group">
								<div class="form-label" for="nombre_categoria">Nombre</label>
							<input type="texto" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ingrese nueva categoria" required>
							</div>

	
							<div class="modal-footer">
								<button type="button"  class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
								<button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
							</div>
							</form>
						</div>
					</div>
				</div>