<?php

namespace App\Exports;

use App\Models\d_analisi;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use stdClass;

class MaterialExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct($request)
    {
        $this->request = $request;
        $this->fechas = new stdClass();
        $this->fechas->fechaIni = $request->fecIni;
        $this->fechas->fechaFin = $request->fecFin; 
    }

    public function query()
    {
        // dd(d_analisi::find(2)->tipoFolio);
        return d_analisi::query()->select ('d_analisis.folio', 'c_tipo_folios.descripcion as tipoFolio', 'c_incidencias.descripcion as incidencias', 'd_analisis.OT',
                                           'c_turnos.descripcion as turnos', 'c_distritos.descripcion as distritos', 'c_clusters.descripcion as clusters', 'c_fallas.descripcion as fallas', 'c_causas.descripcion as causas',
                                           'd_analisis.clientes_afectados', 'c_materiales.descripcion as materiales', 'd_materiales.cantidad', 'd_calc_tiempos.asignacion_ios', 'd_calc_tiempos.llegada', 'd_calc_tiempos.activacion',
                                           'd_calc_tiempos.eta', 'd_calc_tiempos.sla', 'c_despachos.nombre as despachos', 'c_tecnicos.nombre as tecnicos'
                                        )
                                 ->leftJoin('c_tipo_folios', 'c_tipo_folios.id', 'd_analisis.tfolio_id')
                                 ->leftJoin('c_incidencias', 'c_incidencias.id', 'd_analisis.incidencia_id')
                                 ->leftJoin('c_turnos', 'c_turnos.id', 'd_analisis.turno_id')
                                 ->leftJoin('c_distritos', 'c_distritos.id', 'd_analisis.distrito_id')
                                 ->leftJoin('c_clusters', 'c_clusters.id', 'd_analisis.cluster_id')
                                 ->leftJoin('c_fallas', 'c_fallas.id', 'd_analisis.falla_id')
                                 ->leftJoin('c_causas', 'c_causas.id', 'd_analisis.causa_id')
                                 ->Join('d_materiales', 'd_materiales.folio_id', 'd_analisis.id')
                                 ->leftJoin('c_materiales', 'c_materiales.id', 'd_materiales.material_id')
                                 ->leftJoin('d_calc_tiempos', 'd_calc_tiempos.folio_id', 'd_analisis.id')
                                 ->leftJoin('c_despachos', 'c_despachos.id', 'd_analisis.despacho_id')
                                 ->leftJoin('c_tecnicos', 'c_tecnicos.id', 'd_analisis.tecnico_id')
                                 ->FiltrarDistrito($this->request->distrito)
                                 ->FiltrarTipoFolio($this->request->incidencia)
                                 ->FiltrarFecha($this->fechas);
    }

    public function headings(): array
    {
        return [
            'FOLIO', 'TIPO FOLIO', 'INCIDENCIA', 'OT', 'TURNO', 'DISTRITO', 'CLUSTER', 'FALLA', 'CAUSA', 'CLIENTES AFECTADOS',
            'MATERIAL','CANTIDAD', 'ASIGNACION', 'LLEGADA', 'ACTIVACION', 'ETA', 'SLA', 'DESPACHO', 'TECNICO'
        ];
    }
}
