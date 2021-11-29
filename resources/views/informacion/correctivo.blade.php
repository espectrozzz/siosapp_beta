@extends('layouts.app', ['activePage'=>'correctivo','titlePage'=>__('correctivo')])
<title>iOS-Información</title>
@section('content')
<div class="content" style="">
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/mi_estilo.css') }}">
<div><h1>Folio Correctivo</h1></div>
 @if($errors->any())
 <div class="alert alert-danger" style="width:100%;">
    <ul>
        @foreach ($errors->all() as $error)   
        <li>{{$error}}</li>   
        @endforeach
    </ul>
</div>
 @endif
 
 <div class="contenido">
    <div class="contenido__datos px-3 py-3 shadow rounded border">
        <form class="form-incidencia " method="POST" action="{{Route('informacion.correctivo')}}" class="form-c" enctype="multipart/form-data">
            @csrf
            @hasrole('tecnico')
            <form-component v-bind:form="1" v-bind:datos=[] v-bind:role='1'></form-component>
            @else
            <form-component v-bind:form="1" v-bind:datos=[] v-bind:role='0' :user_despacho="{{json_encode($user_despacho)}}"></form-component>
            @endhasrole
        </form>
    </div>
</div>




</div>

@endsection
