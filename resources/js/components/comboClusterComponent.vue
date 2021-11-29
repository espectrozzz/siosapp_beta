<template>
    <div class="form-floating col-md-4 col-sm-2 col-sm">
        <select v-model="$store.state.selected_cluster" name="cluster" id="cluster" class="form-select" v-bind:disabled="$store.state.controlCombo || role==1">
               <option value="" >Seleccione un cluster</option>
            <option v-for="(value,index) in $store.state.comboCluster.clusterID" v-bind:key="index" v-bind:value="value">
                {{$store.state.comboCluster.descripcionCluster[index]}}
            </option>
        </select>
        <label for="cluster">Cluster</label>
    </div>
</template>

<script>
    export default {
        data(){
            return{
            }
        },
        props:['role'],
        mounted() {
           
        },
        methods:{
        },

    }
</script>