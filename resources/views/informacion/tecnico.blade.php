@extends('layouts.app', ['activePage'=>'tecnico','titlePage'=>__('tecnico')])

@section('content')
    <div class="content">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/mi_estilo.css') }}">
        <alert-component user_id="{{auth()->user()->id}}"></alert-component>
        <form-component :form="{{$analisis[0][0]->tipo_folio}}" v-bind:datos='{{json_encode($analisis)}}' v-bind:detalle="1" v-bind:role='1'></form-component>
</div>
@endsection