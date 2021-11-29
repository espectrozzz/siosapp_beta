<template>
<div>
<div class="row">
    <div class="col-md-7 col-lg-6 my-2">
        <canvas id="myChart" width="auto" height="180 " style="color:white"></canvas>
    </div>
    <div class="col-lg-6 my-2">
        <table class="table tabla-estadistica" cellspacing="2">
        <thead class="">
            <tr>
                <th class="th-despacho">Despacho</th>
                <th class="th-cantidad">Cantidad de Folios</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(value,index) in folios" :key="index">
                <td class="td-despacho">{{folios[index].nombre}}</td>
                <td class="td-cantidad">{{folios[index].total}}</td>
            </tr>
        </tbody>
        </table>
    </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            folios:{},
        }
    },
    mounted(){
        this.grafica();
    },
    methods:{
        grafica(){
            var datos=[];
           

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Abel Franco','Elizabeth Martinez','Alfredo Aguilera','Claudia Recillas','Leia Anguiano'],
                    datasets: [{
                        label: ['# Folios Capturados'],
                        data: [0,0,0,0,0],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(6,126,123,1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    },
                    labels:{
                        fontColor:'rgb(60, 180, 100)'
                    }
                }
            });
             axios.get('/grafica').then((response)=>{
                this.$set(this.$data, 'folios', response.data);
                for(var i in response.data){
                    myChart.data.datasets[0].data[response.data[i].despacho_id -1]=response.data[i].total;  
                //    myChart.data.labels[i]=response.data[i].nombre;
                    
                }
                myChart.update();
            });
             // myChart.defaults.global.defaultFontColor = 'blue';
              console.log(myChart);
        }, //Fin metodo grafica
      
    }
}

</script>