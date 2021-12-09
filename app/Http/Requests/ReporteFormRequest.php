<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReporteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tReporte'      =>      'required',
            'fecIni'        =>      'required',
            'distrito'      =>      'required',
        ];
    }
    
    public function messages()
    {
        return [
            'tReporte.required'     =>      'Por favor introduzca el tipo de reporte.',
            'fecIni.required'       =>      'Introduzca una fecha inicial.',
            'distrito.required'     =>      'Por favor introduzca el/los distrito/s'
        ];
    }
}
