<?php

namespace App\Http\Controllers;

use App\Models;
use App\Models\c_causa;
use App\Models\c_despacho;
use App\Models\c_turnos;
use App\Models\c_justificacion_pausa;
use App\Models\c_distrito;
use App\Http\Traits\myTrait;
use App\Models\c_falla;
use App\Models\c_supervisor;
use App\Models\c_tecnico;
use App\Models\c_tipo_folio;
use App\Models\d_analisi;
use App\Models\apoyo_materiale;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use DateTime;
use App\Exports\MaterialExport;
use App\Models\c_materiale;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class PageController extends Controller
{
    use myTrait;
    public function captura(){
        $turnos = c_turnos::all();
        $justificacion = c_justificacion_pausa::all();
        $distritos = c_distrito::all();
        $fallas = c_falla::all();
        $tipo_Folio = c_tipo_folio::where('campo_1',1)->get();
        $causas = c_causa::all();
        $despacho = c_despacho::all();
        $tecnicos = c_tecnico::all(); 
        $user_despacho = c_despacho::where('user_id',auth()->user()->id)->get();
        return view('informacion.preventivo',compact('turnos','justificacion','distritos','fallas','tipo_Folio','causas','despacho','tecnicos','user_despacho'));
       
    }    

    public function correctivo(){
        $turnos = c_turnos::all();
        $justificacion = c_justificacion_pausa::all();
        $distritos = c_distrito::all();
        $fallas = c_falla::all();
        $tipo_Folio = c_tipo_folio::where('campo_1',2)->get();
        $causas = c_causa::all();
        $despacho = c_despacho::all();
        $tecnicos = c_tecnico::all();
        $user_despacho = c_despacho::where('user_id',auth()->user()->id)->get();
        return view('informacion.correctivo',compact('turnos','justificacion','distritos','fallas','tipo_Folio','causas','despacho','tecnicos','user_despacho'));
    }
    public function consulta()
    {
        return view('folios.consulta');
    }
    public function grafica(){


        $datos = d_analisi::selectRaw('Count(despacho_id) as total,c_despachos.nombre,d_analisis.despacho_id')
                          ->groupBy('despacho_id')
                          ->join('c_despachos','c_despachos.id','d_analisis.despacho_id')
                          ->whereBetween('d_analisis.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                          ->get();

        return json_encode($datos);
    }

    public function reportes()
    {
        $distritos = c_distrito::all();
        return view('reportes',compact('distritos'));
    }
// return Excel::download(new MaterialExport, 'materiales.xlsx');

    public function export(Request $request)
    {
        return view('excel.plantilla', [
            'materiales'=>d_analisi::select('d_analisis.folio as folio','d_calc_tiempos.activacion as activacion','c_clusters.descripcion as cluster',DB::raw('concat_ws(",",d_ubicaciones.latitud,d_ubicaciones.longitud) as coordenadas'),'d_materiales.material_id as material','d_materiales.cantidad as cantidad','c_tipo_folios.descripcion as tipofolio','c_incidencias.descripcion as incidencia','c_turnos.descripcion as turno', 'c_distritos.descripcion as distrito', 'c_fallas.descripcion as falla','c_causas.descripcion as causa','d_analisis.clientes_afectados as clientesafectados','d_calc_tiempos.asignacion_ios as asignacionios', 'd_calc_tiempos.llegada as llegada','d_calc_tiempos.activacion as activacion', 'd_calc_tiempos.eta as eta', 'd_calc_tiempos.sla as sla','c_despachos.Nombre as nombredespacho','c_tecnicos.Nombre as tecnico','c_estatus.descripcion as estatus' )
                              ->join('d_calc_tiempos','d_calc_tiempos.folio_id','d_analisis.id')
                              ->join('c_clusters','c_clusters.id','d_analisis.cluster_id')
                              ->join('d_ubicaciones','d_ubicaciones.folio_id','d_analisis.id')
                              ->join('d_materiales','d_materiales.folio_id','d_analisis.id')
                              ->join('c_materiales','c_materiales.id','d_materiales.material_id')
                              ->join('c_tipo_folios','c_tipo_folios.id','d_analisis.tfolio_id')
                              ->join('c_incidencias','c_incidencias.id','d_analisis.tipo_folio')
                              ->join('c_distritos','c_distritos.id','d_analisis.distrito_id')
                              ->join('c_turnos','c_turnos.id','d_analisis.turno_id')
                              ->join('c_fallas','c_fallas.id','d_analisis.falla_id')
                              ->join('c_causas','c_causas.id','d_analisis.causa_id')
                              ->join('c_despachos','c_despachos.id','d_analisis.despacho_id')
                              ->join('c_tecnicos','c_tecnicos.id','d_analisis.tecnico_id')
                              ->join('c_estatus','c_estatus.id','d_analisis.estatus_id')
                              ->where('c_materiales.tipo_material', 1)
                              ->whereMonth('created_at', 12)
                            //   ->FiltrarDistrito($this->distrito)
                              // ->orWhere('d_analisis.distrito_id', 7) NO
                            //   ->FiltrarTipoFolio($this->incidencia)
                            //   ->FiltrarFecha($this->objeto)
                              ->orderBy('d_analisis.id')
                              ->orderBy('d_materiales.material_id')
                              ->get(),
            'materiales2'=>d_analisi::select('d_analisis.folio as folio','d_calc_tiempos.activacion as activacion','c_clusters.descripcion as descripcion',DB::raw('concat_ws(",",d_ubicaciones.latitud,d_ubicaciones.longitud) as coordenadas'),'d_materiales.material_id as material','d_materiales.cantidad as cantidad')
                              ->join('d_calc_tiempos','d_calc_tiempos.folio_id','d_analisis.id')
                              ->join('c_clusters','c_clusters.id','d_analisis.cluster_id')
                              ->join('d_ubicaciones','d_ubicaciones.folio_id','d_analisis.id')
                              ->join('d_materiales','d_materiales.folio_id','d_analisis.id')
                              ->join('c_materiales','c_materiales.id','d_materiales.material_id')
                              ->where('c_materiales.tipo_material', 1)
                              ->whereMonth('created_at', 12)
                              ->orderBy('d_analisis.id')
                              ->orderBy('d_materiales.material_id')
                              ->get(),
            'catalogos'=>c_materiale::select('c_materiales.id as id', 'c_materiales.descripcion as descripcion')
                                     ->where('c_materiales.tipo_material', 1)
                                     ->orderBy('c_materiales.id')
                                     ->get()
        ]);
    }
}

