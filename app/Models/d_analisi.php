<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class d_analisi extends Model
{
    use HasFactory;

    public function scopeSearchFolio($query,$folio)
    {
        if($folio)
        {
            return $query->where('folio',"LIKE","%$folio%");
        }
    }
    public function scopeSearchDistrito($query,$distrito){
        if($distrito){
            return $query->where('d_analisis.distrito_id',$distrito);
        }
    }
    public function scopeSearchCluster($query,$cluster){
        if($cluster){
            return $query->where('d_analisis.cluster_id',$cluster);
        }
    }
    public function scopeSearchEstatus($query,$estatus){
        if($estatus){
            return $query->where('d_analisis.estatus_id',$estatus);
        }
    }
    public function scopeSearchFecha($query,$fechaIni,$fechaFin){
        if($fechaIni){
                 $query->where('d_analisis.created_at','>=',"$fechaIni");
        }
        if($fechaFin){
                 $query->where('d_analisis.created_at','<=',"$fechaFin");
        }
            return $query;            
        }
    public function scopeSearchTipoFolio($query,$tipoFolio){
        if($tipoFolio){
            return $query->where('d_analisis.tipo_folio',$tipoFolio);
        }
    }

    public function scopeFiltrarTipoFolio($query,$tipoFolio){
        if($tipoFolio){
            if ($tipoFolio != 0) {
                return $query->where('d_analisis.tipo_folio',$tipoFolio);
            }
        }
    }

    public function scopeFiltrarDistrito($query,$distritos){
        if($distritos){
            $count = 0;
            foreach ($distritos as $distrito) {
                if ($count == 0) {
                    $query->where('d_analisis.distrito_id', $distrito);
                }
                else{
                    $query->orWhere('d_analisis.distrito_id', $distrito);
                }
                $count++;
            }
            return $query;

        }
    }

    public function scopeFiltrarFecha($query,$fechas){
        if($fechas->fechaIni != NULL && $fechas->fechaFin != NULL){
            // WHERE DATE_FORMAT(activacion,"%d-%m-%y") BETWEEN'06-04-2021' AND '15-04-2021'
            return $query->whereRaw("DATE_FORMAT(d_calc_tiempos.activacion,'%Y-%m-%d') BETWEEN '".$fechas->fechaIni."' AND '". $fechas->fechaFin."'");
        }else{

            return $query->whereRaw("MONTH(d_calc_tiempos.activacion) = '".date("m")."'"); 
        }
    }
}


