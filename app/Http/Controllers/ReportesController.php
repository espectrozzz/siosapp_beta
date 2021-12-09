<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MaterialExport;
use App\Http\Requests\ReporteFormRequest;

class ReportesController extends Controller
{
    public function Export(ReporteFormRequest $request){
        return Excel::download(new MaterialExport($request), 'materiales_'.date("d-m-Y_his").'.xlsx');
    }
}
