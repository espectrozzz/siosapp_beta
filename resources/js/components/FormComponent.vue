<template>

    <div>
         <div class="alert alert-danger" v-show="errorsEstatus" style="width:100%;" id="error" name="error">
                  <div v-for="(v, k) in errors" :key="k">
                    <p v-for="error in v" :key="error" class="text-sm">
                    {{ error }}
                    </p>
        </div>
        </div>
        <div class="form-group">
            <div class="row">
            <div class="form-floating col col-md-4">
                <input v-model="folio" type="text" class="form-control" id="folio" name="folio" placeholder="Folio">
                <label for="folio">Folio</label>
            </div>
            <div class="form-floating col col-md-4 col-lg-4">
                <select v-model="idTipoFolio" name="tFolio" id="tFolio" :value="'1'" class="form-select" @change="isOtFunction" :disabled="role==1">
                    <option value="">Seleccione el tipo de folio</option>
                    <option v-for="(value,index) in tFolio" v-bind:key="index" v-bind:value="tFolio[index].id">
                        {{tFolio[index].descripcion}}
                    </option>
                </select>
                 <label for="tFolio">Tipo/Folio</label>
            </div>
            <div class="form-floating col-4" style="display: none;" id="div_otro">
                <input type="text" name="otro" id="otro" class="form-control">
                <label for="otro">Otro Folio</label>
               </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="form-floating col-md-4 col-sm-2">
                <select v-model="tipoTurno" name="turno" id="turno" class="form-select" :disabled="role==1"> 
                  <option value="">Seleccione un turno</option>
                  <option v-for="(value,index) in turno" v-bind:key="index" v-bind:value="turno[index].id">
                      {{turno[index].descripcion}}
                  </option>
                </select>
                <label for="turno">Turno</label>
            </div>
                <!--Distrito/cluster component Combo-->
            <distrito-component :datos_distrito="(datos.length <= 0) ? '': datos[0][0].distrito_id" :datos_cluster="(datos.length <= 0) ? '': datos[0][0].cluster_id" :datos_supervisor="(datos.length <= 0) ? '': datos[0][0].supervisor_id" :role="this.role"></distrito-component>
            <cluster-component :role="this.role"></cluster-component> 
                
        </div>
    </div>
    <transition name="fade">
    <div class="form-group" >
        <div class="row">
            <div class="form-floating col-6 col-md-4 col-lg-3">
                <input v-model='olt' id="olt" type="text" class="form-control positivo" name="olt" :disabled="role==1">
               <label for="olt">OLT</label>
            </div>
        </div>
    </div> 
     </transition>
    <div class="form-group"> 
         
        <div class="row">
            <div class="form-floating col-md-4">
                <select v-model="falla_select" name="falla" id="falla" class="form-select" :disabled="role==1">
                    <option value="">Seleccione una falla</option>
                    <option v-for="(value,index) in cFalla" v-bind:key="index" v-bind:value="cFalla[index].id">
                        {{cFalla[index].descripcion}}
                    </option>
                </select>
                <label for="falla">Falla</label>
            </div>
           <div class="form-floating col-md-4">
            <select v-model="causa_select" name="cAfectacion" id="cAfectacion" required class="form-select" :disabled="role==1">
                <option value="">Seleccione una causa</option>
                <option v-for="(value,index) in cCausa" v-bind:key="index" v-bind:value="cCausa[index].id">
                    {{cCausa[index].descripcion}}
                </option>
            </select>
            <label for="cAfectacion">Causa/Afectacion</label>
           </div>
           <div class="form-floating col-4 col-md-1" v-if="this.form!=2">
            <input v-model="numCliente" id="nClientes" type="number" pattern="^[0-9]+" min=0 class="form-control positivo" name="nClientes" :disabled="role==1" >
            <label for="nClientes">Clientes Afectados</label>
           </div>
           <transition name="slide-fade">
           <div v-if="isOt" class="form-floating col-6 col-md-3">
               <input v-model="ot" id="ot" type="text" class="form-control positivo" name="ot" :disabled="role==1">
               <label for="ot">OT</label>
           </div>
           </transition>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="form-floating col-md-4">
                <select v-model="despacho_select" id="despachoIos" name="despachoIos" class="form-select" placeholder="Ingresar Nombre de Despacho" :disabled="role==1">
                    <option value="">Seleccione un despacho</option>
                    <option v-for="(value,index) in despacho" v-bind:key="index" v-bind:value="despacho[index].id">
                        {{despacho[index].Nombre}}
                    </option>
                </select>
                <label for="despachoIos">Despacho iOS</label>
               </div>
          <!--supervisor-->
            <supervisor-component :role="this.role"></supervisor-component>
          <!---->
            <div class="form-floating col-md-4">
                <select v-model="$store.state.tecnico_select" id="tecnicoIos" name="tecnicoIos" class="form-select" placeholder="Técnico iOS" :disabled="$store.state.controlComboTecnicos || role==1">
                    <option value="">Seleccione un técnico</option>
                    <option v-for="(value,index) in $store.state.tecnico" v-bind:key="index" v-bind:value="$store.state.tecnico[index].id">
                        {{$store.state.tecnico[index].Nombre}}
                    </option>
                </select>
                <label for="tecnicoIos">Técnico iOS</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="form-floating col-md-4">
                <input v-model="asignacionIos" @blur="calcTiempo" id ="fechaIos" name="fechaIos" type="datetime-local" class="form-control">
                <label for="fechaIos">Asignacion iOS</label>
            </div>
            <div class="form-floating col-md-4">
                <input v-model="llegadaIos" @blur="calcTiempo" id ="llegadaFolio" name="llegadaFolio" type="datetime-local" class="form-control" v-bind:disabled="asignacionIos ==''? true:false || role==1"> 
                <label for="llegadaFolio">Fecha/Hora de llegada al folio</label>
            </div>
            <div class="form-floating col-md-4">
                <input v-model="cierreIos" @blur="calcTiempo" id ="activacionFolio" name="activacionFolio" type="datetime-local" class="form-control" v-bind:disabled="llegadaIos==''? true:false || role==1">
                <label for="activacionFolio">Hora de Cierre</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="form-floating  col-md-4 col-sm-6" >
               <select v-model="pausa" name="fPausado" id="fPausado" @change="calcTiempo" class="form-select" v-bind:disabled="asignacionIos ==''? true:false || role==1">
                    <option value="">Seleccione una justificación</option>
                    <option v-for="(value,index) in cPausa" v-bind:key="index" v-bind:value="cPausa[index].id" >
                        {{cPausa[index].descripcion}}
                    </option>
               </select>
                <label for="fPausado">Justificación Pausa</label>
            </div>
            <div class="form-floating col-6" id="pausado">
             <input v-model="cantPausa" v-show="pausa!=''" pattern="^[0-9]+" min=1 id ="tiempoMuerto" name="tiempoMuerto" type="number" class="form-control" placeholder="hora" @blur="calcTiempo">
                <label for="tiempoMuerto" v-show="pausa!=''" >Tiempo Muerto</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="form-floating col-5 col-md-4">
                <input v-model="latitud" type="text" name="latitud" id="latitud" placeholder="Latitud" class="form-control" :disabled="role==1">
                <label for="latitud">Latitud</label>
            </div>
            <div class="form-floating col-5 col-md-4">
                <input v-model="longitud" type="text" name="longitud" id="longitud" placeholder="Longitud" class="form-control" :disabled="role==1">
                <label for="longitud">Longitud</label>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-2">
                    <button type="button" class="btn btn-info btn-lg" id="sitio" @click="ubicacion" v-if="role==1">Llegué a sitio</button>
                </div>
                <div class="col-lg-2">
                     <button type="button" class="btn btn-info btn-lg" id="termine" @click="termine" v-if="role==1 && control==1">Terminé</button>
                </div>
                <div class="col-lg-5">
                     <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Herramientas</button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="form==2">
        <imagen-component :datos="datos[1]"></imagen-component>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="form-floating col">
                <input v-model="eta" type="text" id="hora_eta" name="hora_eta" value='' class="form-control" :class="{'bg-danger':alertaEta,'text-white':alertaEta,'bg-light':!alertaEta}" placeholder="Hora" readonly>
                <label for="hora_eta"  :class="{'text-white':alertaEta,'text-black':!alertaEta}">ETA</label>
            </div>
            <div class="form-floating col">
               <input v-model="sla" type="text" name="hora_sla" id="hora_sla" class="form-control" :class="{'bg-danger':alertaSla,'text-white':alertaSla,'bg-light':!alertaSla}" placeholder="Hora" readonly>
                <label for="hora_sla"  :class="{'text-white':alertaSla,'text-black':!alertaSla}">SLA</label> 
               
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <materialIos-component :datos='datos[2]'></materialIos-component>
            </div>
            <div class="col-md-6">
                 <materialTtp-component :datos='datos[2]'></materialTtp-component>
            </div>
        </div>
        <div class="row">
        <div class="col-md-6" style="text-align: center;"> 
            <button type="button" class="btn btn-secondary" @click="$store.commit('agregarMaterialIos')" id="add_materialIos">Agregar Material iOS</button>
        </div>
       
        <div class="col-md-6" style="text-align: center;"> 
            <button type="button" class="btn btn-secondary" @click="$store.commit('agregarMaterialTtp')" id="add_materialTtp">Agregar Material TTP</button>
        </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="border border-dark">
                    <h4 class="text-center">Conceptos</h4>
                    <div v-for="(value,index) in tab_conceptos" v-bind:key="value" class="px-3" >
                        <div class="form-group">
                            <div class="row">
                                <div class="form-floating col-5 col-md-6 col-lg-5">
                                    <select v-model="concepto_select[index]" class="form-select" :name="disabledControl[index]==true?'detalle':'concepto'" :id="'concepto_id['+index+']'" :disabled="disabledControl[index]" @change="conceptoChange(index)">
                                        <option  value="" selected>Seleccione Conceptos</option>
                                        <option v-for="(value,index) in conceptos" :key="index" :value="conceptos[index].id" >
                                            {{conceptos[index].concepto}}
                                        </option>
                                    </select>
                                    <label for="concepto">Concepto</label>
                                </div>
                                <div class="form-floating col-3 col-md-3 col-lg-3">
                                    <input v-model="concepto_cant[index]" type="number" class="form-control positivo" :name="disabledControl[index]==true?'detalle':'concepto_cant'" :disabled="disabledControl[index]" @change="cantConceptoChange(index)">
                                    <label for="concepto_cant">Cantidad</label>
                                </div>
                             <div class="form-floating col-2 col-md-2 col-lg-2">
                                <button type="button" @click="borraConcepto(index)" class="btn btn-secondary" v-if="!disabledControl[index]">Borrar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-6" v-if="controlCab24==true">
                 <div class="border border-dark">
                      <h4 class="text-center">Coordenadas CAB-24</h4>
                      <div v-for="(value,index) in tab_cab24" v-bind:key="index" class="px-3" >
                       <div class="form-group">
                           <div class="row">
                           <div class="col-lg-8">
                                <input v-model="cooDaño[index]" type="text" class="form-control" :name="disabledControlCab24[index]==true?'detalle':'cab24'" :disabled="disabledControlCab24[index]" >
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-primary btn-sm" @click="Reubicar(index)" v-if="!disabledControlCab24[index]">Reubicar</button>
                            </div>
                            </div>
                       </div>
                        </div>
                 </div>
             </div>
        </div>
        <div class="row">
            <div class="col-md-6" style="text-align: center;">
                <button type="button" class="btn btn-secondary" @click="agregarConcepto" id="add_concepto">Agregar Conceptos</button>
            </div>
        </div>
    </div>
    <div class="form-group">
        <seguimiento-component :datos="datos[3]"></seguimiento-component>
        <div class="col" style="text-align: center;">
        <button type="button" class="btn btn-secondary" @click="$store.commit('agregarSeguimiento')" id="add_tracing">Agregar Seguimiento</button>
        </div>
    </div>
    <div style="text-align: right">
    <button type="button" class="btn btn-primary btn-lg-4" id="guardar" @click="enviarFormulario()" v-if="detalle!=1">Iniciar</button>
    <button type="button" class="btn btn-success btn-lg-4" id="finalizar" @click="finalizarFormulario()" v-if="(form==2||detalle==1) && role!=1">Finalizar</button>
    <button type="button" class="btn btn-warning btn-lg-4" id="actualizar" @click="actualizarFormulario()" v-if="detalle==1">Actualizar</button>
    </div>


    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title mx-2">Herramientas Técnico</h4>
      </div>
      <div class="modal-body">
       <div class="form-group row">
           <div class=" form-floating col-lg-6"> 
                <input v-model="poIni" type="number" id="potenciaIni" name="potenciaIni" class="form-control" placeholder="Potencia Inicial">
                <label for="potenciaIni">Potencia Inicial</label>
        </div>
        <div class="form-floating col-lg-6">
            <input v-model="poFin" type="number" id="potenciaFin" name="potenciaFin" class="form-control" placeholder="Potencia Final">
            <label for="potenciaFin">Potencia Final</label>
        </div>
        </div>
        <div class="form-group row">
            <div class="form-floating col-4 col-lg-4">
                <input v-model="horaMedicion" type="time" class="form-control" id="hraMedicion" name="hraMedicion" placeholder="Hora Primer Medición"/>
                <label for="hraMedicion">Hora Primer Medición</label>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
             isOt: false,
             folio:'',
             idTipoFolio:'',   
             tFolio:[],
             turno:[],
             tipoTurno:'',
             cFalla:[],
             falla_select:'',
             cCausa:[],
             causa_select:'',
             numCliente:'0',
             despacho:[],
             despacho_select:'',
             //tecnico_select:'',
             tecnico:[],
             cPausa:[],
             control:'',
             asignacionIos:'',
             llegadaIos:'',
             cierreIos:'',
             olt:'',
             ot:'',
             pausa:'',
             cantPausa:'',
             eta:'',
             sla:'',
             latitud:'',
             longitud:'',
             alertaEta:false,
             alertaSla:false,
             _ruta:'',
             tiempo:[],
             controlCab24:false,
             resta:0,
             errors:[],
             errorsEstatus:false,
             seguimientos:[],
             concepto_select:[],
             concepto_name:[],
             concepto_cant:[],
             conceptos:[],
             horaMedicion:'',
             poIni:'',
             poFin:'',
             disabledControl:[],
             disabledControlCab24:[],
             tab_conceptos:0,
             tab_cab24:0,
             cooDaño:[],
            }
        },
        props:['form','datos','detalle','role','user_despacho'],
        mounted() {
                this.cargaCombos();
                this.cargaDetalle();
                this.controlVar();
                if(this.user_despacho != null && this.user_despacho != ''){ 
                this.despacho_select = this.user_despacho[0].id;
                }
        },
        methods:{
             cargaCombos(){
                 this._ruta=this.form == 2 ? '/loadcomboPreventivo':'/loadcomboCorrectivo'
               axios.get(this._ruta).then((response) => {
                this.tFolio                        = response.data[4];
                this.turno                         = response.data[0];
                this.cFalla                        = response.data[3];
                this.cCausa                        = response.data[5];
                this.despacho                      = response.data[6];
                //this.tecnico                       = response.data[7]; Se elimina ya que se llama de manera dinámica en app.js
                this.cPausa                        = response.data[1];
                this.$store.state.comboMaterialIOS = response.data[8];
                this.$store.state.comboMaterialTTP = response.data[9];
               /* response.data[10].forEach(element => {
                    this.conceptos.push(element.concepto);
                });*/
                this.conceptos                     = response.data[10];
            }); 
            },
             calcTiempo()
        {

            if(this.asignacionIos != '')
            {
                
                if(this.form == 2){
                    this.llegadaIos = this.asignacionIos;
                    this.cierreIos = this.asignacionIos;
                }

                if(this.llegadaIos != '')
                {
                    axios.get('/tiempo',{params:{fechaIos:this.asignacionIos,
                        llegadaFolio:this.llegadaIos,
                        cierreFolio:this.cierreIos,
                        idTipoFolio:this.idTipoFolio,
                        }}).
                        then((response) =>
                        {
                          //  console.log(response);
                           this.calcEtaSla(response);
                            
                           //console.log(response.data.timeMax);
                        });
                }
                else
                {
                    this.cierreIos='';
                    this.eta='';
                    this.sla='';
                    this.pausa='';
                    this.cantPausa='';
                    this.alertaEta=false;
                    this.alertaSla=false;
                }
            }
            else
            {
                this.llegadaIos='';
                this.cierreIos='';
                this.eta='';
                this.sla='';
                this.alertaEta=false;
                this.alertaSla=false;
            }
            if(this.cierreIos == ''){
                this.cierreIos='';
                this.sla='';
                this.alertaSla=false;
            }
        },
         calcEtaSla(response) {

            if(response.data.negativoEta === 1)
            {
                alert("Error: Por favor verifica las fechas ingresadas.");
                this.eta='';
                this.alertaEta=false;
                this.llegadaIos='';
                return ;
            }

            if(response.data.horasEta > 0){
                
                this.eta= response.data.minutosEta + (response.data.horasEta * 60)
            }
            else{
                this.eta =  response.data.minutosEta;
                }
            
            if (response.data.horasEta >= 1 || response.data.minutosEta > 30) {
                this.alertaEta = true;
            }
        
            else {
                this.alertaEta = false;
            }
            //SLA verificación
            if (this.cierreIos != '')
            {
            if(response.data.negativoSla === 1)
            {
                alert("Error: Por favor verifica las fechas ingresadas.");
                this.sla='';
                this.alertaSla=false;
                this.cierreIos='';
                return ;
            }

            if (response.data.minutosSla <= 9) {
                this.sla = response.data.horasSla + ':0' + response.data.minutosSla;
            }
        
            else {
                this.sla = response.data.horasSla + ':' + response.data.minutosSla;
            }
            if (response.data.horasSla > parseInt(response.data.timeMax)) {
                this.alertaSla = true;
            }
        
            else {
                this.alertaSla = false;
            }
            if(this.pausa != '' && this.cantPausa != ''){
               if(this.cantPausa == 0 || this.cantPausa < 0)
               {
                   alert("Error: Por favor verifica el tiempo pausado.");
                   this.cantPausa ='';
               } 
               else{
                this.tiempoPausa();
                }
            }
           // this.tiempoPausa();
        }
        },
        tiempoPausa()
        {
            let restaMinutos=0;
           if(this.pausa != '') {
            if(this.sla != '')
            {
                this.tiempo = this.sla.split(':');
                    
                    if(this.cantPausa <= 60) 
                    {
                        this.resta = this.tiempo[1] - this.cantPausa;
                        if(this.resta < 0)
                        {
                            this.tiempo[0]--;
                            this.tiempo[1] = 60 + this.resta;
                        }
                        else
                        {
                            this.tiempo[1] -= this.resta; 
                        }
                }
                else
                {
                    this.tiempo[0] = this.tiempo[0] - Math.trunc(this.cantPausa / 60);

                    this.tiempo[1] = this.tiempo[1] - Math.trunc(((this.cantPausa / 60) - Math.trunc(this.cantPausa / 60)) * 60);


                    if(this.tiempo[1] < 0){
                        this.tiempo[0]--;
                        this.tiempo[1] = 60 + this.tiempo[1];
                    }

                }
                if(this.tiempo[1] <= 9)
                {
                    this.sla = this.tiempo[0] + ':0' + this.tiempo[1];
                }
                else{
                     this.sla = this.tiempo[0] + ':' + this.tiempo[1];
                }
             
              return;
            }
            }
            else{
                this.cantPausa='';
              //  this.calcTiempo();
                return;
            }
            },
            cargaDetalle(){
                var i = 0;
                if(this.datos != undefined && this.datos.length>0)
                {
                    //console.log(this.datos);
                    this.folio           = this.datos[0][0].folio;
                    this.idTipoFolio     = this.datos[0][0].tfolio_id;
                    this.tipoTurno       = this.datos[0][0].turno_id;
                    this.falla_select    = this.datos[0][0].falla_id;
                    this.causa_select    = this.datos[0][0].causa_id;
                    this.numCliente      = this.datos[0][0].clientes_afectados;
                    this.despacho_select = this.datos[0][0].despacho_id;
                    this.$store.state.selected_supervisor = this.datos[0][0].supervisor_id;
                    console.log(this.datos[0][0].tecnico_id);
                    this.$store.commit('loadComboTecnico');
                    this.$store.state.tecnico_select  = this.datos[0][0].tecnico_id;
                    this.asignacionIos   =  this.datos[0][0].asignacion_ios.split(' ')[0]+'T'+this.datos[0][0].asignacion_ios.split(' ')[1];
                    this.olt             =  this.datos[0][0].olt;
                    this.poIni           =  this.datos[0][0].potencia_inicial;
                    this.poFin           =  this.datos[0][0].potencia_final;
                    this.horaMedicion    =  this.datos[0][0].hora_medicion;
                    this.ot              =  this.datos[0][0].OT;
                    // console.log(this.datos[0][0].OT);
                this.datos[4].forEach(element => {
                    if(element.concepto_id==17){this.controlCab24=true;}
                    
                    this.concepto_select[i]=element.concepto_id;
                    this.concepto_cant[i]=element.cantidad;
                    this.disabledControl[i]=true;
                    this.agregarConcepto();
                    i++;
                });
                this.isOt = this.idTipoFolio === 1 ? false:true;
                i=0;
                this.datos[5].forEach(element =>{
                    this.agregarCab24();
                    this.disabledControlCab24[i]=true;
                    this.cooDaño.push(element.coordenadas);
                    i++
                });
                 if(this.datos[0][0].llegada != '' && this.datos[0][0].llegada != null){
                    this.llegadaIos      = this.datos[0][0].llegada.split(' ')[0]+'T'+this.datos[0][0].llegada.split(' ')[1];;
                }
                if(this.datos[0][0].activacion != '' && this.datos[0][0].activacion != null){   
                    this.cierreIos       = this.datos[0][0].activacion.split(' ')[0]+'T'+this.datos[0][0].activacion.split(' ')[1];
                }
                    this.calcTiempo();
                    if (this.datos[0][0].justificacion_id !=null){
                    this.pausa           = this.datos[0][0].justificacion_id;
                    }
                    this.cantPausa       = this.datos[0][0].tiempo_muerto;
                    this.latitud         = this.datos[0][0].latitud;
                    this.longitud        = this.datos[0][0].longitud;

                    if(this.form == 2){

                    }
                   // console.log(this.datos);
                }
            },
            enviarFormulario(){
                this.deshabilitarBotones();

                let formData = new FormData();
                formData.append('folio',this.folio);
                formData.append('tFolio',this.idTipoFolio);
                formData.append('turno',this.tipoTurno);
                formData.append('distrito_id',this.$store.state.selected_distrito);
                formData.append('cluster',this.$store.state.selected_cluster);
                formData.append('falla',this.falla_select);
                formData.append('cAfectacion',this.causa_select);
                formData.append('nClientes',this.numCliente);
                formData.append('despachoIos',this.despacho_select);
                formData.append('supervisorTTP',this.$store.state.selected_supervisor);
                formData.append('tecnicoIos',this.$store.state.tecnico_select);
                formData.append('fechaIos',this.asignacionIos);
                formData.append('llegadaFolio',this.llegadaIos);
                formData.append('activacionFolio',this.cierreIos);
                formData.append('fPausado',this.pausa);
                formData.append('tiempoMuerto',this.cantPausa);
                formData.append('hora_eta',this.eta);
                formData.append('hora_sla',this.sla);
                formData.append('latitud',this.latitud);
                formData.append('longitud',this.longitud);
                formData.append('imagen_antes', this.$store.state.imagen_antes);
                formData.append('imagen_durante', this.$store.state.imagen_durante);
                formData.append('imagen_despues', this.$store.state.imagen_despues);
                formData.append('hraMedicion',this.horaMedicion);
                formData.append('poIni',this.poIni);
                formData.append('poFin',this.poFin);
                formData.append('olt', this.olt);
                formData.append('ot',this.ot);
                document.getElementsByName('material').forEach(element => {
                     formData.append('material[]',element.value);
                });
                document.getElementsByName('cab24').forEach(element => {
                     formData.append('cab24[]',element.value);   
                });
                document.getElementsByName('material_can').forEach(element => {
                    formData.append('material_can[]',element.value);
                });
                document.getElementsByName('concepto').forEach(element => {  
                        formData.append('concepto[]',element.value); 
                    });
                     document.getElementsByName('concepto_cant').forEach(element => {  
                        formData.append('concepto_cant[]',element.value); 
                    });
                document.getElementsByName('tracing').forEach(element => {
                    formData.append('tracing[]',element.value);
                });
                this._ruta=this.form == 2 ? '/preventivo':'/correctivo'
                //console.log(formData);
              axios.post(this._ruta,formData,{headers:{'Content-Type' : 'multipart/form-data'}})
              .then((response)=>{
                 // console.log(response);
                            Swal.fire(
                            '¡Registro guardado!',
                            'Presiona OK para continuar',
                            'success'
                            ).then(function(){
                                  window.location.href = '/consulta';
                            });     
              }).catch(error => {
                  this.errors = error.response.data.errors;
                  this.errorsEstatus = true;
                  document.getElementById('guardar').disabled=false;
                   $('html, body').animate({scrollTop:0}, 'slow');
              });
            },
            actualizarFormulario(){
                this.deshabilitarBotones();
                let folioModificado;
                const formData2 = new FormData();
                let i=0;

                folioModificado = this.folio === this.datos[0][0].folio ? 0 : 1;

                console.log(folioModificado);

                formData2.append('id_folio',this.datos[0][0].id_folio);
                formData2.append('folio',this.folio);
                formData2.append('tFolio',this.idTipoFolio);
                formData2.append('turno',this.tipoTurno);
                formData2.append('distrito_id',this.$store.state.selected_distrito);
                formData2.append('cluster',this.$store.state.selected_cluster);
                formData2.append('falla',this.falla_select);
                formData2.append('cAfectacion',this.causa_select);
                formData2.append('nClientes',this.numCliente);
                formData2.append('despachoIos',this.despacho_select);
                formData2.append('supervisorTTP',this.$store.state.selected_supervisor);
                formData2.append('tecnicoIos',this.$store.state.tecnico_select);
                formData2.append('fechaIos',this.asignacionIos);
                formData2.append('llegadaFolio',this.llegadaIos);
                formData2.append('activacionFolio',this.cierreIos);
                formData2.append('fPausado',this.pausa);
                formData2.append('tiempoMuerto',this.cantPausa);
                formData2.append('hora_eta',this.eta);
                formData2.append('hora_sla',this.sla);
                formData2.append('latitud',this.latitud);
                formData2.append('longitud',this.longitud);
                formData2.append('imagen_antes', this.$store.state.imagen_antes);
                formData2.append('imagen_durante', this.$store.state.imagen_durante);
                formData2.append('imagen_despues', this.$store.state.imagen_despues);
                formData2.append('olt', this.olt);
                formData2.append('hraMedicion',this.horaMedicion);
                formData2.append('poIni',this.poIni);
                formData2.append('poFin',this.poFin);
                formData2.append('ot',this.ot);
                formData2.append('folioModificado', folioModificado);
                formData2.append('_method','put');
               
                    document.getElementsByName('material').forEach(element => {
                        formData2.append('material[]',element.value);   
                    });
                    document.getElementsByName('cab24').forEach(element => {
                        formData2.append('cab24[]',element.value);   
                    });
                    document.getElementsByName('material_can').forEach(element => {  
                        formData2.append('material_can[]',element.value); 
                    });
                    document.getElementsByName('concepto').forEach(element => {  
                        formData2.append('concepto[]',element.value); 
                    });
                     document.getElementsByName('concepto_cant').forEach(element => {  
                        formData2.append('concepto_cant[]',element.value); 
                    });
                    document.getElementsByName('tracing').forEach(element => {
                        formData2.append('tracing[]',element.value);
                    });
               Swal.fire({
                    title: '¿Estás seguro que deseas guardar?',
                    text: "Los cambios realizados no podrán ser eliminados",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, estoy seguro!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('/actualizar-folio',formData2,{headers:{'Content-Type' : 'multipart/form-data'}})
                        .then((response)=>{
                            console.log(response);
                                 Swal.fire(
                                                '¡Cambios guardados!',
                                                'Los cambios han sido realizados.',
                                                'success'
                                          )
                                if(this.role==1){
                                     setTimeout(location.reload(true),20000); 
                                }
                                else{
                                    
                                   window.location.href = '/consulta';
                                    }         
                        })
                        .catch(error=>{
                            this.errors = error.response.data.errors;
                            this.errorsEstatus = true;
                            $('html, body').animate({scrollTop:0}, 'slow');
                            this.habilitarBotones();
                        });
                      
                    }else{
                            this.habilitarBotones();
                        }
                    })
            },
            finalizarFormulario(){
                this.deshabilitarBotones();
                let folioModificado;
                let folioId;
                if (this.detalle){
                folioModificado = this.folio === this.datos[0][0].folio ? 0 : 1;
                folioId = this.datos[0][0].id_folio;
                }
                const formData2 = new FormData();
                let i=0;
                formData2.append('folio',this.folio);
                formData2.append('id_folio', folioId);
                formData2.append('tFolio',this.idTipoFolio);
                formData2.append('turno',this.tipoTurno);
                formData2.append('distrito_id',this.$store.state.selected_distrito);
                formData2.append('cluster',this.$store.state.selected_cluster);
                formData2.append('falla',this.falla_select);
                formData2.append('cAfectacion',this.causa_select);
                formData2.append('nClientes',this.numCliente);
                formData2.append('despachoIos',this.despacho_select);
                formData2.append('supervisorTTP',this.$store.state.selected_supervisor);
                formData2.append('tecnicoIos',this.$store.state.tecnico_select);
                formData2.append('fechaIos',this.asignacionIos);
                formData2.append('llegadaFolio',this.llegadaIos);
                formData2.append('activacionFolio',this.cierreIos);
                formData2.append('fPausado',this.pausa);
                formData2.append('tiempoMuerto',this.cantPausa);
                formData2.append('hora_eta',this.eta);
                formData2.append('hora_sla',this.sla);
                formData2.append('latitud',this.latitud);
                formData2.append('longitud',this.longitud);
                formData2.append('imagen_antes', this.$store.state.imagen_antes);
                formData2.append('imagen_durante', this.$store.state.imagen_durante);
                formData2.append('imagen_despues', this.$store.state.imagen_despues);
                formData2.append('olt', this.olt);
                formData2.append('hraMedicion',this.horaMedicion);
                formData2.append('poIni',this.poIni);
                formData2.append('form',this.form);
                formData2.append('detalle',this.detalle);
                formData2.append('poFin',this.poFin);
                formData2.append('ot',this.ot);
                formData2.append('folioModificado', folioModificado);
                formData2.append('_method','put');
               
                    document.getElementsByName('material').forEach(element => {

                        formData2.append('material[]',element.value);
                        
                    });
                    document.getElementsByName('cab24').forEach(element => {
                        formData2.append('cab24[]',element.value);   
                    });
                    document.getElementsByName('material_can').forEach(element => {
                         
                        formData2.append('material_can[]',element.value);
                         
                    });
                    document.getElementsByName('concepto').forEach(element => {  
                        formData2.append('concepto[]',element.value); 
                    });
                     document.getElementsByName('concepto_cant').forEach(element => {  
                        formData2.append('concepto_cant[]',element.value); 
                    });
                    document.getElementsByName('tracing').forEach(element => {
                        formData2.append('tracing[]',element.value);
                    });
               Swal.fire({
                    title: '¿Estás seguro que deseas finalizar el folio?',
                    text: "Ya no podrás hacer modificaciones",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, estoy seguro!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('/finalizar-folio',formData2,{headers:{'Content-Type' : 'multipart/form-data'}})
                        .then((response)=>{
                           // console.log(response);
                                 Swal.fire(
                                                '¡Folio finalizado!',
                                                'El folio ha sido finalizado correctamente.',
                                                'success'
                                          )
                                window.location.href = '/consulta';  
                        })

                        .catch(error=>{
                            this.errors = error.response.data.errors;
                            this.errorsEstatus = true;
                            this.habilitarBotones();
                             $('html, body').animate({scrollTop:0}, 'slow');
                        });
                      
                    }else{
                            this.habilitarBotones();
                        }
                    })
            },
            ubicacion(){
                let fecha = new Date();
    if(this.role == 1 && this.llegadaIos == ''){
	if (!"geolocation" in navigator) {
		return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
	}

	const onUbicacionConcedida = ubicacion => {
     
		const coordenadas = ubicacion.coords;
        this.latitud    =   coordenadas.latitude;
        this.longitud   =   coordenadas.longitude;
		//$enlace.href = `https://www.google.com/maps/@${coordenadas.latitude},${coordenadas.longitude},20z`;
	}
	const onErrorDeUbicacion = err => {
		console.log("Error obteniendo ubicación: ", err);
	}

	const opcionesDeSolicitud = {
		enableHighAccuracy: true, // Alta precisión
		maximumAge: 0, // No queremos caché
		timeout: 10000 // Esperar solo 5 segundos
	};
	navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);
      this.llegadaIos = fecha.getFullYear()+'-'+("0"+(fecha.getMonth()+1)).slice(-2)+'-'+("0"+fecha.getDate()).slice(-2)+ "T" + ("0"+fecha.getHours()).slice(-2)+':'+("0"+fecha.getMinutes()).slice(-2);
      this.calcTiempo();
       document.getElementById("sitio").disabled=true;
       this.control = 1;
}
else{
    document.getElementById("sitio").disabled=true;
}
                },
    termine(){
        let fecha = new Date();
        if(this.cierreIos ==''){
         this.cierreIos = fecha.getFullYear()+'-'+("0"+(fecha.getMonth()+1)).slice(-2)+'-'+("0"+fecha.getDate()).slice(-2)+ "T" + ("0"+fecha.getHours()).slice(-2)+':'+("0"+fecha.getMinutes()).slice(-2);
         this.calcTiempo();
         document.getElementById('termine').disabled=true;
         }
         else{
             document.getElementById('termine').disabled=true;
         }
    },
    controlVar(){
        if(this.llegadaIos != '' && this.role==1){
             document.getElementById("sitio").disabled=true;
             this.control = 1;
        }
    },
    enviarMensaje(){
        axios.get('/enviar-script').then((response)=>{
           // console.log(response.data);
        });
    },
    agregarConcepto(){
        this.tab_conceptos++;
    },
    borraConcepto(index){
        var i=0;
        this.concepto_select.splice(index,1);
        this.tab_conceptos--;
        this.concepto_select.forEach(element => {
            if(element == 17){
                i++;
            }
        });
        if (i<1){this.controlCab24 = false;}
        },

    conceptoChange(index){
        var i=0;
        this.concepto_select.forEach(element => {
            if(element == 17){
                i++;
            }
        });
        if (i>0){this.controlCab24 = true;this.concepto_cant[index]=0} else{this.controlCab24 = false;this.cooDaño.length=0;this.concepto_cant[index]=0}
    },
    agregarCab24(){
        this.tab_cab24++;
        this.ubicacionCab24();
    },
    ubicacionCab24(index){
            if (!"geolocation" in navigator) {
		return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
	}

	const onUbicacionConcedida = ubicacion => { 
		const coordenadas = ubicacion.coords;
        if (index!=undefined){
             console.log(index,coordenadas.latitude +","+coordenadas.longitude);
            this.cooDaño[index] = coordenadas.latitude +","+coordenadas.longitude;
            this.$forceUpdate();
        }else{
        this.cooDaño.push(coordenadas.latitude +","+coordenadas.longitude);
        }
	//	$enlace.href = `https://www.google.com/maps/@${coordenadas.latitude},${coordenadas.longitude},20z`;
	}
	const onErrorDeUbicacion = err => {
		console.log("Error obteniendo ubicación: ", err);
	}

	const opcionesDeSolicitud = {
		enableHighAccuracy: true, // Alta precisión
		maximumAge: 0, // No queremos caché
		timeout: 10000 // Esperar solo 5 segundos
	};
	navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);
        
    },
    Reubicar(index){
        this.ubicacionCab24(index);
        //this.$forceUpdate();
    },
    habilitarBotones(){
        var guardar = !!document.getElementById('guardar');
        var actualizar = !!document.getElementById('actualizar');
        var finalizar = !!document.getElementById('finalizar');
        if (guardar){
            document.getElementById('guardar').disabled=false;
        }else if(actualizar){
            document.getElementById('actualizar').disabled=false;
        }else if(finalizar){
            document.getElementById('finalizar').disabled=false;
        }
    },
    deshabilitarBotones(){
        var guardar = !!document.getElementById("guardar");
        var actualizar = !!document.getElementById("actualizar");
        var finalizar = !!document.getElementById("finalizar");
        if (guardar){
            document.getElementById('guardar').disabled=true;
        }else if(actualizar){
            document.getElementById('actualizar').disabled=true;
        }else if(finalizar){
            document.getElementById('finalizar').disabled=true;
        }
    },
    cantConceptoChange(index){
        if(this.concepto_select[index] == 17 && this.concepto_cant[index] != 0){
            while(this.tab_cab24 != this.concepto_cant[index])
            {
                if(this.tab_cab24 < this.concepto_cant[index])
                {
                    this.agregarCab24();
                }
                if(this.tab_cab24 > this.concepto_cant[index])
                {
                    this.tab_cab24--; 
                    this.cooDaño.pop();
                }
            }                
        }
    },
    isOtFunction(){
        this.isOt = this.idTipoFolio === 1 ? false:true;
        this.calcTiempo();
    },
        },
}
</script>
