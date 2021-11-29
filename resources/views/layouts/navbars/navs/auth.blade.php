<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    {{-- <div class="navbar-wrapper">
      
    </div> --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class="navbar-form">
     
      </form>
      <ul class="navbar-nav">
        @if (auth()->user()->hasRole('tecnico'))
        <notification-component :user_id="{{auth()->user()->id}}" :Notifications="{{auth()->user()->unreadNotifications}}" :leidas="{{auth()->user()->readNotifications}}" :tecnico="1"></notification-component>
        @else
        <notification-component :user_id="{{auth()->user()->id}}" :Notifications="{{auth()->user()->unreadNotifications}}" :leidas="{{auth()->user()->readNotifications}}" :tecnico="2"></notification-component>
        @endif
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="ios_iconos ios_iconos--tamano" src="{{asset('/frontend/iconos/user_icono.png')}}"> 
            <p class="d-lg-none d-md-block">
              {{ __('Cuenta') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

            <div class=""></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
