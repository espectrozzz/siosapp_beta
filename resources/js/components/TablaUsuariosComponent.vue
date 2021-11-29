<template>
	<div>

		<!-- Modal -->
		<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">{{titulo_modal}} {{usuario_actual}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="reiniciarModal()">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="usuario" v-if="numero_modal==1">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default">
										Nombre
									</span>
								</div>
								<input v-model="usuario_nuevo" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" :placeholder="usuario_actual">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default">
										Usuario
									</span>
								</div>
								<input v-model="usuario_correo_nuevo" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" :placeholder="usuario_correo_actual">
							</div>
						</div>
						<div class="usuario" v-if="numero_modal==2">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default">
										Nueva contraseña
									</span>
								</div>
								<input v-model="password_nueva" type="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default">
										Confirmar contraseña
									</span>
								</div>
								<input v-model="password_confirm" type="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
							</div>
						</div>
						<div class="usuario" v-if="numero_modal==3">
							<select v-model="roles_select" id="select-roles" name="roles" class="custom-select my-1 mr-sm-2">
				                <option  v-for="(value,index) in roles" :value="index+1">
				                    {{roles[index]}}
				                </option>
				            </select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal" @click="reiniciarModal()">Cerrar</button>
						<button type="button" class="btn btn-success" @click="guardarDatosUsuario(usuario_nuevo, usuario_correo_nuevo, usuario_id_actual)" v-if="numero_modal==1">Guardar cambios</button>
						<button type="button" class="btn btn-success" @click="guardarDatosPassword(password_nueva, password_confirm, usuario_id_actual)" v-if="numero_modal==2">Guardar cambios</button>
						<button type="button" class="btn btn-success" @click="guardarDatosRol(roles_select, usuario_id_actual)" v-if="numero_modal==3">Guardar cambios</button>
					</div>
				</div>
			</div>
		</div>

		<div class="container" style="height: auto;">
			<div class="row align-items-center">
				<!-- <form class="form-inline my-2 my-lg-0"> -->
					<div style="display: flex; width:100%; justify-content:space-between;align-items:center;">
						<div class="form-outline" style="width:50%;">
						  <input v-model="filtro_input" type="search" id="form1" class="form-control" placeholder="Buscar usuario" aria-label="Search" @input="actualizarTabla()"/>
						</div>
<!-- v-on:keydown="actualizarTabla" -->
						<select v-model="roles_select" id="select-roles-input" name="roles" class="custom-select my-1 mr-sm-2" @change="actualizarTabla()" style="width: 40%;">
				            <option value="0" selected> Seleccione un rol </option>
			                <option  v-for="(value,index) in roles" :value="index+1">
			                    {{roles[index]}}
			                </option>
			            </select>
					</div>
					<!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form> -->
				<div style="width: 100%; height: 20px;"></div>

				<div class="row" style="width:100%">
					<div class="col-md-12">
						<table class="table table-hover">
							<thead class="thead-light">
								<tr>
									<th style="text-align:center;">Usuario</th>
									<th style="text-align:center;">Rol</th>
									<th style="text-align:center;">Herramientas</th>
								</tr>
							</thead>
							<tbody>
								<!-- <tr v-for="(value,index) in permisos"> -->
								<tr v-if="coincidencias == 0">
									<td colspan="3" style="text-align:center;"> 
										No se encontraron coincidencias
									</td>
								</tr>
								<tr v-for="(value,index) in usuarios_nombre">
									<td style="text-align:center;">
										<strong>{{ usuarios_nombre[index] }}</strong>
									</td>
									<td style="text-align:center;">
										{{ usuarios_rol[index] }}
									</td>
									<td style="display:flex; justify-content:space-around;">
										<button type="button" class="btn btn-info" @click="editarUsuario(usuarios_rol_id[index], usuarios_id[index], usuarios_rol[index], usuarios_nombre[index], usuarios_correo[index])" data-toggle="modal" data-target="#editarModal">
											<i class="material-icons">person_outline</i>
										</button>
										<button type="button" class="btn btn-primary" @click="editarContrasenia(usuarios_rol_id[index], usuarios_id[index], usuarios_rol[index], usuarios_nombre[index], usuarios_correo[index])" data-toggle="modal" data-target="#editarModal">
											<i class="material-icons">lock_open</i>
										</button>
										<button type="button" class="btn btn-dark" @click="editarRol(usuarios_rol_id[index], usuarios_id[index], usuarios_rol[index], usuarios_nombre[index], usuarios_correo[index])" data-toggle="modal" data-target="#editarModal">
											<i class="material-icons">badge</i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

	<script>
	export default {
		data(){
			return{
				roles:[],
                roles_select:"0",
                filtro_input:"",
                usuarios_id:[],
                usuarios_nombre:[],
                usuarios_rol:[],
                usuarios_rol_id:[],
                usuarios_correo:[],
                usuario_actual:"",
                usuario_nuevo:"",
                usuario_id_actual:"",
                usuario_correo_actual:"",
                usuario_correo_nuevo:"",
                password_nueva:"",
                password_confirm:"",
                numero_modal:0,
                titulo_modal:"",
                coincidencias: 1,
			}
		},
		mounted() {
           this.cargarTablaRol();
           this.cargarTablaUsuarios();
       },
       methods:{
       	cargarTablaRol(){
       		axios.get('/cargar-roles').then((response)=>{
       			response.data.forEach(element =>{
       				this.roles.push(element.name);
       			});           
       		});
       	},
       	cargarTablaUsuarios(){
        	let i = 0;
        	let vacio = "";
        	this.coincidencias = 1;
        	axios.get('/cargar-usuarios', {params:{rol:this.roles_select, nombre:this.filtro_input}}).then((response)=>{
        		// console.log(response.data);
        		response.data.forEach(element =>{
        			this.usuarios_id.push(element.id);
        			this.usuarios_nombre.push(element.name);
        			this.usuarios_correo.push(element.email);
        			this.usuarios_rol_id.push(element.id_rol);
        			this.usuarios_rol.push(element.name_rol);
        		});  
        		if (this.usuarios_id.length == 0) { this.coincidencias = 0 }      
        	});
      },
      editarUsuario(rol_id, usuario_id, rol, nombre, correo){
      	// console.log(correo);
        this.asignarBotones(rol_id, usuario_id, rol, nombre, correo);
        this.numero_modal = 1;
        this.titulo_modal = "Editar usuario a "; 
      },
      editarContrasenia(rol_id, usuario_id, rol, nombre, correo){
      	// console.log(correo);
        this.asignarBotones(rol_id, usuario_id, rol, nombre, correo);
        this.numero_modal = 2;
        this.titulo_modal = "Editar contraseña a "; 
      },
      editarRol(rol_id, usuario_id, rol, nombre, correo){
      	// console.log(correo);	
      	this.roles = [];
        this.asignarBotones(rol_id, usuario_id, rol, nombre, correo);
        this.numero_modal = 3;
        this.titulo_modal = "Editar rol asociado a ";
        this.roles_select = rol_id;
        this.cargarTablaRol();
      },
      asignarBotones(rol_id, usuario_id, rol, nombre, correo){
		this.rol_id_actual = rol_id;
        this.usuario_actual = nombre;
        this.usuario_correo_actual = correo;
        this.usuario_id_actual = usuario_id;
      },
      reiniciarModal(){
      	this.reiniciarValores();
        this.roles_select = "0";
      	this.numero_modal = 0;
        this.titulo_modal = "";
        this.cargarTablaUsuarios();
        $('#editarModal').modal('hide');
      },
      guardarDatosUsuario(usuario, correo, id_usuario){
      	axios.get('/editar-usuario', {params:{usuario:usuario, correo:correo, id:id_usuario}}).then((response)=>{
      			// console.log(response.data);
      			if (response.data == 200) {
	      			Swal.fire(
	      				'Usuario actualizado',
	      				'¡Usuario actualizado correctamente',
	      				'success'
	      				)
      			}else{
      				console.log("error");
      			}
        });
      	this.reiniciarModal();
      },
      guardarDatosPassword(password_nueva, password_confirm, id_usuario){
      	axios.get('/editar-password', {params:{password:password_nueva, password_confirm:password_confirm, id:id_usuario}}).then((response)=>{
      			console.log(response);
      			if (response.data == 200) {
	      			Swal.fire(
	      				'Contraseña actualizada',
	      				'¡Contraseña actualizada correctamente',
	      				'success'
	      				)
      			}else{
      				console.log("error");
      			}
        });
      	this.reiniciarModal();
      },
      guardarDatosRol(id_rol, id_usuario){
      	axios.get('/editar-rol', {params:{id:id_usuario, rol:id_rol}}).then((response)=>{
      		if (response.data == 200) {
      			Swal.fire(
      				'Rol actualizado',
      				'¡Rol actualizado correctamente',
      				'success'
      				)
      		}else if (response.data == 400){
      			Swal.fire(
      				'Rol asignado',
      				'¡Rol asignado correctamente',
      				'success'
      			)
      		}else{
      				console.log("error");
      		}
        });
      	this.reiniciarModal();
      },
      actualizarTabla(){
      	// console.log("Se actualiza la tabla");
      	this.reiniciarValores();
      	this.cargarTablaUsuarios();
      },
      reiniciarValores(){
        this.rol_id_actual = "";
        this.usuario_actual = "";
        this.usuario_id_actual = "";
        this.usuario_correo_actual = "";
        this.password_nueva = "";
        this.password_confirm = "";
        this.usuarios_id = [];
        this.usuarios_nombre = [];
        this.usuarios_rol = [];
        this.usuarios_rol_id = [];
        this.usuarios_correo = [];
      },
  },

}
</script>
