<table>
    <thead>
    <tr>
        <th style="font-weight: bold;">FOLIO</th>
        <th>TIPO FOLIO</th>
        <th>INCIDENCIA</th>
        <th>TURNO</th>
        <th>DISTRITO</th>
        <th>CLUSTER</th>
        <th>COORDENADAS</th>
        <th>FALLA</th>
        <th>CAUSA</th>
        <th>CLIENTES AFECTADOS</th>
        <th>ASIGNACION IOS</th>
        <th>LLEGADA</th>
        <th>ACTIVACION</th>
        <th>ETA</th>
        <th>SLA</th>
        <th>NOMBRE DESPACHO</th>
        <th>TECNICO</th>
        <th>ESTATUS</th>
        @foreach($catalogos as $catalogo)
            <th>{{ $catalogo->descripcion }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>

    @php
        $i = 0
    @endphp
    @php
        $a = 0
    @endphp



    @foreach($materiales as $material)
        @if( $i == 0 )
            <tr>
                <td>
                    {{ $material->folio }}
                </td>
                <td>
                    {{ $material->tipofolio }}
                </td>
                <td>
                    {{ $material->incidencia }}
                </td>
                <td>
                    {{ $material->turno }}
                </td>
                <td>
                    {{ $material->distrito }}
                </td>
                <td>
                    {{ $material->cluster }}
                </td>
                <td>
                    {{ $material->coordenadas }}
                </td>
                <td>
                    {{ $material->falla }}
                </td>
                <td>
                    {{ $material->causa }}
                </td>
                <td>
                    {{ $material->clientesafectados }}
                </td>
                <td>
                    {{ $material->asignacionios }}
                </td>
                <td>
                    {{ $material->llegada }}
                </td>
                <td>
                    {{ $material->activacion }}
                </td>
                <td>
                    {{ $material->eta }}
                </td>
                <td>
                    {{ $material->sla }}
                </td>
                <td>
                    {{ $material->nombredespacho }}
                </td>
                <td>
                    {{ $material->tecnico }}
                </td>
                <td>
                    {{ $material->estatus }}
                </td>

                
                @php
                    $b = 0
                @endphp
                @foreach($catalogos as $catalogo)
                    @php
                        $posiciones[$b] = 0
                    @endphp
                    @php
                        $b++
                    @endphp
                @endforeach

                @foreach($materiales2 as $material2)


                    @if($material->folio == $material2->folio)

                        @php
                            $i++
                        @endphp 

                            @foreach($catalogos as $catalogo)

                                @if( $catalogo->id == $material2->material )
                                    @php
                                        $posiciones[$a] = $posiciones[$a] + $material2->cantidad
                                    @endphp
                                @else
                                    @php
                                        $posiciones[$a] = $posiciones[$a] + 0
                                    @endphp
                                @endif

                                @php
                                    $a++;
                                @endphp

                            @endforeach

                        @php
                            $a = 0;
                        @endphp

                    @endif

                @endforeach
                @php
                    $i--
                @endphp

                @foreach($posiciones as $posicion)
                    @if( $posicion == 0 )
                        <td></td>
                    @else
                        <td> {{ $posicion }}</td>
                    @endif
                @endforeach
            </tr>
        @else
            @php
                $i--
            @endphp
        @endif
    @endforeach

    </tbody>
</table>