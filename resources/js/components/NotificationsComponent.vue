<template>
<div>
       <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="ios_iconos ios_iconos--tamano" src="/frontend/iconos/notification_icono.png"> 
            <span class="notification" v-if="notifications.length > 0">{{notifications.length}}
            </span>
            <p class="d-lg-none d-md-block">
              Notificaciones
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="overflow-y: auto; height: 400px;">
            <span class="dropdown-header">Notificaciones no Leídas</span>
            <span class="pull-right text-muted text-sm mx-2" v-if="notifications.length <= 0">Sin Notificaciones</span>
           <ul class="nav-item dropdown" v-for="(value,index) in notifications" :key="index"> 
              <span class="descripcion-notif">
                <a class="dropdown-item" @click="notificar(index)">
                  <span style="font-size: 14pt;">
                    {{value.descripcion}}
                  </span>
                </a>
              </span>
            <span class="pull-right text-muted text-sm mx-2">
                <timeago :datetime="value.time" :auto-update="60"></timeago> 
            </span>
             </ul>
             <br>
             <div class="dropdown-divider"></div>
             <span class="dropdown-header">Notificaciones Leídas</span>
             <span class="pull-right text-muted text-sm mx-2" v-if="readNotifications.length <= 0">Sin Notificaciones Leídas</span>
             <ul v-for="value in readNotifications" class="nav-item dropdown" > 
                <span class="descripcion-notif">
                  <a class="dropdown-item" href="#">
                    <span style="font-size: 14pt;">
                      {{value.descripcion}}
                    </span>
                  </a>
                </span>
                <span class="pull-right text-muted text-sm mx-2">
                    <timeago :datetime="value.time" :auto-update="60"></timeago> 
                </span>
             </ul>
             <br>
             <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/markAsRead" v-if="notifications.length > 0">Marcar como Leidas</a>
          </div>
        </li>
</div>
</template>

<script>
import VueTimeago from 'vue-timeago'
Vue.use(VueTimeago, {
  name: 'Timeago', // Component name, `Timeago` by default
  locale: 'en', // Default locale
  // We use `date-fns` under the hood
  // So you can use all locales from it
  locales: {
    'zh-CN': require('date-fns/locale/zh_cn'),
    ja: require('date-fns/locale/ja')
  }
})
export default {
    data(){
        return{
            notifications:[],
            readNotifications:[],
        }
    },
    props:['user_id','Notifications','leidas','tecnico'],
    mounted(){
      window.Echo.channel('system-ios')
        .listen('TecnicoEvent',(e)=>{
           if (this.user_id == e.usuario) {
               this.notifications.unshift({
                   descripcion: e.descripcion +" "+ e.folio.folio,
                   url:'/tecnico',
                   time: new Date(),
               });
           } 
        });

        window.Echo.channel('update-channel')
        .listen('UpdateTecnicoEvent',(e)=>{
          console.log(e);
           if (this.user_id == e.usuario) {
               this.notifications.unshift({
                   descripcion: e.descripcion +" "+ e.folio.folio,
                   url:'/consulta/'+e.folio.id,
                   time: new Date(),
               });
           } 
        });
      this.notificacionesNoLeidas();
      this.notificacionesLeidas();
      
    },
    methods:{
      notificacionesNoLeidas(){
        var urls;
        this.Notifications.forEach(element => {
          if(this.tecnico == 1){
            urls = '/tecnico';
          }
          else{
            urls = '/consulta/'+element.data.id;
          }
          console.log(element.type);
          this.notifications.unshift({
          descripcion: element.data.descripcion + " " + element.data.folio,
           url: urls,
          time: new Date(element.created_at),
        });
        });
        console.log(this.notifications);
      },
      notificacionesLeidas(){
        var i = 0;
        this.leidas.forEach(element => {
          if(i<=4){
          this.readNotifications.unshift({
          descripcion: element.data.descripcion + " " + element.data.folio,
          time: new Date(element.created_at),  
        });
        i++;
        }
        });
      },
      notificar(index){
        axios.get('/markAsRead').then((res)=>{
          document.location.href=this.notifications[index].url;
        });
      }
    }
}
</script>

