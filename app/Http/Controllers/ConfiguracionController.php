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

class ConfiguracionController extends Controller
{
    use myTrait;
    public function roles(){
    	return view('configuraciones.roles');
    }

    public function registro(){
    	return view('configuraciones.registro');
    }

    public function edicion(){
    	return view('configuraciones.edicion');
    }
}
