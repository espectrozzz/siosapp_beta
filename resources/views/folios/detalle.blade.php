@extends('layouts.app', ['activePage'=>'consulta','titlePage'=>__('Mantenimiento Folio')])

@section('content')

    <div class="content">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/mi_estilo.css') }}">
        @if($errors->any())
 <div class="alert alert-danger" style="width:100%;">
    <ul>
        @foreach ($errors->all() as $error)   
        <li>{{$error}}</li>   
        @endforeach
    </ul>
</div>
 @endif
        <div id="app">
            <form method="POST">
                @csrf
        <form-component :form="{{$analisis[0][0]->tipo_folio}}" v-bind:datos='{{json_encode($analisis)}}' v-bind:detalle="1"></form-component>
            </form>
            
        </div>
    </div>
@endsection