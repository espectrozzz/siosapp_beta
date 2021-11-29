<template>
   <table class="table">
        <thead>
          <tr>
            <th scope="col">Folio</th>
            <th scope="col">Tipo de Folio</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(value,index) in tablaFolios.folios" v-bind:key="value" v-bind:value="value">
            <th scope="row">@{{tablaFolios.folios[index]}}</th>
            <td>@{{tablaFolios.tFolio[index]}}</td>
          </tr>
        </tbody>
      </table>
</template>

<script>
    export default {
        data(){
            return{
                tablaFolios:
                {
                    folios:['1111','22222','33333'],
                    tFolio:['SD','OS','PRJ']
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
