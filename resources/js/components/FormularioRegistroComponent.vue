<template>
    <div>
		<div class="container" style="height: auto;">
			<div class="row align-items-center">
				<div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
					<form class="form">
						<div class="card card-login card-hidden mb-3">
							<div class="card-header card-header-info text-center">
								<h4 class="card-title"><strong>Agregar Usuario</strong></h4>
							</div>
							<div class="card-body ">
								<p class="card-description text-center"></p>
								<div class="bmd-form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons">face</i>
											</span>
										</div>
										<input v-model="nombre" type="text" name="nombre" class="form-control" placeholder="Nombre" value="" required>
									</div>
									
									<div id="name-error" class="error text-danger pl-3" for="nombre" style="display: block;" v-if="this.nombre_error != ''">
										<strong>{{this.nombre_error}}</strong>
									</div>

									<div style="padding: 10px;"></div>
									
								</div>
								<div class="bmd-form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons">account_circle</i>
											</span>
										</div>
										<input v-model="usuario" type="text" name="usuario" class="form-control" placeholder="Usuario" value="" required>
									</div>
							
									<div id="email-error" class="error text-danger pl-3" for="usuario" style="display: block;" v-if="this.usuario_error != ''">
										<strong>{{this.usuario_error}}</strong>
									</div>

									<div style="padding: 10px;"></div>

								</div>
								<div class="bmd-form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons">lock_outline</i>
											</span>
										</div>
										<input v-model="contrasenia" type="password" name="contrasenia" id="password" class="form-control" placeholder="Contraseña" required>
									</div>
									<div id="password-error" class="error text-danger pl-3" for="contrasenia" style="display: block;" v-if="this.password_error != ''">
										<strong>{{this.password_error}}</strong>
									</div>

									<div style="padding: 10px;"></div>

								</div>
								<div class="bmd-form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons">lock_outline</i>
											</span>
										</div>
										<input v-model="contrasenia_confirmacion" type="password" name="contrasenia_confirmacion" id="password_confirmacion" class="form-control" placeholder="Confirmar Contraseña" required>
									</div>
									
									<div id="password_confirmacion-error" class="error text-danger pl-3" for="contrasenia_confirmacion" style="display: block;" v-if="this.confirmacion_error != ''">
										<strong>{{this.confirmacion_error}}</strong>
									</div>

									<div style="padding-left: 10px;
												padding-right: 10px;
												padding-top: 10px;
												padding-bottom: 10px;">
									</div>

								</div>
								<div class="bmd-form-group">
									<div class="input-group" style="justify-content:center;">
										<div class="input-group-prepend" style="width:100%;">
											<select v-model="roles_select" id="select-roles" name="roles" class="custom-select my-1 mr-sm-2" style="width: 100%;justify-content:center;" @change="limpiarErrores()">
												<option value="0" selected> 
													Seleccione un rol 
												</option>
												<option  v-for="(value,index) in roles" :value="index+1">
													{{roles[index]}}
												</option>
											</select>
										</div>
									</div>

									<div id="rol-error" class="error text-danger pl-3" for="select_roles" style="display: block;" v-if="this.rol_error != ''">
										<strong>{{this.rol_error}}</strong>
									</div>
								</div>
							</div>

							<div class="card-footer justify-content-center">
								<button type="button" class="btn btn-success" @click = "registrar()" style="text-transform: none; font-weight: bold; letter-spacing: 2px;">Crear Cuenta</button>
							</div>
								<div style="padding: 5px 0 10px 0;"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        data(){
            return{
            	nombre:"",
            	usuario:"",
            	contrasenia:"",
            	contrasenia_confirmacion:"",
            	nombre_error:"",
            	usuario_error:"",
            	password_error:"",
            	confirmacion_error:"",
            	roles_select: "0",
            	roles:[],
            	rol_error: "",
            }
        },
        mounted() {
           this.cargarTablaRol();
        },
        methods:{
        	registrar(){

				this.nombre_error = "";
            	this.usuario_error = "";
            	this.password_error = "";
            	this.confirmacion_error = "";
            	this.rol_error = "";

        		 const formData = new FormData();
        		 formData.append("nombre", this.nombre);
        		 formData.append("usuario", this.usuario);
        		 formData.append("password", this.contrasenia);
        		 formData.append("password_confirmation", this.contrasenia_confirmacion);


        		 formData.append("rol", this.roles_select);

        		 axios.post('/register',formData)
                        .then((response)=>{
                           // console.log(response);
                           Swal.fire(
	                           	'¡Usuario creado!',
	                           	'Presiona OK para continuar',
	                           	'success'
                           	).then(function(){
                                  window.location.href = '/registro';
                              });
                        })

                        .catch(error=>{
                            // console.log(error.response.data.errors);
                            // console.log(error.response.data.errors.nombre);
                            // console.log(error.response.data.errors);
                            if (error.response.data.errors.nombre){
                            	this.nombre_error = error.response.data.errors.nombre[0];
                            }

                            if (error.response.data.errors.usuario){
                            	this.usuario_error = error.response.data.errors.usuario[0];
                        	}
                        	if (error.response.data.errors.password){
	                            if ( error.response.data.errors.password.length > 1  ){
	                            	this.password_error = error.response.data.errors.password[0];
	                            	this.confirmacion_error = error.response.data.errors.password[1];
	                            }
	                            else{
	                            	this.password_error = error.response.data.errors.password[0];
	                            }
                        	}
                        	if (error.response.data.errors.rol){
                            	this.rol_error = error.response.data.errors.rol[0];
                            }

                            // console.log("error en: " + this.nombre_error);
                        });
        	},
        	cargarTablaRol(){
        		this.cambios_roles = 0;
                axios.get('/cargar-roles').then((response)=>{
                    response.data.forEach(element =>{
                        this.roles.push(element.name);
                    });           
                 });
            },
            limpiarErrores(){
            	this.rol_error = "";
            },
        },

    }
</script>