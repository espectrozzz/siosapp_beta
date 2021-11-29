@extends('layouts.app', ['activePage'=>'tecnico504','titlePage'=>__('tecnico504')])

@section('content')
    <div class="content">
        <alert-component user_id="{{auth()->user()->id}}"></alert-component>
        <h1>Aún no tienes folio asignado</h1>
    </div>
@endsection