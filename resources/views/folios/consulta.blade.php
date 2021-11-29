@extends('layouts.app', ['activePage'=>'consulta','titlePage'=>__('consulta')])

@section('content')

    <div class="content pd-2 shadow-box">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <div id="app">
          @hasrole('administrador')
          <table-component :admin=1></table-component>
          @else
            @hasrole('supervisor')
              <table-component :admin=1></table-component>
              @else
                <table-component :admin=0></table-component>
            @endhasrole
          @endhasrole
        </div>
    </div>
@endsection
