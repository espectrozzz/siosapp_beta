@extends('layouts.app', ['activePage' => 'dashboard'])

<title>Home</title>

@section('content')
  <div class="content">
    <h1>Bienvenido</h1>
    <div class="contenido">
      <div class="contenido__datos">
    @hasanyrole('administrador') 
    <estadistica-component></estadistica-component>
    @endhasanyrole
  </div>
  </div>
</div>
@endsection

