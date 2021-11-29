<template>
    <div class="form-floating col">       
                <select v-model="$store.state.selected_supervisor" @change="$store.commit('loadComboTecnico')" id="supervisorTTP" name="supervisorTTP" class="form-select" placeholder="Supervisor TTP" v-bind:disabled="$store.state.controlCombo || role==1">
                    <option value="">Seleccione un supervisor</option>
                    <option v-for="value,index in $store.state.comboSupervisor.supervisor" :key="index" :value="$store.state.comboSupervisor.supervisorID[index].id" >
                        {{$store.state.comboSupervisor.supervisor[index]}}
                    </option>  
                </select>
                <label for="supervisorTTP">Supervisor TTP</label>
            </div>
</template>

<script>
export default {
    data(){
        return{
         
        }
    },
    props:['role'],
    mounted(){
       
    },
    methods:{
     
    }
}
</script>
