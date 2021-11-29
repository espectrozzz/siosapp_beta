<template>
    <div>

        <!-- Modal -->
        <div class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Permisos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div>
                    <div class="custom-control custom-checkbox" v-for="(value,index) in agregar_permisos">
                      <input type="checkbox" class="custom-control-input" :id="agregar_permisos_id[index]" v-model="permisos_checados[index]" :value="agregar_permisos_id[index]">
                        <label class="custom-control-label" :for="agregar_permisos_id[index]">
                            {{agregar_permisos[index]}}
                        </label>
                    </div>                 
                </div>
              </div>
              <div class="modal-footer">
                <button style="text-transform:none;" type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
                <button style="text-transform:none;" type="button" class="btn btn-success" @click="agregarPermisos()">
                    Agregar
                </button>
              </div>
            </div>
          </div>
        </div>

        <div>
            <select v-model="roles_select" id="select-roles" name="roles" class="custom-select my-1 mr-sm-2" @change="cargarTablaPermisos()">
                <option value="0" selected> Seleccione un rol </option>
                <option  v-for="(value,index) in roles" :value="index+1">
                    {{roles[index]}}
                </option>
            </select>
            <button v-if="roles_select != 0" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalPermisos" @click="cargarPermisosDisponibles(roles_select)">
                <i class="material-icons">add</i>
            </button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Permisos</th>
                            <th>Revocar Permiso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(value,index) in permisos">
                            <td><strong>{{permisos[index]}}</strong></td>
                            <td>
                                <button type="button" class="btn btn-danger" @click="revocarPermiso(permisos_id[index], permisos[index])">
                                    <i class="material-icons">delete_outline</i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                permisos:[],
                permisos_id:[],
                agregar_permisos:[],
                agregar_permisos_id:[],
                permisos_checados:[],
                permisos_filtrados:[],
                check:[],
                request:"",
            }
        },
        mounted() {
            this.cargarTablaRol();
        },
        methods:{
            cargarTablaRol(){
                axios.get('/cargar-roles').then((response)=>{
                    response.data.forEach(element =>{
                        this.roles.push(element.name);
                    });           
                 });
            },
            cargarTablaPermisos(){
                this.permisos = [];
                this.permisos_id = [];
                axios.get('/cargar-tabla-permisos', {params:{rol:this.roles_select}}).then((response)=>{
                    response.data.forEach(element =>{
                        this.permisos.push(element.name);
                        this.permisos_id.push(element.id);
                    });  
                 });
            },
            revocarPermiso(permiso){
                this.permisos_checados = [];
                this.permisos_filtrados = [];
                // console.log(this.roles_select, permiso);
                axios.get('/eliminar-permiso', {params:{rol:this.roles_select, permiso:permiso}}).then((response)=>{
                    // response.data.forEach(element =>{
                        console.log(response.data);
                        Swal.fire(
                                'Permiso(s) eliminado(s)',
                                '¡Permiso(s) eliminado(s) correctamente',
                                'success'
                              )
                    // });  
                 });
                this.cargarTablaPermisos();
            },
            cargarPermisosDisponibles(rol){
                this.agregar_permisos = [];
                this.agregar_permisos_id = [];
                axios.get('/cargar-checkbox-permiso', {params:{rol:rol, permisos:this.permisos_id}}).then((response)=>{
                    response.data.forEach(element =>{
                        this.agregar_permisos.push(element.name);
                        this.agregar_permisos_id.push(element.id);
                    });  
                 });
                this.cargarTablaPermisos();
            },
            agregarPermisos(){
                var x = 0;
                for (var i = 0; i < this.agregar_permisos_id.length; i++) {
                    // console.log("");
                    if (this.permisos_checados[i]){
                        this.permisos_filtrados[x] = this.agregar_permisos_id[i];
                        x++;
                    }
                }

                axios.get('/agregar-permisos', {params:{rol:this.roles_select, permisos:this.permisos_filtrados}}).then((response)=>{

                        if (response.data = 200) {
                             Swal.fire(
                                'Permiso(s) agregado(s)',
                                '¡Permiso(s) agregado(s) correctamente',
                                'success'
                              )

                             // this.$root('bv::hide::modal', this.modalPermisos);
                        }
                 });
                $('#modalPermisos').modal('hide');
                this.cargarTablaPermisos();
            },
        }

    }
</script>