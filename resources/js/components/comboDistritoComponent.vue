<template>
    <div class="form-floating col-md-4 col-sm-2 col-sm">
        <select v-model="$store.state.selected_distrito" @change="$store.commit('loadCombo')" name="distrito_id" id="distrito"  class="form-select" :disabled="role==1">
            <option value="" >Seleccione un distrito</option>
            <option v-for="(value,index) in distrito" v-bind:key="index" v-bind:value="distrito[index].id">
                {{distrito[index].descripcion}}
            </option>
        </select>
        <label for="distrito">Distrito</label>
    </div>
      
    
</template>

<script>
    export default {
        data(){
            return{
               distrito:{},  
            }
        },
        props:['datos_distrito','datos_cluster','datos_supervisor','role'],
        mounted() {
            this.cargaCombos();
            this.cargaDetalle();
        },
        methods:{
            cargaCombos(){
               axios.get('/loadcomboPreventivo').then((response) => {
                this.distrito = response.data[2];
            }); 
            },
            cargaDetalle(){
               
                if (this.datos_distrito != undefined && this.datos_cluster != undefined)
                {
                   this.$store.state.selected_distrito   =   this.datos_distrito;
                   this.$store.commit('loadCombo');
                   this.$store.state.selected_cluster    =   this.datos_cluster;
                  // this.$store.state.selected_supervisor =   '2';
                } 
            }
        },

    }
</script>