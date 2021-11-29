/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
window.Vue = require('vue').default;
window.Vue.component('pagination', require('laravel-vue-pagination'));

import VueHasErrorLaravel from 'vue-has-error-laravel'




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('distrito-component', require('./components/comboDistritoComponent.vue').default);
Vue.component('cluster-component', require('./components/comboClusterComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('supervisor-component', require('./components/comboSupervisorComponent.vue').default);
Vue.component('materialIos-component', require('./components/materialesIosComponent.vue').default);
Vue.component('materialTtp-component', require('./components/materialTtpComponent.vue').default);
Vue.component('seguimiento-component', require('./components/seguimientoComponent.vue').default);
Vue.component('imagen-component', require('./components/uploadImageComponent.vue').default);
Vue.component('table-component', require('./components/queryTableComponent.vue').default);
Vue.component('estadistica-component', require('./components/estadisticasComponent.vue').default);
Vue.component('alert-component', require('./components/MessageAlertComponent.vue').default);
Vue.component('notification-component', require('./components/NotificationsComponent.vue').default);
Vue.component('reportes-component', require('./components/ReporteComponent.vue').default);
Vue.component('tabla-roles', require('./components/TableRolesComponent.vue').default);
Vue.component('formulario-registro', require('./components/FormularioRegistroComponent.vue').default);
Vue.component('tabla-usuarios', require('./components/TablaUsuariosComponent.vue').default);

//Vue.component('formpreventivo-component', require('./components/FormPreventivoComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const store = new Vuex.Store({
    state: {
      comboCluster:[],
      comboSupervisor:[],
      comboMaterialIOS:[],
      comboMaterialTTP:[],
      material_selectTtp:['sinMaterial'],
      material_selectIos:['sinMaterial'],
      disabledTtp:[],
      disabledIos:[],
      selected_distrito:'',
      selected_cluster:'',
      tecnico_select : '',
      tecnico:[],
      controlCombo:true,
      controlComboTecnicos:true,
      selected_supervisor:'',
      materialTTP:1,
      materialIOS:1,
      seguimiento:0,
      _detalle:[],
      _material:[],
      _canMaterial:[],
      imagen_antes:null,
      imagen_durante:null,
      imagen_despues:null,
    },
    mutations: {
      loadCombo (state) {
      this.state.selected_cluster='';  
      this.state.selected_supervisor=''; 
      this.state.tecnico_select='';
      this.state.controlCombo=true;
      this.state.controlComboTecnicos = true;
        if(this.state.selected_distrito !=''){
            axios.get('/distrito',{params:{distrito_id:this.state.selected_distrito}}).then((response) => {
                this.state.comboCluster     = response.data[0];
                this.state.comboSupervisor  = response.data[1];
                this.state.controlCombo = false;
            }); 
        }
      },
      loadComboTecnico(){
        this.state.tecnico_select = '';
        this.state.controlComboTecnicos = false;
        axios.get('/comboTecnico',{params:{tecnico_id:this.state.selected_supervisor}}).then((response)=>{
            this.state.tecnico  = response.data;
            this.state.controlComboTecnicos = false;
        });
      },
      agregarMaterialIos(state){
        this.state.materialIOS++; 
        if(this.state.material_selectIos[0]=='sinMaterial'){this.state.material_selectIos[0]=''}
      },
      borraMaterialIos(state){
        this.state.materialIOS--;
        if(this.state.materialIOS == 1 && this.state.material_selectIos[0]==''){this.state.material_selectIos[0]='sinMaterial'}
      },
      agregarMaterialTtp(state){
        this.state.materialTTP++;
        if(this.state.material_selectTtp[0]=='sinMaterial'){this.state.material_selectTtp[0]=''}
      },
      borraMaterialTtp(state){
        this.state.materialTTP--;
        if(this.state.materialTTP == 1 && this.state.material_selectTtp[0]==''){this.state.material_selectTtp[0]='sinMaterial'}
      },
      agregarSeguimiento(state){
        this.state.seguimiento++
      },
      borrarSeguimiento(state){
        this.state.seguimiento--
      },

    },
        
  })

 const app = new Vue({
   
    el: '#app', 
    store:store,
});
