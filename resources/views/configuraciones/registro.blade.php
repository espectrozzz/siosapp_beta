@extends('layouts.app', ['activePage'=>'registro','titlePage'=>__('registro')])

@section('content')

    <div class="content pd-2 shadow-box">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <div id="app">
          <formulario-registro></formulario-registro>
        </div>
    </div>
@endsection
