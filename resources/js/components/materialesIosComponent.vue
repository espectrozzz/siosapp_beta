<template>
    <div class="border border-dark">
         <h4 class="text-center">Miscelaneos</h4>
        <div v-for="(value,index) in $store.state.materialIOS" v-bind:key="value" class="px-3" >
            <div class="form-group" >
                <div class="row">
                    <div class="form-floating col-5">
                        <select v-model="$store.state.material_selectIos[index]" class="form-select" :name="material_name[index]==null?'material':material_name[index]" @change="materialIosAnalizar(index)" :id="'material_id['+index+']'" :disabled="$store.state.disabledIos[index]">
                            {{value}}
                            <option  value="sinMaterial" v-if="!existeMaterial">Sin Material</option>
                            <option v-for="(value,index) in $store.state.comboMaterialIOS" :key="index" :value="$store.state.comboMaterialIOS[index].id">
                                {{$store.state.comboMaterialIOS[index].descripcion}}
                            </option>
                        </select>
                          <label for="material">Material</label>
                    </div>
                   
                    <div class="form-floating col-3">
                        <input v-model="material_cant[index]" type="number" :id="'material_can['+index+']'" class="form-control positivo" min="1" :name="material_name[index]==null?'material_can':material_name[index]" :disabled="$store.state.disabledIos[index] || controlDisabled">
                        <label for="material_can">Cantidad</label>
                    </div>
                    <div class="form-floating col-2">
                        <button type="button" @click="$store.commit('borraMaterialIos')" class="btn btn-secondary" v-if="material_name[index]==null && $store.state.materialIOS>1?true:false">Borrar</button>
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
            if(this.datos != null && this.datos!=''){
            let i=0;
            this.datos.forEach(element => {
                if(element.tipo_material === 1){
                    if(i!=0){
                    this.$store.commit('agregarMaterialIos');
                    }
                    this.existeMaterial = true;
                    this.$store.state.material_selectIos[i] = element.material_id;
                    this.material_cant[i] = element.cantidad;
                    this.material_name[i] = 'detalle';
                    this.$store.state.disabledIos[i] = true;
                    i++
                }
                
            });
            }
        },
         materialIosAnalizar(index){
            if(this.$store.state.material_selectIos[index]=='sinMaterial'){
               if(this.$store.state.materialIOS>1){ 
                this.$store.state.material_selectIos.forEach(element => {
                    this.$store.commit('borraMaterialIos');
                });
                this.$store.commit('agregarMaterialIos');
                }
                this.$store.state.material_selectIos=[];
                this.material_cant=[];
                this.$store.state.material_selectIos[0]='sinMaterial';
                this.controlDisabled=true;
            }
            else{this.controlDisabled=false;}
        },
    }
}
</script>
