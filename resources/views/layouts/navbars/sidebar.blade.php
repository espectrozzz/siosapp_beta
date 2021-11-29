<div class="sidebar" data-color="green">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <img class="logo__img" src="{{asset('/frontend/ios_logo_blanco.png')}}" alt="" width="150" height="auto">
  </div>
  <div class="usuario-bienvenido">
    <p>Bienvenido, <span class="span">{{auth()->user()->email}}</span></p>
  </div>
  <div class="sidebar-wrapper">
    
   
    <ul class="nav" style="padding-bottom: 30px;">
      @hasanyrole('administrador') 
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <img class="ios_iconos {{ $activePage == 'dashboard' ? ' active-ico' : '' }}" src="{{asset('/frontend/iconos/dashboard_icono.png')}}" width="30" height="auto">dashboard 
        </a>
      </li>
      @endhasanyrole

      @can('consultar-folio')
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link collapsed" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <img class="ios_iconos"  src="{{asset('/frontend/iconos/icono_mas.png')}}" width="30" height="auto">Capturar Folio
            <b class="caret mover"></b>
          
        </a>
        <div class="collapse {{ ($activePage == 'preventivo' || $activePage == 'correctivo') ? 'show' : '' }}" id="laravelExample">
          <ul class="nav">

            <li class="nav-item {{ $activePage == 'preventivo' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('informacion.preventivo') }}">
                <img class="ios_iconos {{ $activePage == 'preventivo' ? ' active-ico' : '' }}"  src="{{asset('/frontend/iconos/icono_preventivo.png')}}" width="30" height="auto">Preventivo
              </a>
            </li>
          
            <li class="nav-item{{ $activePage == 'correctivo' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('informacion.correctivo') }}">
                <img class="ios_iconos {{ $activePage == 'correctivo' ? ' active-ico' : '' }}"  src="{{asset('/frontend/iconos/correctivo_icono.png')}}" width="30" height="auto">Correctivo
              </a>
            </li>

          </ul>
        </div>
      </li>
      @endcan

      @hasanyrole('administrador|despacho|supervisor') 
      <li class="nav-item{{ $activePage == 'consulta' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('folios.consulta') }}">
          <img class="ios_iconos {{ $activePage == 'consulta' ? ' active-ico' : '' }}"  src="{{asset('/frontend/iconos/consulta_icono.png')}}" width="30" height="auto">Consultar Folios
        </a>
      </li>
      @endhasanyrole('administrador|despacho|supervisor')

      @hasanyrole('administrador') 
      <li class="nav-item{{ $activePage == 'reportes' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('/reportes') }}">
          <img class="ios_iconos {{ $activePage == 'reportes' ? ' active-ico' : '' }}"  src="{{asset('/frontend/iconos/reporte_icono.png')}}" width="30" height="auto">Reportes
        </a>
      </li>

      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#configuracionesAdmin" aria-expanded="true">
          <img class="ios_iconos"  src="{{asset('/frontend/iconos/icono_mas.png')}}" width="30" height="auto">Configuraciones
            <b class="caret mover"></b>
          
        </a>
        <div class="collapse {{ ($activePage == 'roles' || $activePage == 'registro' || $activePage == 'edicion-de-usuarios') ? 'show' : '' }}" id="configuracionesAdmin">
          <ul class="nav">

            <li class="nav-item {{ $activePage == 'roles' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('configuraciones.roles') }}">
                <img class="ios_iconos {{ $activePage == 'roles' ? ' active-ico' : '' }}"  src="{{asset('/frontend/iconos/icono_preventivo.png')}}" width="30" height="auto">Roles
              </a>
            </li>
          
            <li class="nav-item {{ $activePage == 'registro' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('configuraciones.registro') }}">
                <img class="ios_iconos {{ $activePage == 'registro' ? ' active-ico' : '' }}"  src="{{asset('/frontend/iconos/correctivo_icono.png')}}" width="30" height="auto">Registro
              </a>
            </li>

            <li class="nav-item {{ $activePage == 'edicion-de-usuarios' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('configuraciones.edicion') }}">
                <img class="ios_iconos {{ $activePage == 'edicion-de-usuarios' ? ' active-ico' : '' }}"  src="{{asset('/frontend/iconos/icono_preventivo.png')}}" width="30" height="auto">Usuarios
              </a>
            </li>
            <!-- {{$activePage}} -->
          </ul>
        </div>
        @endhasanyrole('administrador')
      </li>
    </ul>
  </div>
</div>
