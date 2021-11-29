@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center" id="app">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
        <formulario-registro></formulario-registro>
    </div>
  </div>
</div>
@endsection
