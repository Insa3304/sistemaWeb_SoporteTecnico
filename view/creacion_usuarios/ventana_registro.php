<div id="ventanaRegistro" class="modal fade bd-example-modal-lg"	role="dialog"aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
									<i class="font-icon-close-2"></i>
								</button>
								<h4 class="modal-title" id="ventanaTitulo"></h4>
							</div>
							<form method="post" id="formularioUsuario">
							<div class="modal-body">
								<input type="hidden" id="id_usuario" name="id_usuario">
								<div class = "form-group">
								<div class="form-label" for="usuario_nombre">Nombre</label>
							<input type="texto" class="form-control" id="usuario_nombre" name="usuario_nombre" placeholder="Ingrese nombre del usuario" required>
							</div>

							<div class = "form-group">
								<div class="form-label" for="usuario_apellido">Appelido</label>
							<input type="texto" class="form-control" id="usuario_apellido" name="usuario_apellido" placeholder="Ingrese apellido del usuario" required>
							</div>

							<div class = "form-group">
								<div class="form-label" for="usuario_correo">Correo</label>
							<input type="texto" class="form-control" id="usuario_correo" name="usuario_correo" placeholder="Ingrese correo del usuario" required>
							</div>

							<div class = "form-group">
								<div class="form-label" for="usuario_contraseña">Contraseña</label>
							<input type="texto" class="form-control" id="usuario_contraseña" name="usuario_contraseña" placeholder="Ingrese contraseña del usuario" required>
							</div>

							<div class = "form-group">
								<div class="form-label" for="rol_id">Rol</label>
								<select class="select2" id="rol_id" name="rol_id">
									<option value="1">Usuario</option>
									<option value="2">Soporte</option>

										</select>
						
							</div>

							
							
							<div class="modal-footer">
								<button type="button"  class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
								<button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
							</div>
							</form>
						</div>
					</div>
				</div>