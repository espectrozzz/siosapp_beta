<template>
    <alert v-model="showAlert" placement="top" duration="4000" type="success" width="400px" dismissable>
        <span class="icon-ok-circled alert-icon-float-left"></span>
        <strong>{{descripcion}} :</strong>
        <p>{{order_id}}</p>
    </alert>
</template>

<script>
import { alert } from 'vue-strap'
export default {
    components:{
        alert
    },
    props:['user_id'],
    data(){
        return{
            showAlert:false,
            order_id:'',
            descripcion:'',
        }
    },
    mounted(){
        window.Echo.channel('system-ios')
        .listen('TecnicoEvent',(e)=>{
           if (this.user_id == e.usuario) {
                this.showAlert = true;
                this.order_id = e.folio.folio;
                this.descripcion = e.descripcion; 
           } 
        });
        window.Echo.channel('update-channel')
        .listen('UpdateTecnicoEvent',(e)=>{
          console.log(e);
           if (this.user_id == e.usuario) {
                this.showAlert = true;
                this.order_id = e.folio.folio;
                this.descripcion = e.descripcion; 
           } 
        });
    }
}
</script>


