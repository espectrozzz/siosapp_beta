<?php

namespace App\Exports;

use App\Models\c_materiale;
use App\Models\d_materiale;
use App\Models\d_analisi;
use App\Models\apoyo_materiale;
use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use stdClass;

class UsersExport implements FromView//FromQuery,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // protected $datos;
    // protected $headers;

    public function __construct($request)
    {
        $this->incidencia = $request->incidencia;
        $this->distrito   = $request->distrito;
        $this->objeto     = new stdClass();
        $this->objeto->fechaIni = $request->fecIni;
        $this->objeto->fechaFin = $request->fecFin;
        // dd($this->objeto);
    }

    public function view(): View 
    {
        return view('excel.plantilla', [
            'materiales'=>d_analisi::select('d_analisis.folio as folio','d_calc_tiempos.activacion as activacion','c_clusters.descripcion as cluster',DB::raw('concat_ws(",",d_ubicaciones.latitud,d_ubicaciones.longitud) as coordenadas'),'d_materiales.material_id as material','d_materiales.cantidad as cantidad','c_tipo_folios.descripcion as tipofolio','c_incidencia.descripcion as incidencia','c_turnos.descripcion as turno', 'c_distritos.descripcion as distrito', 'c_fallas.descripcion as falla','c_causas.descripcion as causa','d_analisis.clientes_afectados as clientesafectados','d_calc_tiempos.asignacion_ios as asignacionios', 'd_calc_tiempos.llegada as llegada','d_calc_tiempos.activacion as activacion', 'd_calc_tiempos.eta as eta', 'd_calc_tiempos.sla as sla','c_despachos.Nombre as nombredespacho','c_tecnicos.Nombre as tecnico','c_estatus.descripcion as estatus' )
                              ->join('d_calc_tiempos','d_calc_tiempos.folio_id','d_analisis.id')
                              ->join('c_clusters','c_clusters.id','d_analisis.cluster_id')
                              ->join('d_ubicaciones','d_ubicaciones.folio_id','d_analisis.id')
                              ->join('d_materiales','d_materiales.folio_id','d_analisis.id')
                              ->join('c_materiales','c_materiales.id','d_materiales.material_id')
                              ->join('c_tipo_folios','c_tipo_folios.id','d_analisis.tfolio_id')
                              ->join('c_incidencia','c_incidencia.id','d_analisis.tipo_folio')
                              ->join('c_distritos','c_distritos.id','d_analisis.distrito_id')
                              ->join('c_turnos','c_turnos.id','d_analisis.turno_id')
                              ->join('c_fallas','c_fallas.id','d_analisis.falla_id')
                              ->join('c_causas','c_causas.id','d_analisis.causa_id')
                              ->join('c_despachos','c_despachos.id','d_analisis.despacho_id')
                              ->join('c_tecnicos','c_tecnicos.id','d_analisis.tecnico_id')
                              ->join('c_estatus','c_estatus.id','d_analisis.estatus_id')
                              ->where('c_materiales.tipo_material',2)
                              ->FiltrarDistrito($this->distrito)
                              // ->orWhere('d_analisis.distrito_id', 7)
                              ->FiltrarTipoFolio($this->incidencia)
                              ->FiltrarFecha($this->objeto)
                              ->orderBy('d_analisis.id')
                              ->orderBy('d_materiales.material_id')
                              ->get(),
            'materiales2'=>d_analisi::select('d_analisis.folio as folio','d_calc_tiempos.activacion as activacion','c_clusters.descripcion as descripcion',DB::raw('concat_ws(",",d_ubicaciones.latitud,d_ubicaciones.longitud) as coordenadas'),'d_materiales.material_id as material','d_materiales.cantidad as cantidad')
                              ->join('d_calc_tiempos','d_calc_tiempos.folio_id','d_analisis.id')
                              ->join('c_clusters','c_clusters.id','d_analisis.cluster_id')
                              ->join('d_ubicaciones','d_ubicaciones.folio_id','d_analisis.id')
                              ->join('d_materiales','d_materiales.folio_id','d_analisis.id')
                              ->join('c_materiales','c_materiales.id','d_materiales.material_id')
                              ->where('c_materiales.tipo_material',2)
                              ->orderBy('d_analisis.id')
                              ->orderBy('d_materiales.material_id')
                              ->get(),
            'catalogos'=>c_materiale::select('c_materiales.id as id', 'c_materiales.descripcion as descripcion')
                                     ->where('c_materiales.tipo_material', 2)
                                     ->orderBy('c_materiales.id')
                                     ->get()
        ]);
    }
    
}
