<?php
namespace App\Http\Traits;
use App\Models\d_concepto;
use App\Models\d_pausado;
use App\Models\d_materiale;
use App\Models\d_imagene;
use App\Models\d_ubicacione;
use App\Models\d_seguimiento;
use App\Models\d_analisi;
use App\Models\d_calc_tiempo;
use App\Models\d_coo_daño;

trait myTrait{
function enviarScript($id, $peticion){
    $analisis = d_analisi::findOrFail($id);

    $consulta = d_analisi::select('d_analisis.folio','c_tipo_folios.descripcion as tfolio','d_analisis.ot','c_distritos.descripcion as distrito',
    'c_clusters.descripcion as cluster','d_analisis.olt','d_analisis.clientes_afectados as nCliente',
    'c_fallas.descripcion as falla','d_calc_tiempos.asignacion_ios as fechaIos','d_calc_tiempos.llegada',
    'd_ubicaciones.latitud','d_ubicaciones.longitud','c_causas.descripcion as causa','d_analisis.id',
    'd_calc_tiempos.activacion','c_tecnicos.nombre as tecnico','c_supervisors.nombre as supervisor',
    'c_despacho_ttps.nombre as despachottp','c_supervisor_ttps.nombre as supervisorttp')
->join('c_tipo_folios','c_tipo_folios.id','d_analisis.tfolio_id')
->join('c_distritos','c_distritos.id','d_analisis.distrito_id')
->join('c_clusters','c_clusters.id','d_analisis.cluster_id')
->join('c_fallas','c_fallas.id','d_analisis.falla_id')
->join('d_calc_tiempos','d_calc_tiempos.folio_id','d_analisis.id')
->join('d_ubicaciones','d_ubicaciones.folio_id','d_analisis.id')
->join('c_causas','c_causas.id','d_analisis.causa_id')
->join('c_tecnicos','c_tecnicos.id','d_analisis.tecnico_id')
->join('c_supervisors','c_supervisors.id','d_analisis.supervisor_id')
->join('c_despacho_ttps','c_despacho_ttps.distrito_id','d_analisis.distrito_id')
->join('c_supervisor_ttps','c_supervisor_ttps.distrito_id','d_analisis.distrito_id')
->where('d_analisis.id',$id)->get();

$calc_tiempos = d_calc_tiempo::where('folio_id','=',$id)->first();

$ubicacion = d_ubicacione::where('folio_id','=',$id)->first();

$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$ubicacion->latitud.','.$ubicacion->longitud.'&location_type=ROOFTOP&result_type=street_address&key=AIzaSyDbzmEj008dR-rZYg_qLSP7M9rxBE-97jg';
$bddUbicacion = d_ubicacione::where('folio_id',$id)->first();
$direccion = curl_get_file_contents($url,null);
$bddUbicacion->ubicacion = $direccion;

$bddUbicacion->save();

    //Cuerpo de mensaje
            $mensaje = '*FOLIO*:' . $analisis->folio . "\n".
            //  '*OT*: '. $consulta[0]->ot . "\n".
            $consulta[0]->tfolio . "\n".
            '*Distrito*: '. $consulta[0]->distrito. "\n".
            '*Cluster*: '. $consulta[0]->cluster . "\n".
            '*OLT*: '. $analisis->olt . "\n".
            '*Clientes Afectados*: '. $analisis->clientes_afectados . "\n".
            '*Falla Reportada*: '. $consulta[0]->falla . "\n".
            '*FECHA_Y_HR_DE_ASG_DESP*: ' .  $calc_tiempos->asignacion_ios . "\n".
            '*FECHA_Y_HR_DE_ASG_PROV*: ' .  $calc_tiempos->asignacion_ios . "\n".
            '*HR_DE_LLEGADA_A_LA_ZONA*: ' .  $calc_tiempos->llegada . "\n".
            '*HR_DE_LA_1er_MEDICION*: '. $analisis->hora_medicion . "\n".
            '*UBICACIÓN_DE_1er_,_2do_NIVEL_Y_DERIVACION_CON_SU*: '. "\n".
            '*CAUSA DEL DAÑO*: '. $consulta[0]->causa . "\n".
            '*UBICACIÓN DEL DAÑO*:'. $direccion ."\n".
            '*COORDENADAS_DEL_DAÑO*: '.  $ubicacion->latitud.",". $ubicacion->longitud . "\n".
            '*DESCRIP_DE_ACTIVIDADES*: '. "\n";
            $actividades = d_analisi::select('d_seguimientos.observacion')
            ->join('d_seguimientos','d_seguimientos.folio_id','d_analisis.id')
            ->where('d_seguimientos.folio_id',$consulta[0]->id)
            ->get();
            $materiales = d_analisi::select('c_materiales.descripcion as material','d_materiales.cantidad')
            ->join('d_materiales','d_materiales.folio_id','d_analisis.id')
            ->join('c_materiales','c_materiales.id','d_materiales.material_id')
            ->where('d_materiales.folio_id',$consulta[0]->id)
            ->get();
            $concepto = d_concepto::select('c_conceptos.concepto as concepto','d_conceptos.cantidad as cantidad')
                                  ->join('c_conceptos','c_conceptos.id','d_conceptos.concepto_id')
                                  ->where('d_conceptos.folio_id',$consulta[0]->id)
                                  ->get();
            $cab24 = d_coo_daño::select('d_coo_daños.coordenadas')
                                  ->where('d_coo_daños.folio_id',$consulta[0]->id)
                                  ->get();
            foreach($actividades as $valor){
            $mensaje = $mensaje.$valor->observacion."\n"; 
            }
            $mensaje = $mensaje. '*POTENCIA INICIAL*: '. $analisis->potencia_inicial . "\n".
            '*POTENCIA FINAL*: '. $analisis->potencia_final. "\n".
            '*TRABAJOS_REALIZADOS (CONCEPTOS)*: '. "\n";
            foreach($concepto as $valor){
                $mensaje = $mensaje.$valor->cantidad."-".$valor->concepto."\n"; 
                }
               
            $mensaje=$mensaje.'*COORDENADAS_DEL CAB_24*: '. "\n";
            foreach($cab24 as $valor){
                $mensaje = $mensaje.$valor->coordenadas."\n";
            }

            $mensaje=$mensaje.'*MATERIALES UTILIZADOS*: '. "\n";
            foreach($materiales as $valor){
            $mensaje = $mensaje.$valor->cantidad."-".$valor->material."\n"; 
            }
            $mensaje = $mensaje. '*FECHA_HR_FINAL_DE_ REPARACION*: '. $consulta[0]->activacion. "\n".
            '*ATIENDE_NOM_TEC*: '. $consulta[0]->tecnico. "\n".
            '*PROVEEDOR*:iOS'. "\n".
            '*SUPERVISOR*: '. $consulta[0]->supervisorttp. "\n".
            '*ATENDIO_DESP*: '. $consulta[0]->despachottp. "\n".
            '*JUSTIFICACIÓN DEL SLA*: ';
    if ($peticion == 1) {
            $token = 'bkpfz0iwcv75iy24';
            $instanceId = '257923';
            $url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;

            $grupos=["5215519544903-1618948843@g.us","5215530183957-1612547719@g.us"];
         $i = 0;
         foreach($grupos as $valor){
                $data = [
                'body' => $mensaje, // Mensaje
                "chatId" => $grupos[$i] //Grupo o Grupos a enviar
            ];
            $json = json_encode($data);
            //Envío Request POST
          curl_get_file_contents($url,$json);
          $i++;
        }
        return "Mensaje Enviado";
    }
    else{
        return $mensaje;
    }
}

}
 function curl_get_file_contents($URL,$options)
{
    $c = curl_init($URL);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_POSTFIELDS, $options);
    curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    $contents =  curl_exec($c);
    $json = json_decode($contents);
    curl_close($c);

    if ($contents && !$options){
        if($json->results)
        return $json->results[0]->{'formatted_address'};
        else
        return "No se encontró ubicación";
    }
    if ($contents && $options) return $contents;
    else return FALSE;
}
