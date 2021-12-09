@extends('layouts.app', ['activePage' => 'reportes', 'titlePage' => __('Reportes')])

<title>Reportes</title>

@section('content')
    <div class="content">
        <div class="px-3 py-3 shadow rounded border">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
            @endif
            <reportes-component :distritos="{{json_encode($distritos)}}"></reportes-component>
        </div>
    </div>
@endsection