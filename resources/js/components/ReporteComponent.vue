<template>
    <form method="GET" action="/export">
        <div class="row">
           <div class="col-9 col-md-5 col-lg-4">
               <label class="">Tipo de Reporte</label>
                 <multiselect v-model="tReporte_select" :options="tReporteOptions" placeholder="Seleccione una Opcion" :showLabels="false" label="descripcion"></multiselect>
                 <input type="hidden" name="tReporte" v-if="tReporte_select" :value="tReporte_select.name">
           </div>
           <div class="col-9 col-md-5 col-lg-3">
               <label>Tipo de Incidencia</label>
               <multiselect v-model="incidencia_select" :options="incidenciaOptions" placeholder="Seleccione una Incidencia" :showLabels="false" label="descripcion"></multiselect>
                <input type="hidden" name="incidencia" v-if="incidencia_select" :value="incidencia_select.name">
           </div>
             <div class="col-9 col-md-5 col-lg-3">
               <label>Distrito</label>
               <multiselect v-model="distrito_select" :options="distritoOptions" :value="distritoValue" placeholder="Seleccione Distrito/s" :multiple="true"  group-values="values" group-label="group" :group-select="true" :showLabels="false" track-by="name" label="descripcion" ></multiselect>
               <input type="hidden" name="distrito[]" v-for="(value,key) in distrito_select" :key="key" :value="value.name">
           </div>
        </div>
        <div class="row">
            <div class="col-9 col-md-5 col-lg-3 my-4">
                <label>Fecha Inicial</label>
                <input v-model="fechaInicial" type="date" id="fecIni" name="fecIni" class="form-control" >
            </div>
            <div class="col-9 col-md-5 col-lg-3 my-4">
                <label>Fecha Final</label>
                <input v-model="fechaFinal" type="date" id="fecFin" name="fecFin" class="form-control" >
            </div>
        </div>
        <div class="row">
            <div class="col-9 col-md-5 col-lg-3" style="text-align:left;">
                <button type="submit" class="btn btn-primary bt-sm" @click="extraeReporte">Extraer</button>
            </div>
        </div>
    </form>
</template>

<script>
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)
export default {
    components: { Multiselect },
    data(){
        return{
            tReporte_select: null,
            tReporteOptions: [{name:'1',descripcion:'Concentrado de Materiales'},],
            incidencia_select: {name:'0',descripcion:'Todos'},
            incidenciaOptions: [ {name:'0',descripcion:'Todos'},
                                 {name:'2',descripcion:'Preventivo'},
                                 {name:'1',descripcion:'Correctivo'}],
            distrito_select: [],
            distritoOptions: [{
                group: 'Todos',
                values: []
            }],
            fechaInicial:'',
            fechaFinal:'',
            distritoValue:[],
            fechas:{},
        }
    },
    props:['distritos'],
    mounted(){
        this.distritos.forEach(element => {
            this.distritoOptions[0].values.push({name:element.id,descripcion:element.descripcion});
        });
        console.log(this.distritoOptions);
    },
    methods:{
        extraeReporte(){
            
        this.fechas = {fechaInicial:this.fechaInicial,
                        fechaFinal : this.fechaFinal};
                        // console.log(this.fechas);
                        // event.preventDefault();
            let formData = new FormData();
            formData.append('tReporte',this.tReporte_select);
            formData.append('incidencia',this.incidencia_select);
            formData.append('distrito[]',this.distrito_select);
            formData.append('fecIni',this.fechaInicial);
            formData.append('fecFin',this.fechaFinal);
            
            // axios.post('/export',formData).then((response)=>{
            //     console.log(response.data);
            // });
        }
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
