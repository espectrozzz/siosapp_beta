<template>
<div>
        <div class="border">
            <div class="mx-2 my-2">
            <div class="row">
            <div class="form-floating col-lg-3 col-md-5">
                <label for="searchFolio">Folio</label>
                <input v-model="searchFolio" type="search" class="form-control" id="searchFolio" @keyup.enter="buscar" name="searchFolio" placeholder="Ingrese número"/>
            </div>
            <div class="form-floating col-lg-3 col-md-5">
                <label for="searchDistrito" >Distrito</label>                
                <select v-model="$store.state.selected_distrito"  id="searchDistrito" name="searchDistrito" class="form-control" @change="$store.commit('loadCombo'); selectDistrito()">
                    <option value="">Seleccione Distrito</option>
                    <option v-for="(value,index) in distritoData" :key="index" :value="distritoData[index].id">
                        {{distritoData[index].descripcion}}
                    </option>
                </select>
            </div>
            <div class="form-floating col-lg-3 col-md-5">
                <label for="searchCluster" >Cluster</label>
                <select v-model="cluster_select" class="form-control" id="searchCluster" name="searchCluster">
                    <option value="">Seleccione Cluster</option>
                    <option v-for="(value,index) in $store.state.comboCluster.clusterID" v-bind:key="index" v-bind:value="value">
                {{$store.state.comboCluster.descripcionCluster[index]}}
            </option>
                </select>
            </div>
            </div>
            <div class="row my-2">
            <div class="form-floating col-lg-3 col-md-5">
                <label for="searchFechaIni" >Fecha Inicial</label>
                 <input v-model="fechaInicial" id ="searchFechaIni" name="SearchFechaIni" type="date" class="form-control">
            </div> 
               <div class="form-floating col-lg-3 col-md-5">
                <label for="searchFechaFin" >Fecha Final</label>
                 <input v-model="fechaFinal" id ="searchFechaFin" name="SearchFechaFin" type="date" class="form-control">
            </div> 
            <div class="form-floating col-lg-3 col-md-5">
                <label for="searchEstatus" >Estatus</label>
                <select v-model="estatus_selected" class="form-control" id="searchEstatus" name="searchEstatus">
                    <option value="">Seleccione Estatus</option>
                    <option v-for="(value,index) in estatusData" :key="index" :value="estatusData[index].id">
                        {{estatusData[index].descripcion}}
                    </option>
                </select>
            </div>
            <div class="form-floating col-lg-3 col-md-5">
                <label for="searchTfolio" >Tipo de Folio</label>
                <select v-model="tFolio_select" class="form-control" id="searchTfolio" name="searchTfolio">
                    <option value="">Seleccione Tipo de Folio</option>
                    <option value="1">Correctivo</option>
                    <option value="2">Preventivo</option>
                </select>
            </div>
            </div>
            <div class="form-align my-2" style="text-align:left;">
                <button type="button" class="btn btn-secondary" @click="buscar">Buscar</button>
                <button type="button" class="btn btn-secondary" @click="reiniciarFiltro">Reiniciar Filtro</button>
            </div>
            </div>
    </div>

<div class="row">
    <div class="col-md-12">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Folio</th>
                <th>Tipo de Folio</th>
                <th>Distrito</th>
                <th>Cluster</th>
                <th>Fecha Creación</th>
                <th>ETA</th>
                <th>SLA</th>
                <th>Estatus</th>
                <th>Herramientas</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="(value,index) in laravelData.data" :key="value.id">
            <td><strong>{{laravelData.data[index].folio}}</strong></td>
            <td>{{ laravelData.data[index].tfolio_descripcion }}</td>
            <td>{{ laravelData.data[index].distrito_descripcion }}</td>
            <td>{{ laravelData.data[index].cluster_descripcion }}</td>
            <td>{{ laravelData.data[index].fecha_crea }}</td>
            <td><div :class="parseInt(laravelData.data[index].eta)>parseInt('30')?'text-danger':''"  v-if="laravelData.data[index].eta">{{laravelData.data[index].eta}}</div></td>
            <td><div :class="laravelData.data[index].sla>laravelData.data[index].timeMax?'text-danger':''">{{ laravelData.data[index].sla }}</div></td>

              <td v-if="admin==1" >
                <!-- {{index}} -->
                <select v-model="estatus_select[index]" class="custom-select my-1 mr-sm-2" id="searchEstatus2" name="searchEstatus2" @change="actualizarEstatus(index)">
                    <option v-for="(value,index) in estatusDataT" :key="index" :value="estatusDataT[index].id">
                        {{estatusDataT[index].descripcion}}
                    </option>
                </select>
              </td>

              <td v-if="admin==0">
                {{laravelData.data[index].estatus_descripcion}}         
              </td>

            <td>
              <div style="display: flex; flex-direction:row;">
                <button :id="index" class="btn btn-primary btn-sm" v-if="laravelData.data[index].estatus_descripcion!='Finalizado'" @click="actualizarFolio(laravelData.data[index].folio_id)">
                  <i class="material-icons">
                      refresh
                  </i>
                </button>
                <button class="btn btn-success btn-sm" v-if="(laravelData.data[index].estatus_descripcion=='En espera') && play[index] == false" @click="pausarFolio(index, laravelData.data[index].eta, laravelData.data[index].id)" style="border-radius: 30px;">
                  <i class="material-icons">
                      play_arrow
                  </i>
                </button>

                <button class="btn btn-danger btn-sm" v-if="(laravelData.data[index].estatus_descripcion=='Pendiente' || laravelData.data[index].estatus_descripcion=='En proceso') && play[index] == true" @click="pausarFolio(index, laravelData.data[index].eta, laravelData.data[index].id)" style="border-radius: 30px;">
                  <i class="material-icons">
                      pause
                  </i>
                </button>

                <div style="display: flex; justify-content: center; text-align: center; width: 100%;">
                  <button class="btn btn-secondary materiales" v-if="laravelData.data[index].estatus_descripcion=='Finalizado' && admin==1" @click="enviarScript(laravelData.data[index].folio_id)" :disabled="control_botones">
                    <i class="material-icons">
                      send_to_mobile
                    </i>
                  </button>
                  <button class="btn btn-secondary materiales" v-if="laravelData.data[index].estatus_descripcion=='Finalizado'" @click="copiarClipboard(laravelData.data[index].folio_id)" :disabled="control_botones">
                    <i class="material-icons">content_copy</i>
                  </button>
                </div>

              </div>
            </td>
        </tr>
            <td colspan="5" v-if="vacio!=true && laravelData.total > 10">
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-show="laravelData['prev_page_url']">
                            <a href="#" class="page-link" @click.prevent="getPreviousPage">
                                <span>
                                  <span aria-hidden="true">«</span>
                                </span>
                            </a>
                        </li>
                       <p class="mx-2 my-2"> {{laravelData['current_page'] + ' de ' + laravelData['last_page']}}</p>
                        <li class="page-item" v-show="laravelData['next_page_url']">
                            <a href="#" class="page-link" @click.prevent="getNextPage">
                                <span>
                                  <span aria-hidden="true">»</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </td>
            <p v-else-if="vacio!=false" > No existen datos a mostrar.</p>
        <tr>
        </tr>
        </tbody>
    </table>
    </div>
    </div>
</div>
</template>

<script>
export default {
 
    data() {
        return {
            laravelData:{},
            data:[],
            distritoData:[],
            clusterData:[],
            estatusData:[],
            estatusDataT:[],
            distrito_select:'',
            estatus_select:[],
            estatus_selected:'',
            cluster_select:'',
            tFolio_select:'',
            searchFolio:'',
            fechaInicial:'',
            fechaFinal:'',
            vacio:false,
            control_botones:false,
            play: [true],
            habilitar: true,
        }
    },
    props:['admin'],
    mounted() {
        // Fetch initial results
        this.getComboSearch();
        this.getContactoList();
    },
 
    methods: {
        getContactoList(){
                axios.get('/consultaFolios').then((response)=>{
                    this.$set(this.$data, 'laravelData', response.data);
                      if(response.data.total == 0){
                        this.vacio = true;
                    }
                    else{
                        this.vacio = false;
                    }
                    this.rellenarSelectEstatus(response.data.data);
                });
            },
            getPage(page){
                axios.get('/consultaFolios?page='+page).then((response)=>{
                    this.$set(this.$data, 'laravelData', response.data);
                    this.rellenarSelectEstatus(response.data.data);
                });
            },
            getPreviousPage(){
                axios.get(this.laravelData['prev_page_url']).then((response)=>{
                    this.$set(this.$data, 'laravelData', response.data);
                    this.rellenarSelectEstatus(response.data.data);
                });
            },
            getNextPage(){
                axios.get(this.laravelData['next_page_url']).then((response)=>{
                    this.$set(this.$data, 'laravelData', response.data);
                    this.rellenarSelectEstatus(response.data.data);
                });
            },
            detalleInfo(estatus){
                if(estatus==5){
                    alert("El folio ya ha sido finalizado");
                }
            },
             buscar(){ 
                    axios.get('/consultaFolios',{params:{searchFolio:this.searchFolio,
                                                         searchDistrito:this.$store.state.selected_distrito,
                                                         searchCluster:this.$store.state.selected_cluster,
                                                         searchEstatus:this.estatus_selected,
                                                         searchFechaIni:this.fechaInicial,
                                                         searchFechaFin:this.fechaFinal,
                                                         searchTipoFolio:this.tFolio_select}}).then((response)=>{
                         this.$set(this.$data, 'laravelData', response.data);
                         this.rellenarSelectEstatus(response.data.data);
                    });
             },
             getComboSearch(){
                 axios.get('/search-combo').then((response)=>{
                     this.distritoData  =   response.data[0];
                     this.clusterData   =   response.data[1];
                     this.estatusData   =   response.data[2];
                     this.estatusDataT  =   response.data[2];
                 });
             },
             actualizarFolio(folio){
                 window.location.href='/consulta/'+folio;
             },
             reiniciarFiltro(){
                 this.searchFolio                       =   '';
                 this.$store.state.selected_distrito    =   '';
                 this.$store.state.selected_cluster     =   '';
                //  this.estatus_select                    =   '';
                 this.fechaInicial                      =   '';
                 this.fechaFinal                        =   '';
                 this.tFolio_select                     =   '';
                 axios.get('/consultaFolios').then((response)=>{
                         this.$set(this.$data, 'laravelData', response.data);
                    });
             },
             enviarScript(id){
                this.control_botones = true;
                 axios.get('/enviar-script/'+id).then((response)=>{
                     Swal.fire(
                                'Mensaje Enviado',
                                '¡El mensaje ha sido enviado correctamente',
                                'success'
                              )
                              console.log(response.data);
                           // try{
                           //    navigator.clipboard.writeText(response.data);
                           // }catch(e){
                           //    throw e;
                           // }
                 });
                this.control_botones = false;
             }, 
             actualizarEstatus(index){
                 axios.post('/actualizarEstatus', {folio_id:this.laravelData.data[index].folio_id, estatus_id: event.target.value}).then((response)=>{
                   console.log(response.data);
                 });
               // console.log(this.laravelData.data[index].folio_id);
                // console.log(event.target.value);
            },
            copiarClipboard(id){
              this.control_botones = true;
                axios.get('/copiar-script/'+id).then((response)=>{
                              // console.log(response.data);
                            try{
                              navigator.clipboard.writeText(response.data);
                            }catch(e){
                              throw e;
                            }
                     Swal.fire(
                                'Mensaje Copiado',
                                '¡El mensaje ha sido copiado exitosamente!',
                                'success'
                              )
                 });
                this.control_botones = false;
            },
            selectDistrito(){
                // this.distrito_select = $store.state.selected_distrito;
                console.log(this.distrito_select);
            },
            pausarFolio(id, eta, folio_id){
              let id_string =  id.toString();
              // console.log(id_string);
              // console.log(folio_id);
              console.log("Entraste a pausarFolio");
              if (this.play[id]) {
                this.play[id] = false;
                axios.post('/actualizarEstatus', {folio_id:this.laravelData.data[id].folio_id, estatus_id: 7}).then((response)=>{
                   console.log(response.data);
                 });
                this.getContactoList();
              }else{
                this.play[id] = true;
                if (eta){
                  axios.post('/actualizarEstatus', {folio_id:this.laravelData.data[id].folio_id, estatus_id: 2}).then((response)=>{
                     console.log(response.data);
                   });
                  this.getContactoList();
                  // console.log(eta);
                }else{
                  axios.post('/actualizarEstatus', {folio_id:this.laravelData.data[id].folio_id, estatus_id: 1}).then((response)=>{
                     console.log(response.data);
                   });
                  this.getContactoList();
                }
              }
            },
            rellenarSelectEstatus(data){
               for (var i = 0; i <= data.length - 1; i++) {
                      this.estatus_select[i] = data[i].estatus_id;

                      if (data[i].estatus_descripcion == 'En espera'){
                        this.play[i] = false;
                      }else{
                        this.play[i] = true;
                      }
                  }
            },
    }
 
}
</script>

<style >
@media screen and (max-width: 768px) {
  table {
    display: block;
    overflow-x: auto;
  }
}
</style>