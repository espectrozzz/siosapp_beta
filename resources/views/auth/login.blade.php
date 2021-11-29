@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Material Dashboard')])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/mi_estilo.css') }}">
@section('content')
<div class="login-container" id="app">
  <div class="contenedor-form">
    <form class="form" method="POST" action="{{ route('login') }}">
      @csrf
      <div class="contenedor-items">
        <div class="form-logo">
          <img class="form-logo__logo" width="250" height="200" src="{{asset('/frontend/ios_logo_blanco.png')}}" alt="">
        </div>
        <div class="parrilla2">
          <div class="form-inputs" style="justify-content: center;">
            <input type="text" id="inputUser" name="email" class="form-control form-inputs__input form-inputs__input--placeholder" autofocus placeholder="Usuario" required >
            <input type="password" id="inputPassword" name ="password" class="form-control form-inputs__input form-inputs__input--placeholder" placeholder="Contraseña" style="margin-top:30px;" required>
          </div>
          <div class="form-recuerdame">
            <input class="form-recuerdame__recuerdame" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="recuerdame">{{ __('Recuérdame') }}<label>
          </div>
          <div class="form-button">
            <button class="btn btn-primary form-button__button" style="border-radius:30px;background-color: #00A34F;border:none;font-size: 20px;" type="submit">Entrar</button>
          </div> 
        </div>
      </div>
    </form>
  </div>
    <div class="form-label">
      <label class="form-label__label">&copy; IOS  Comunicaciones - 2021</label>
    </div>
</div>

@endsection
