<?php

namespace App\Http\Controllers;

use App\Models\c_cluster;
use App\Models\c_distrito;
use App\Models\c_materiale;
use App\Models\c_supervisor;
use App\Models\c_tipo_folio;
use App\Models\c_causa;
use App\Models\c_concepto;
use App\Models\c_despacho;
use App\Models\c_turnos;
use App\Models\c_justificacion_pausa;
use App\Models\c_falla;
use App\Models\c_tecnico;
use App\Models\c_estatu;
use App\Models\c_incidencia;
use App\Models\supervisor_distrito;
use DateTime;
use Illuminate\Http\Request;
use stdClass;


class getComboController extends Controller
{
    public function clusterCombo(Request $request){
        $Object1 = new stdClass();
        $Object2 = new stdClass();
        if($request->ajax())
        {
            $cluster = c_cluster::where('distrito_id',$request->distrito_id)->get();

            $comboSupervisor = supervisor_distrito::select('c_supervisors.id','c_supervisors.Nombre')
                                            ->join('c_supervisors','c_supervisors.id','=','supervisor_distritos.supervisor_id')
                                            ->where('supervisor_distritos.distrito_id','=',$request->distrito_id)
                                            ->get();
                                            
           foreach ($cluster as $clusters)
            {
               $Object1->clusterID[] = $clusters->id;
               $Object1->descripcionCluster[] = $clusters->descripcion;
            }
           foreach ($comboSupervisor as $comboSupervisors)
            {
                $Object2->supervisorID[] = $comboSupervisors;
                $Object2->supervisor[] = $comboSupervisors->Nombre;
            }   
            $objeto[]= $Object1;
            $objeto[]= $Object2;
           return response()->json($objeto); 
        }
    }

    public function calcTiempo(Request $request){
        $object = new stdClass();
        if($request->ajax()){
            $timemax = c_tipo_folio::where('id',$request->idTipoFolio)->get();
            $asignacionIos = new DateTime($request->fechaIos);
            $llegadaIos = new DateTime($request->llegadaFolio);
            $cierreFolio = new DateTime($request->cierreFolio);
            $restaEta = $asignacionIos->diff($llegadaIos);
            $restaSla = $asignacionIos->diff($cierreFolio);
            
           
            if($restaEta->days >= 1)
            {
                $restaEta->h = $restaEta->h + ($restaEta->days * 24);
            }
            if($restaSla->days >= 1)
            {
                $restaSla->h = $restaSla->h + ($restaSla->days * 24);
            }

            $object->horasEta = $restaEta->h;
            $object->minutosEta = $restaEta->i;
            $object->negativoEta = $restaEta->invert;
            
            foreach ($timemax as $timemaxs)
            {
                $object->timeMax = $timemaxs->time_max;
            }

            $object->horasSla = $restaSla->h;
            $object->minutosSla = $restaSla->i;
            $object->negativoSla = $restaSla->invert;

        }


      return response()->json($object);
    }

    public function combomaterial(){
        $comboMateriales = c_materiale::all();
        foreach ($comboMateriales as $comboMaterialess){
            $comboMaterialesArray[$comboMaterialess->id] = $comboMaterialess->descripcion;
        }
        return response()->json($comboMaterialesArray); 
    }

    public function getComboSearch(){
        $distritos      = c_distrito::all();
        $cluster        = c_cluster::all();
        $estatus        = c_estatu::all(); 
        $objeto=[$distritos,$cluster,$estatus];
        return response()->json($objeto);
    }

    public function getComboFormPreventivo(){
        $turnos         = c_turnos::all();
        $justificacion  = c_justificacion_pausa::all();
        $distritos      = c_distrito::all();
        $fallas         = c_falla::all();
        $tipo_Folio     = c_incidencia::find(2)->tFolios()->get();
        $causas         = c_causa::all();
        $despacho       = c_despacho::all();
        $tecnicos       = c_tecnico::all(); 
        $materialesTTP  = c_materiale::where('tipo_material',2)->get();
        $materialesIOS  = c_materiale::where('tipo_material',1)->get();
        $conceptos      = c_concepto::all();
        $objeto=[$turnos,$justificacion,$distritos,$fallas,$tipo_Folio,$causas,$despacho,$tecnicos,$materialesIOS,$materialesTTP,$conceptos];
        return response()->json($objeto);
    }
    public function getComboFormCorrectivo(){
        $turnos         = c_turnos::all();
        $justificacion  = c_justificacion_pausa::all();
        $distritos      = c_distrito::all();
        $fallas         = c_falla::all();
        $tipo_Folio     = c_incidencia::find(1)->tFolios()->get();
        $causas         = c_causa::all();
        $despacho       = c_despacho::all();
        $tecnicos       = c_tecnico::all();
        $materialesTTP  = c_materiale::where('tipo_material',2)->get();
        $materialesIOS  = c_materiale::where('tipo_material',1)->get();
        $conceptos      = c_concepto::all();
        $objeto=[$turnos,$justificacion,$distritos,$fallas,$tipo_Folio,$causas,$despacho,$tecnicos,$materialesIOS,$materialesTTP,$conceptos];
        return response()->json($objeto);
    }

    public function ComboTecnico(Request $request){
        if($request->ajax()){
        $tecnicos = c_tecnico::where('supervisor_id',$request->tecnico_id)->get();
        }
        return response()->json($tecnicos);
    }
}
