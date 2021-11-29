<template>
  <div class="border border-dark">
      <h4 class="text-center">Material TotalPlay</h4>
     <div v-for="(value,index) in $store.state.materialTTP" v-bind:key="value" class="px-3">
         <div class="form-group">
             <div class="row">
                  <div class="form-floating col-5 col-md-4">
                        <select v-model="$store.state.material_selectTtp[index]" class="form-select" :name="material_name[index]==null?'material':material_name[index]" @change="materialTtpAnalizar(index)" :disabled="$store.state.disabledTtp[index]">
                            <option value="sinMaterial" v-if="!existeMaterial">Sin Material</option>
                                <option v-for="(value,index) in $store.state.comboMaterialTTP" :key="index" :value="$store.state.comboMaterialTTP[index].id">
                                    {{$store.state.comboMaterialTTP[index].descripcion}}
                                </option>
                        </select>
                        <label for="material">Material</label>
                    </div>
                    <div class="form-floating col-3">
                        <input v-model="material_cant[index]" type="number" :id="'material_can['+index+']'"  class="form-control positivo" :name="material_name[index]==null?'material_can':material_name[index]" :disabled="$store.state.disabledTtp[index] || controlDisabled">
                        <label for="material_can">Cantidad</label>
                    </div>
                    <div class="form-floating col-2">
                        <button type="button" @click="$store.commit('borraMaterialTtp')" class="btn btn-secondary" v-if="material_name[index]==null && $store.state.materialTTP>1?true:false">Borrar</button>
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
            material_cant:[],
            material_name:[],
            controlDisabled:true,
            existeMaterial:false,
        }
    },
    props:['datos'],
    mounted(){
        this.cargaMaterial();
    },
    methods:{
        cargaMaterial(){
            if(this.datos !=null && this.datos != ''){
             let i=0;
            this.datos.forEach(element => {
                if(element.tipo_material === 2){
                   if(i!=0){
                    this.$store.commit('agregarMaterialTtp',this.existeMaterial);
                   }
                    this.existeMaterial = true;
                    this.$store.state.material_selectTtp[i] = element.material_id;
                    this.material_cant[i] = element.cantidad;
                    this.material_name[i] = 'detalle';
                    this.$store.state.disabledTtp[i] = true;
                    i++
                }  
            });
            }
        },
        materialTtpAnalizar(index){
            if(this.$store.state.material_selectTtp[index]=='sinMaterial'){
               if(this.$store.state.materialTTP>1){ 
                this.$store.state.material_selectTtp.forEach(element => {
                    this.$store.commit('borraMaterialTtp');
                });
                this.$store.commit('agregarMaterialTtp');
                }
                this.$store.state.material_selectTtp=[];
                this.material_cant=[];
                this.$store.state.material_selectTtp[0]='sinMaterial';
                this.controlDisabled=true;
            }
            else{this.controlDisabled=false;}
        },
    },
}
</script>
