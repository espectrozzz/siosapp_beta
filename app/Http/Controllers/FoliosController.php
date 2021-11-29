<?php

namespace App\Http\Controllers;

use App\Events\UpdateTecnicoEvent;
use App\Http\Requests\actualizarFormRequest;
use App\Http\Requests\finalizarFormRequest;
use App\Models\d_analisi;
use App\Models\d_calc_tiempo;
use App\Http\Traits\myTrait;
use App\Models\c_despacho;
use App\Models\c_tipo_folio;
use App\Models\d_concepto;
use App\Models\d_coo_daño;
use App\Models\d_pausado;
use App\Models\d_materiale;
use App\Models\d_imagene;
use App\Models\d_ubicacione;
use App\Models\d_seguimiento;
use App\Models\apoyo_materiale;

use Error;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FoliosController extends Controller
{
    use myTrait;

    public function consulta(Request $request){
        if(auth()->user()->hasRole('administrador'))
        {
            return d_analisi::select('d_analisis.folio','c_tipo_folios.descripcion as tfolio_descripcion','c_distritos.descripcion as distrito_descripcion',
                                    'd_analisis.estatus_id','c_clusters.descripcion as cluster_descripcion','c_estatus.descripcion as estatus_descripcion',
                                    'd_analisis.created_at as fecha_crea','d_calc_tiempos.eta as eta','d_calc_tiempos.sla as sla',
                                    'd_analisis.id as folio_id','c_tipo_folios.time_max as timeMax')
                            ->leftjoin('c_tipo_folios','d_analisis.tFolio_id','=','c_tipo_folios.id')
                            ->leftjoin('c_distritos','d_analisis.distrito_id','=','c_distritos.id')
                            ->leftjoin('c_clusters','d_analisis.cluster_id','=','c_clusters.id')
                            ->leftjoin('c_estatus','d_analisis.estatus_id','=','c_estatus.id')
                            ->leftjoin('d_calc_tiempos','d_analisis.id','=','d_calc_tiempos.folio_id')
                            ->orderByDesc('d_analisis.created_at')
                            ->SearchFolio($request->searchFolio)
                            ->SearchDistrito($request->searchDistrito)
                            ->SearchCluster($request->searchCluster)
                            ->SearchEstatus($request->searchEstatus)
                            ->SearchFecha($request->searchFechaIni,$request->searchFechaFin)
                            ->SearchTipoFolio($request->searchTipoFolio)
                            ->paginate(10);
                            
        }
        else
        {    
            return d_analisi::select('d_analisis.folio','c_tipo_folios.descripcion as tfolio_descripcion','c_distritos.descripcion as distrito_descripcion',
                            'd_analisis.estatus_id','c_clusters.descripcion as cluster_descripcion','c_estatus.descripcion as estatus_descripcion',
                            'd_analisis.created_at as fecha_crea','d_calc_tiempos.eta as eta','d_calc_tiempos.sla as sla',
                            'd_analisis.id as folio_id','c_tipo_folios.time_max as timeMax')
                    ->join('c_tipo_folios','d_analisis.tFolio_id','=','c_tipo_folios.id')
                    ->join('c_distritos','d_analisis.distrito_id','=','c_distritos.id')
                    ->join('c_clusters','d_analisis.cluster_id','=','c_clusters.id')
                    ->join('c_estatus','d_analisis.estatus_id','=','c_estatus.id')
                    ->join('d_calc_tiempos','d_analisis.id','=','d_calc_tiempos.folio_id')
                    ->join('c_despachos','c_despachos.id','d_analisis.despacho_id')
                    ->orderByDesc('d_analisis.created_at')
                    ->where('c_despachos.user_id','=',auth()->id())
                    ->SearchFolio($request->searchFolio)
                    ->SearchDistrito($request->searchDistrito)
                    ->SearchCluster($request->searchCluster)
                    ->SearchEstatus($request->searchEstatus)
                    ->SearchFecha($request->searchFechaIni,$request->searchFechaFin)
                    ->SearchTipoFolio($request->searchTipoFolio)->paginate(10);
        }
                
    }
    public function detalle($id){
        d_analisi::findOrFail($id);

        $estado_id = d_analisi::select('estatus_id')
                        ->where('d_analisis.id','=',$id)
                        ->first();


        if ($estado_id->estatus_id > 4 && $estado_id->estatus_id != 7) {
            return redirect('/consulta');
        }else{
            $analisis[0] = d_analisi::select('d_analisis.*','d_analisis.id as id_folio','d_calc_tiempos.*','d_pausados.*','d_ubicaciones.*')
                                ->leftJoin('d_calc_tiempos','d_calc_tiempos.folio_id','=','d_analisis.id')
                                ->leftJoin('d_pausados','d_pausados.folio_id','=','d_analisis.id')
                                ->leftJoin('d_ubicaciones','d_ubicaciones.folio_id','=','d_analisis.id')
                                ->where('d_analisis.id','=',$id)
                                ->get();

            $analisis[1] = d_analisi::select('d_imagenes.*')
                                      ->Join('d_imagenes','d_imagenes.folio_id','=','d_analisis.id')
                                      ->where('d_analisis.id','=',$id)
                                      ->get();
            $analisis[2] = d_analisi::select('d_materiales.*','c_materiales.tipo_material')
                                      ->join('d_materiales','d_materiales.folio_id','=','d_analisis.id')
                                      ->join('c_materiales','c_materiales.id','=','d_materiales.material_id')
                                      ->where('d_analisis.id','=',$id)
                                      ->get();
            $analisis[3] = d_analisi::select('d_seguimientos.*')
                                    ->join('d_seguimientos','d_seguimientos.folio_id','=','d_analisis.id')
                                    ->where('d_analisis.id','=',$id)
                                    ->get();
            $analisis[4] = d_analisi::select('d_conceptos.*')
                                    ->join('d_conceptos','d_conceptos.folio_id','d_analisis.id')
                                    ->where('d_analisis.id',$id)
                                    ->get();
            $analisis[5] = d_analisi::select('d_coo_daños.*')
                                    ->join('d_coo_daños','d_coo_daños.folio_id','d_analisis.id')
                                    ->where('d_analisis.id',$id)
                                    ->get();
            return view('folios.detalle',compact('analisis'));
        }

    }

    public function update(actualizarFormRequest $request)
    {
        $analisis = d_analisi::where('id', $request->id_folio)->first();
        if($analisis)
        {
            $analisis->folio                =   $request->folio;
            $analisis->tfolio_id            =   $request->tFolio;
            $analisis->turno_id             =   $request->turno;
            $analisis->distrito_id          =   $request->distrito_id;
            $analisis->cluster_id           =   $request->cluster;
            $analisis->falla_id             =   $request->falla;
            $analisis->causa_id             =   $request->cAfectacion;
            $analisis->clientes_afectados   =   $request->nClientes;
            $analisis->despacho_id          =   $request->despachoIos;
            $analisis->supervisor_id        =   $request->supervisorTTP;
            $analisis->tecnico_id           =   $request->tecnicoIos;
            $analisis->potencia_inicial     =   $request->poIni;
            $analisis->potencia_final       =   $request->poFin;
            $analisis->hora_medicion        =   $request->hraMedicion;
        if($request->olt){
            $analisis->olt                  =   $request->olt;
        }
        if($request->ot){
            $analisis->OT                   =   $request->ot;
        }
        

        if($request->llegadaFolio){
            $analisis->estatus_id           =   2;
            if($request->activacionFolio){
                $analisis->estatus_id       =   3;
            }
        } //Bloque de manejo de estatus

        //Manejo de Horas
        
            $calc_tiempos   =   d_calc_tiempo::where('folio_id',$analisis->id)->first();
            if($calc_tiempos){
                $calc_tiempos->asignacion_ios = $request->fechaIos;
                $calc_tiempos->llegada      =   $request->llegadaFolio;
                $calc_tiempos->eta          =   $request->hora_eta;
                $calc_tiempos->activacion   =   $request->activacionFolio;
                $calc_tiempos->sla          =   $request->hora_sla;
            }
            $calc_tiempos->save();
        
        //Fin Manejo de Horas

        //Control de Coordenadas
        if($request->latitud && $request->longitud){
            $ubicacion  =   d_ubicacione::where('folio_id',$analisis->id)->first();

            if($ubicacion){
                if ($request->latitud != 'null' && $request->longitud != 'null') {
                    $ubicacion->latitud     =      $request->latitud;
                    $ubicacion->longitud    =      $request->longitud;    
                }
            }
            else{
                $ubicacion              =       new d_ubicacione();
                $ubicacion->folio_id    =       $analisis->id;
                $ubicacion->latitud     =       $request->latitud;
                $ubicacion->longitud    =       $request->longitud;
                $ubicacion->estado_id   =       1;
            }
            $ubicacion->save();
        }
        //Fin Control de Coordenadas

        //Control de Materiales
        if($request->material){
            $array_num = count($request->material);
            
            for ($i = 0; $i < $array_num; ++$i)
            {
                $material   =   d_materiale::where('folio_id',$analisis->id)
                                        ->where('material_id',$request->material[$i])->first();
                if($material){
                    $material->cantidad = (int)$material->cantidad + (int)$request->material_can[$i];
                    $material->save();
                }
                elseif($request->material[$i] != 'sinMaterial'){
                    $material               =   new d_materiale();
                    $material->folio_id     =   $analisis->id;
                    $material->material_id  =   $request->material[$i];
                    $material->cantidad     =   $request->material_can[$i];
                    $material->estado_id    =   1;
                    
                    $material->save();
                }
            }
        }
        //Fin Control de Materiales
        
        //Control de Conceptos
        if($request->concepto){
            $array_num =    count($request->concepto);
            for($i = 0;$i < $array_num;$i++) {
                $concepto   =   d_concepto::where('folio_id',$analisis->id)
                                          ->where('concepto_id',$request->concepto[$i])->first();
                if($concepto){
                    $concepto->cantidad     =   (int)$concepto->cantidad + (int)$request->concepto_cant[$i];
                }
                else{
                    $concepto               =   new d_concepto();
                    $concepto->folio_id     =   $analisis->id;
                    $concepto->concepto_id  =   $request->concepto[$i];
                    $concepto->cantidad     =   $request->concepto_cant[$i];
                    $concepto->estado_id    =   1;
                }
                $concepto->save();
            }   
        }
        //Fin de Control de Conceptos

        //Control de Observaciones
        if($request->tracing){
            $array_num  =   count($request->tracing);
            for($i = 0;$i < $array_num;$i++){
                $seguimiento                =   new d_seguimiento();
                $seguimiento->folio_id      =   $analisis->id;  
                $seguimiento->observacion   =   $request->tracing[$i];
                $seguimiento->estado_id     =   1;
                $seguimiento->save();
            }
        }
        //Fin Control de Observaciones

        //Control de Folio Pausado
        $pausa  =   d_pausado::where('folio_id',$analisis->id)->first();
        
        if($pausa && !$request->fPausado){
            $pausa->delete();
        }
        if($pausa && $request->fPausado){
            $pausa->justificacion_id    =   $request->fPausado;
            $pausa->tiempo_muerto       =   $request->tiempoMuerto;
            $pausa->save();
        }
        if(!$pausa && $request->fPausado){
            $pausa                      =   new d_pausado();
            $pausa->folio_id            =   $analisis->id;
            $pausa->justificacion_id    =   $request->fPausado;
            $pausa->tiempo_muerto       =   $request->tiempoMuerto;
            $pausa->estado_id           =   1;
            $pausa->save();
        }
        //Fin Control de Folio Pausado

        //Control Cab24
        if($request->cab24){
            $array_num = count($request->cab24);
            for ($i = 0; $i < $array_num; ++$i){
                $cab24 = new d_coo_daño;
                $cab24->folio_id    =   $analisis->id;
                $cab24->coordenadas =   $request->cab24[$i];
                $cab24->save();
            }
        }
        //Fin Control Cab24

        //Control Imagenes (Preventivo)
        imagenes($request,$analisis->id);
        //Fin Control Imagenes

        $analisis->save();
        
        activity()->useLog('update')
                      ->withProperties(['folio' => $analisis->folio])        
                      ->log('actualiza folio'); //Registrar Actividad
        
        $usuario=c_despacho::select('user_id')
                      ->where('id',$analisis->despacho_id)
                      ->get();
            
        //Enviar notificación (Pusher)
        if(auth()->user()->hasRole('tecnico') && ($request->activacionFolio == '' || $request->activacionFolio == null )){
          event(new UpdateTecnicoEvent($analisis,$usuario[0]->user_id,'Se ha actualizado el folio'));
        }
        if(auth()->user()->hasRole('tecnico') && $request->activacionFolio != ''){
          event(new UpdateTecnicoEvent($analisis,$usuario[0]->user_id,'El tecnico ha cerrado el folio'));
        } 

        }
    }
    public function finalizarFolio(finalizarFormRequest $request){
        $analisis = d_analisi::where('folio', $request->folio)
                             ->orWhere('id', $request->id_folio) 
                             ->first();
        
         if(!$analisis){
            $analisis=new d_analisi;
                $analisis->folio                = $request->folio;
                $analisis->tfolio_id            = $request->tFolio;
                $analisis->turno_id             = $request->turno;
                $analisis->distrito_id          = $request->distrito_id;
                $analisis->cluster_id           = $request->cluster;
                $analisis->user_id              = auth()->id();
                $analisis->falla_id             = $request->falla;
                $analisis->potencia_inicial     = $request->poIni;
                $analisis->potencia_final       = $request->poFin;
                $analisis->hora_medicion        = $request->hraMedicion;
                $analisis->causa_id             = $request->cAfectacion;
                $analisis->clientes_afectados   = $request->nClientes;
                $analisis->despacho_id          = $request->despachoIos;
                if($request->ot){
                    $analisis->OT                   =   $request->ot;
                }
                $analisis->supervisor_id        = $request->supervisorTTP;
                $analisis->tecnico_id           = $request->tecnicoIos;
                $analisis->tipo_folio           = 2; 
                if($request->olt){
                    $analisis->olt                  =   $request->olt;
                }
                $analisis->estatus_id           = 5;
                $analisis->save();
         }
         else{
        $analisis->folio                =   $request->folio;
        $analisis->tfolio_id            =   $request->tFolio;
        $analisis->turno_id             =   $request->turno;
        $analisis->distrito_id          =   $request->distrito_id;
        $analisis->cluster_id           =   $request->cluster;
        $analisis->falla_id             =   $request->falla;
        $analisis->causa_id             =   $request->cAfectacion;
        $analisis->potencia_inicial     =   $request->poIni;
        $analisis->potencia_final       =   $request->poFin;
        $analisis->hora_medicion        =   $request->hraMedicion;
        $analisis->clientes_afectados   =   $request->nClientes;
        $analisis->despacho_id          =   $request->despachoIos;
        $analisis->supervisor_id        =   $request->supervisorTTP;
        $analisis->tecnico_id           =   $request->tecnicoIos;
        $analisis->estatus_id           =   5;
        if($request->olt){
            $analisis->olt                  =   $request->olt;
        }
        if($request->ot){
            $analisis->OT                   =   $request->ot;
        }
        $analisis->save();
         }

        if($request->latitud  && $request->longitud)
        { 
            $ubicacion = d_ubicacione::where('folio_id','=',$analisis->id)->first();
            if($ubicacion == null   || $ubicacion == ''){
                $ubicacionCrea = new d_ubicacione();
                $ubicacionCrea->folio_id    =   $analisis->id;
                $ubicacionCrea->latitud = $request->latitud;
                $ubicacionCrea->longitud = $request->longitud;
                $ubicacionCrea->estado_id = 1;
                $ubicacionCrea->save();
            }
            else{
            $ubicacion->latitud = $request->latitud;
            $ubicacion->longitud = $request->longitud;
            $ubicacion->estado_id = 1;
            $ubicacion->save();
            }
        }
        
    $calc_tiempos = d_calc_tiempo::where('folio_id','=',$analisis->id)->first();
     if($calc_tiempos == null || $calc_tiempos == ''){
        $calctiempo=new d_calc_tiempo;
        $calctiempo->folio_id = $analisis->id;
        $calctiempo->asignacion_ios = $request->fechaIos;
        $calctiempo->llegada = $request->llegadaFolio;
        $calctiempo->activacion = $request->activacionFolio;
        $calctiempo->eta = $request->hora_eta;
        $calctiempo->sla = $request->hora_sla;
        $calctiempo->estado_id = 1;
        $calctiempo->save();
     }
     else
     {
        $calc_tiempos->llegada          =   $request->llegadaFolio;
        $calc_tiempos->activacion       =   $request->activacionFolio;
        $calc_tiempos->eta              =   $request->hora_eta;
        $calc_tiempos->sla              =   $request->hora_sla;
        $calc_tiempos->save();
     }

    $pausa = d_pausado::where('folio_id','=',$analisis->id)->first();

        if($pausa != null && $request->fPausado == '')
        {
            $pausa->delete();
        }
        if($pausa == null && $request->fPausado != '')
        {
            $folioPausado = new d_pausado;
            $folioPausado->folio_id         = $analisis->id;
            $folioPausado->justificacion_id = $request->fPausado;
            $folioPausado->tiempo_muerto    = $request->tiempoMuerto;
            $folioPausado->estado_id        = 1;
            $folioPausado->save();
        }
        if($pausa != null && $request->fPausado != '')
        {
            $pausa->justificacion_id    =   $request->fPausado;
            $pausa->tiempo_muerto       =   $request->tiempoMuerto;
            $pausa->save();
        }
        if($request->cab24 != null || $request->cab24 != ''){
            $array_num = count($request->cab24);
            for ($i = 0; $i < $array_num; ++$i){
                $cab24 = new d_coo_daño;
                $cab24->folio_id    =   $analisis->id;
                $cab24->coordenadas =   $request->cab24[$i];
                $cab24->save();
            }
        }
        if($request->material != null || $request->material != '')
        {
            $array_num = count($request->material);
            for ($i = 0; $i < $array_num; ++$i){
               $material=d_materiale::where('folio_id','=',$analisis->id)
                                    ->where('material_id','=',$request->material[$i])
                                    ->first();
                if($material!=null || $material!=''){
                    $material->cantidad = (int)$material->cantidad + (int)$request->material_can[$i];
                    $material->save();
                }
                if(($material==null || $material!='') && $request->material[$i] != 'sinMaterial')
                {
                    $material_crea = new d_materiale();
                    $material_crea->folio_id = $analisis->id;
                    $material_crea->material_id = $request->material[$i];
                    $material_crea->cantidad    = $request->material_can[$i];
                    $material_crea->estado_id   = 1;
                    $material_crea->save();
                }
            }
    }
    if($request->tracing != null || $request->tracing !='')
    {
        $array_tracing = count($request->tracing);
        for($i = 0; $i < $array_tracing; ++$i){
            $seguimiento    =   new d_seguimiento();
            $seguimiento->folio_id    =   $analisis->id;
            $seguimiento->observacion =   $request->tracing[$i];
            $seguimiento->estado_id   =   1;
            $seguimiento->save();
        }
    }
    if($request->concepto != null || $request->concepto !=''){
        $array_concepto = count($request->concepto);
        for($i = 0; $i < $array_concepto; ++$i){
            $concepto=d_concepto::where('folio_id','=',$analisis->id)
                                    ->where('concepto_id','=',$request->concepto[$i])
                                    ->first();
        if($concepto!=null || $concepto!=''){
            $concepto->cantidad = (int)$concepto->cantidad + (int)$request->concepto_cant[$i];
            $concepto->save();
        }       
        if($concepto==null || $concepto==''){
            $concepto_crea = new d_concepto();
            $concepto_crea->folio_id    =   $analisis->id;
            $concepto_crea->concepto_id =   $request->concepto[$i];
            $concepto_crea->cantidad    =   $request->concepto_cant[$i];
            $concepto_crea->estado_id   =   1;
            $concepto_crea->save();
        }
        }
    }


    //---------------------------------------------------------------//

    //    ALMACENAMIENTO DE MATERIALES EN LA TABLA apoyo_materiale   //

    //---------------------------------------------------------------//




    // for ($i = 0; $i < count($request->material); ++$i)
    // {
    //     $material   =   apoyo_materiale::where('folio_id',2)
    //                                     ->where('material_id',$request->material[$i])->first();
    //     if($material){
    //         $material->cantidad = (int)$material->cantidad + (int)$request->material_can[$i];
    //     }
    //     else{
    //         $material               =   new apoyo_materiale();
    //         $material->folio_id     =   $analisis->id;
    //         $material->material_id  =   $request->material[$i];
    //         $material->cantidad     =   $request->material_can[$i];
    //         $material->estado_id    =   1;
    //     }
    //     $material->save();
    // }


    imagenes($request,$analisis->id);

        if($analisis->tipo_folio == 1){
             $this->enviarScript($analisis->id, 1);
        }
        activity()->useLog('finalize')
                  ->withProperties(['folio' => $analisis->folio])
                  ->log('finaliza folio');
                  
        return $analisis;

    }
    public function folioTecnico()
    {
        if(auth()->user()->hasRole(['tecnico','administrador'])){
            $tecnico = d_analisi::select('d_analisis.id')
                                  ->join('c_tecnicos','c_tecnicos.id','=','d_analisis.tecnico_id')
                                  ->where('c_tecnicos.user_id',auth()->id())
                                  ->where('d_analisis.estatus_id','>=',1)
                                  ->where('d_analisis.estatus_id','<=',2)
                                  ->where('d_analisis.tipo_folio',1)
                                  ->first();
            if($tecnico != '')
            {
                $analisis[0] = d_analisi::select('d_analisis.*','d_analisis.id as id_folio','d_calc_tiempos.*','d_pausados.*','d_ubicaciones.*')
                ->leftJoin('d_calc_tiempos','d_calc_tiempos.folio_id','=','d_analisis.id')
                ->leftJoin('d_pausados','d_pausados.folio_id','=','d_analisis.id')
                ->leftJoin('d_ubicaciones','d_ubicaciones.folio_id','=','d_analisis.id')
                ->where('d_analisis.id','=',$tecnico->id)
                ->get();

                $analisis[1] = d_analisi::select('d_imagenes.*')
                                        ->Join('d_imagenes','d_imagenes.folio_id','=','d_analisis.id')
                                        ->where('d_analisis.id','=',$tecnico->id)
                                        ->get();
                $analisis[2] = d_analisi::select('d_materiales.*','c_materiales.tipo_material')
                                        ->join('d_materiales','d_materiales.folio_id','=','d_analisis.id')
                                        ->join('c_materiales','c_materiales.id','=','d_materiales.material_id')
                                        ->where('d_analisis.id','=',$tecnico->id)
                                        ->get();
                $analisis[3] = d_analisi::select('d_seguimientos.*')
                                        ->join('d_seguimientos','d_seguimientos.folio_id','=','d_analisis.id')
                                        ->where('d_analisis.id','=',$tecnico->id)
                                        ->get();
                $analisis[4] = d_analisi::select('d_conceptos.*')
                                        ->join('d_conceptos','d_conceptos.folio_id','d_analisis.id')
                                        ->where('d_analisis.id',$tecnico->id)
                                        ->get();
                $analisis[5] = d_analisi::select('d_coo_daños.*')
                                        ->join('d_coo_daños','d_coo_daños.folio_id','d_analisis.id')
                                        ->where('d_analisis.id',$tecnico->id)
                                        ->get();
                return view('informacion.tecnico',compact('analisis'));
            } 
            return view('informacion.tecnico504');
        
        }
        abort(403);
    }

    public function actualizarEstatus(Request $request){
        if($request->ajax()){
            $id_folio = $request->folio_id;
            $nuevo_estado = $request->estatus_id;
            $response = d_analisi::where('id',$id_folio)->first();
             $response->estatus_id = $nuevo_estado;
             $response->save();
        }
        $valor = $response->wasChanged(); // true
        return $valor;        
    }
}

function imagenes($request,$id){
    if($request->hasFile('imagen_antes'))
    {
        $url = $request->imagen_antes->store('imagenes');
        d_imagene::create([
            'folio_id' => $id,
            'url' => $url,
            'timagen_id' =>1,
            'uuid' => (string) Str::uuid(),
            'estado_id' => 1
        ]);
        }

    if($request->hasFile('imagen_durante'))
    {
        $url = $request->imagen_durante->store('imagenes');
        d_imagene::create([
            'folio_id' => $id,
            'url' => $url,
            'timagen_id' =>2,
            'uuid' => (string) Str::uuid(),
            'estado_id' => 1
        ]);
    }
    if($request->hasFile('imagen_despues'))
    {
        $url = $request->imagen_despues->store('imagenes');
        d_imagene::create([
            'folio_id' => $id,
            'url' => $url,
            'timagen_id' =>3,
            'uuid' => (string) Str::uuid(),
            'estado_id' => 1
        ]);
    }     
}
