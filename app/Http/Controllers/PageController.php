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
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
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

    public function export(Request $request)
    {
        // var_dump($request);
        return Excel::download(new UsersExport($request), 'materiales.xlsx');
        // return $request->distrito;
    }
}

