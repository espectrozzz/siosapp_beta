const { default: axios } = require("axios");

const app = new Vue({
    el: '#app',
    data:function(){
        return{
        selected_distrito: '',
        selected_cluster: '',
        combos: [],
        selected_supervisor:'',
        supervisors:[],
        asignacionIos:'',
        llegadaIos:'',
        cierreIos:'',
        idTipoFolio:'',
        eta:'',
        sla:'',
        alertaEta:false,
        alertaSla:false,
        pausa:'',
        cantPausa:'',
    }  
    },
    mounted(){
        document.getElementById('cluster').disabled=true;
        document.getElementById('supervisorTTP').disabled=true;
        document.getElementById('llegadaFolio').disabled=true;
        document.getElementById('activacionFolio').disabled=true;
        document.getElementById('fPausado').disabled=true;

        this.selected_distrito = this.getOldData('distrito');
        if(this.selected_distrito != ''){
            this.loadCombos();
        }
        this.selected_cluster = this.getOldData('cluster');
    },
    methods: {
        loadCombos()
        {
            this.selected_cluster = '';
            this.selected_supervisor = '';
            document.getElementById('cluster').disabled=true;
            document.getElementById('supervisorTTP').disabled=true;
           if(this.selected_distrito != '')
            {
                axios.get('/combo',{params:{distrito_id:this.selected_distrito}}).then((response) => {
                    this.combos = response.data;
                    document.getElementById('cluster').disabled=false;
                    document.getElementById('supervisorTTP').disabled=false;
                }); 
            }
        },
        getOldData(id){
            return document.getElementById(id).getAttribute('data-old');
        },
        calcTiempo()
        {
           
           
            if(this.asignacionIos != '')
            {
                document.getElementById('llegadaFolio').disabled=false;
                document.getElementById('fPausado').disabled=false;
                if(this.llegadaIos != '')
                {
                    document.getElementById('activacionFolio').disabled=false;
                    axios.get('/tiempo',{params:{fechaIos:this.asignacionIos,
                        llegadaFolio:this.llegadaIos,
                        cierreFolio:this.cierreIos,
                        idTipoFolio:this.idTipoFolio,
                        timeStop:this.cantPausa}}).
                        then((response) =>
                        {
                           this.calcEtaSla(response);
                            
                           //console.log(response.data.timeMax);
                        });
                }
                else
                {
                    document.getElementById('activacionFolio').disabled=true;
                    document.getElementById('fPausado').disabled=false;
                    this.cierreIos='';
                    this.eta='';
                    this.pausa='';
                    this.cantPausa='';
                }
            }
            else
            {
                document.getElementById('llegadaFolio').disabled=true;
                document.getElementById('activacionFolio').disabled=true;
                this.llegadaIos='';
                this.cierreIos='';
                this.eta='';
            }
        },
        calcEtaSla(response) {

            if(response.data.negativoEta === 1)
            {
                alert("Error: Por favor verifica las fechas ingresadas.");
                this.eta='';
                this.alertaEta=false;
                this.llegadaIos='';
                return ;
            }

            if (response.data.minutosEta <= 9) {
                this.eta = response.data.horasEta + ':0' + response.data.minutosEta;
            }
        
            else {
                this.eta = response.data.horasEta + ':' + response.data.minutosEta;
            }
            if (response.data.horasEta >= 1 || response.data.minutosEta > 30) {
                this.alertaEta = true;
            }
        
            else {
                this.alertaEta = false;
            }
            //SLA verificación
            if (this.cierreIos != '')
            {
            if(response.data.negativoSla === 1)
            {
                alert("Error: Por favor verifica las fechas ingresadas.");
                this.sla='';
                this.alertaSla=false;
                this.cierreIos='';
                return ;
            }
            


            if (response.data.minutosSla <= 9) {
                this.sla = response.data.horasSla + ':0' + response.data.minutosSla;
            }
        
            else {
                this.sla = response.data.horasSla + ':' + response.data.minutosSla;
            }
            if (response.data.horasSla > response.data.timeMax) {
                this.alertaSla = true;
            }
        
            else {
                this.alertaSla = false;
            }
        }
        },
        tiempoPausa()
        {
            if(this.pausa != '')
            { 
                if(this.cantPausa === 0 || this.cantPausa < 0 )
                {
                    alert("Error: Por favor verifique el tiempo de pausa.");
                    this.cantPausa='';
                    return;
                }
                else
                {
                   this.calcTiempo();
                   minutos = this.sla.split(":");
                }    
            }
        }
    }, 
});


