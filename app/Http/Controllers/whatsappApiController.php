<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\myTrait;
use App\Models\d_analisi;
use App\Models\d_calc_tiempo;
use App\Models\d_pausado;
use App\Models\d_materiale;
use App\Models\d_imagene;
use App\Models\d_ubicacione;
use App\Models\d_seguimiento;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Html;

class whatsappApiController extends Controller
{
   use myTrait;
    function enviarScriptController($id){
      
        return $this->enviarScript($id, 1);
    }

    function copiarScriptController($id){
    	return $this->enviarScript($id, 2);
    }
}
