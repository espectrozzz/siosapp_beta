<template>
<div>
<div v-for="(value,index) in $store.state.seguimiento" v-bind:key="value">
            <div class="form-group">
                <div class="row">
                    <div class="form-floating col-md-6">
                        <textarea v-model="seguimientos[index]" :name="seguimiento_name[index]==null?'tracing':seguimiento_name[index]" class="md-textarea form-control" rows="5" :disabled="seguimiento_name[index]!=null"></textarea>
                    </div>
                    <div class="form-floating col-md-2" style="text-align: center;" >
                        <button type="button" @click="$store.commit('borrarSeguimiento')" class="btn btn-secondary" v-if="seguimiento_name[index]==null">Borrar</button>
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
            seguimientos:[],
            seguimiento_name:[],
        }
    },
    props:['datos'],
    mounted(){
        this.cargaSeguimiento();
    },
    methods:{
        cargaSeguimiento(){
            if(this.datos != null && this.datos != ''){
            let i=0;
            this.datos.forEach(element => {
                this.$store.commit("agregarSeguimiento");
                this.seguimientos[i]        = element.observacion;
                this.seguimiento_name[i]    = 'detalle';
                i++;
            });
            }
        },
    },
}
</script>
