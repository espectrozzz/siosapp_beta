<?php

namespace App\Http\Controllers;

use App\Events\TecnicoEvent;
use App\Http\Requests\PreventivoFormRequest;
use App\Http\Requests\CorrectivoFormRequest;
use App\Models\c_tecnico;
use App\Models\d_analisi;
use App\Models\d_calc_tiempo;
use App\Models\d_imagene;
use App\Models\d_materiale;
use App\Models\d_concepto;
use App\Models\d_coo_daño;
use App\Models\d_pausado;
use App\Models\d_seguimiento;
use App\Models\d_ubicacione;
use Illuminate\Support\Str;

class InformacionController extends Controller
{
    public function envio_correctivo(CorrectivoFormRequest $request){
      
        $analisis=new d_analisi;
        $analisis->folio = $request->folio;
        $analisis->tfolio_id = $request->tFolio;
        $analisis->turno_id = $request->turno;
        $analisis->distrito_id = $request->distrito_id;
        $analisis->cluster_id = $request->cluster;
        $analisis->user_id = auth()->id();
        $analisis->falla_id = $request->falla;
        $analisis->causa_id = $request->cAfectacion;
        $analisis->clientes_afectados = $request->nClientes;
        $analisis->despacho_id = $request->despachoIos;
        $analisis->supervisor_id = $request->supervisorTTP;
        $analisis->tecnico_id = $request->tecnicoIos;
        $analisis->potencia_inicial     =   $request->poIni;
        $analisis->potencia_final       =   $request->poFin;
        $analisis->hora_medicion        =   $request->hraMedicion;
        if($request->olt != null || $request->olt != ''){
            $analisis->olt                  =   $request->olt;
        }
        if($request->ot){
            $analisis->OT                   =   $request->ot;
        }
        if($request->hora_eta == null || $request->hora_eta == ''){
            $analisis->estatus_id = 1;
        }
        if($request->hora_eta != null || $request->hora_eta != ''){
            $analisis->estatus_id = 2;
        }
        if($request->hora_sla != null || $request->hora_sla != ''){
            $analisis->estatus_id = 4;
        }
        $analisis->tipo_folio = 1;
        $analisis->save();

        $folioid = $analisis->id;

        $calctiempo=new d_calc_tiempo;
        $calctiempo->folio_id = $folioid;
        $calctiempo->asignacion_ios = $request->fechaIos;
        $calctiempo->llegada = $request->llegadaFolio;
        $calctiempo->activacion = $request->activacionFolio;
        $calctiempo->eta = $request->hora_eta;
        $calctiempo->sla = $request->hora_sla;
        $calctiempo->estado_id = 1;
        $calctiempo->save();

        if($request->fPausado != null || $request->fPausado != '')
            {
                $folioPausado = new d_pausado;
                $folioPausado->folio_id = $folioid;
                $folioPausado->justificacion_id = $request->fPausado;
                $folioPausado->tiempo_muerto = $request->tiempoMuerto;
                $folioPausado->estado_id = 1;
                $folioPausado->save();
            }
            if($request->cab24 != null || $request->cab24 != ''){
                $array_num = count($request->cab24);
                for ($i = 0; $i < $array_num; ++$i){
                    $cab24 = new d_coo_daño;
                    $cab24->folio_id    =   $folioid;
                    $cab24->coordenadas =   $request->cab24[$i];
                    $cab24->save();
                }
            }
        
     if($request->latitud != '' && $request->longitud != '')
            { 
                $ubicacion = new d_ubicacione;
                $ubicacion->folio_id = $folioid;
                $ubicacion->latitud = $request->latitud;
                $ubicacion->longitud = $request->longitud;
                $ubicacion->estado_id = 1;
                $ubicacion->save();
            }

        if($request->material != null || $request->material != ''){
        $array_material = count($request->material);
        for ($i = 0; $i < $array_material; ++$i){
           if($request->material[$i]!='sinMaterial'){
            d_materiale::create([
                'folio_id' => $folioid,
                'material_id' => $request->material[$i],
                'cantidad' => $request->material_can[$i],
                'estado_id' => 1,
                ]);
            }
        }
    }
    if($request->tracing != null || $request->tracing !=''){
        $array_tracing = count($request->tracing);
        for($i = 0; $i < $array_tracing; ++$i){
            d_seguimiento::create([
                'folio_id' => $folioid,
                'observacion' => $request->tracing[$i],
                'estado_id' => 1
            ]);
        }
    }
    if($request->concepto != null || $request->concepto !=''){
        $array_concepto = count($request->concepto);
        for($i = 0; $i < $array_concepto; ++$i){
            $concepto=d_concepto::where('folio_id','=',$folioid)
                                    ->where('concepto_id','=',$request->concepto[$i])
                                    ->first();
        if($concepto!=null || $concepto!=''){
            $concepto->cantidad = (int)$concepto->cantidad + (int)$request->concepto_cant[$i];
            $concepto->save();
        }       
        if($concepto==null || $concepto==''){
            $concepto_crea = new d_concepto();
            $concepto_crea->folio_id    =   $folioid;
            $concepto_crea->concepto_id =   $request->concepto[$i];
            $concepto_crea->cantidad    =   $request->concepto_cant[$i];
            $concepto_crea->estado_id   =   1;
            $concepto_crea->save();
        }
        }
    }
    //return redirect('/home');
    $usuario=c_tecnico::select('user_id')
                      ->where('id',$analisis->tecnico_id)
                      ->get();

    //$analisis->usuario = $tecnico[0]->user_id;
    event(new TecnicoEvent($analisis,$usuario[0]->user_id));
    //auth()->user()->notify(new tecnicoNotification($analisis));
    activity()->useLog('create')
              ->withProperties(['folio' => $analisis->folio])
              ->log('crea folio correctivo');
              
    return $request;
    }

    public function envio_preventivo(PreventivoFormRequest $request){
        $analisis=new d_analisi;
        $analisis->folio = $request->folio;
        $analisis->tfolio_id = $request->tFolio;
        $analisis->turno_id = $request->turno;
        $analisis->distrito_id = $request->distrito_id;
        $analisis->cluster_id = $request->cluster;
        $analisis->user_id = auth()->id();
        $analisis->falla_id = $request->falla;
        $analisis->potencia_inicial     =   $request->poIni;
        $analisis->potencia_final       =   $request->poFin;
        $analisis->hora_medicion        =   $request->hraMedicion;
        $analisis->causa_id = $request->cAfectacion;
        $analisis->clientes_afectados = $request->nClientes;
        $analisis->despacho_id = $request->despachoIos;
        $analisis->supervisor_id = $request->supervisorTTP;
        $analisis->tecnico_id = $request->tecnicoIos;
        $analisis->estatus_id = 1;
        $analisis->tipo_folio = 2;
        if($request->olt != null || $request->olt != ''){
            $analisis->olt                  =   $request->olt;
        }
        if($request->ot){
            $analisis->OT                   =   $request->ot;
        }
        if($request->hora_eta == null || $request->hora_eta == ''){
            $analisis->estatus_id = 1;
        }
        if($request->hora_eta != null || $request->hora_eta != ''){
            $analisis->estatus_id = 2;
        }
        if($request->hora_sla != null || $request->hora_sla != ''){
            $analisis->estatus_id = 4;
        }
        $analisis->save();

        $folioid = $analisis->id;

        $calctiempo=new d_calc_tiempo;
        $calctiempo->folio_id = $folioid;
        $calctiempo->asignacion_ios = $request->fechaIos;
        $calctiempo->llegada = $request->llegadaFolio;
        $calctiempo->activacion = $request->activacionFolio;
        $calctiempo->eta = $request->hora_eta;
        $calctiempo->sla = $request->hora_sla;
        $calctiempo->estado_id = 1;
        $calctiempo->save();

        if($request->fPausado != null || $request->fPausado != '')
        {
            $folioPausado = new d_pausado;
            $folioPausado->folio_id = $folioid;
            $folioPausado->justificacion_id = $request->fPausado;
            $folioPausado->tiempo_muerto = $request->tiempoMuerto;
            $folioPausado->estado_id = 1;
            $folioPausado->save();
        }
        if($request->cab24 != null || $request->cab24 != ''){
            $array_num = count($request->cab24);
            for ($i = 0; $i < $array_num; ++$i){
                $cab24 = new d_coo_daño;
                $cab24->folio_id    =   $folioid;
                $cab24->coordenadas =   $request->cab24[$i];
                $cab24->save();
            }
        }
    
    if($request->latitud != '' && $request->longitud != '')
        { 
            $ubicacion = new d_ubicacione;
            $ubicacion->folio_id = $folioid;
            $ubicacion->latitud = $request->latitud;
            $ubicacion->longitud = $request->longitud;
            $ubicacion->estado_id = 1;
            $ubicacion->save();
        }


        if($request->material != null || $request->material != ''){
                $array_num = count($request->material);
                for ($i = 0; $i < $array_num; ++$i){
                    if($request->material[$i]!='sinMaterial'){
                    d_materiale::create([
                        'folio_id' => $folioid,
                        'material_id' => $request->material[$i],
                        'cantidad' => $request->material_can[$i],
                        'estado_id' => 1,
                        ]);
                    }
                }
        }
     
        if($request->hasFile('imagen_antes')){
            // $image = Image::make($request->imagen_antes);
            // $image->resize(400, 200, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });

            $url = $request->file('imagen_antes')->store('imagenes', 20);

            // return $request->file('imagen_antes');

            d_imagene::create([
                'folio_id' => $folioid,
                'url' => $url,
                'timagen_id' =>1,
                'uuid' => (string) Str::uuid(),
                'estado_id' => 1
            ]);
            }

        if($request->hasFile('imagen_durante')){
            // $image = Image::make($request->imagen_durante);
            // $image->resize(400, 200, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });

            $url = $request->imagen_durante->store('imagenes', 20);

            // return $request->file('imagen_durante');

            d_imagene::create([
                'folio_id' => $folioid,
                'url' => $url,
                'timagen_id' =>2,
                'uuid' => (string) Str::uuid(),
                'estado_id' => 1
            ]);
        }
        if($request->hasFile('imagen_despues')){
            // $image = Image::make($request->imagen_despues);
            // $image->resize(400, 200, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });
            // var_dump($request->imagen_despues)
            // $url = $image->store('imagenes', 20);
            $url = $request->imagen_despues->store('imagenes', 20);
            // $url = $request->imagen_despues->save('/imagenes');

            // return $request->file('imagen_despues');

            // $fileName = collect(explode('/', $path))->last();
            // $image = Image::make(Storage::get($path));
            // $image->resize(1280, null, function ($constraint) {
            //   $constraint->aspectRatio();
            //   $constraint->upsize();
            // });

            // $img->save('public/bar.jpg', 60);

            d_imagene::create([
                'folio_id' => $folioid,
                'url' => $url,
                'timagen_id' =>3,
                'uuid' => (string) Str::uuid(),
                'estado_id' => 1
            ]);
        }
        if($request->tracing != null || $request->tracing !=''){
            $array_tracing = count($request->tracing);
            for($i = 0; $i < $array_tracing; ++$i){
               if($request->tracing[$i] != ''){
                d_seguimiento::create([
                    'folio_id' => $folioid,
                    'observacion' => $request->tracing[$i],
                    'estado_id' => 1
                ]);
            }
            }
        }
        if($request->concepto != null || $request->concepto !=''){
            $array_concepto = count($request->concepto);
            for($i = 0; $i < $array_concepto; ++$i){
                $concepto    =   new d_concepto();
                $concepto->folio_id    =   $request->id_folio;
                $concepto->concepto_id =   $request->concepto[$i];
                $concepto->cantidad    =   $request->concepto_cant[$i];
                $concepto->estado_id   =   1;
                $concepto->save();
            }
        }
        activity()->useLog('create')
                  ->withProperties(['folio' => $analisis->folio])
                  ->log('crea folio preventivo');
                  
        return $request->all();     
    }   
}
