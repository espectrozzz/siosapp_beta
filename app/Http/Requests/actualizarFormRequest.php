<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class actualizarFormRequest extends FormRequest
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
        $folioBase = 'required|numeric|min:0';

        if($this->folioModificado == '1'){
            $folioBase .= '|unique:App\Models\d_analisi,folio';
        }
        
        return [
            'folio' => $folioBase,
            'tFolio' => 'required',
            'ot' => 'numeric|min:0',
            'turno' => 'required',
            'distrito_id' => 'required',
            'cluster' => 'required',
            'falla' => 'required',
            'cAfectacion' => 'required',
            'nClientes' => 'required|numeric|min:0',
            'despachoIos' => 'required',
            'supervisorTTP' => 'required',
            'tecnicoIos' => 'required',
            'llegadaFolio' =>'',
            'activacionFolio' => '',
            'fechaIos' => 'required',
            'fPausado' => '',
            // 'latitud' => 'nullable|regex:/^(-?\d{2}+\.(\d+)?)$/',
            // 'longitud' => 'nullable|regex:/^\s*(-\d{2}+\.(\d+)?)$/',
            'tiempoMuerto' => 'nullable|required_with:fPausado|',
            'hora_eta' =>'',
            'hora_sla' =>'',
            'material' =>'',
            'material_can'=>'',
            'imagen_antes' => 'nullable|max:50',
            'imagen_durante' => 'nullable|max:50',
            'imagen_despues' => 'nullable|max:50',
            'ot' => '',
            'material.*' =>'required',
            'material_can.*' =>'required_unless:material.*,==,sinMaterial',
            'concepto_cant.*' => 'required|min:1',
            'concepto.*' => 'required',
            'cab24.*' => 'required_if:concepto.*,==,17'
        ];
    }
    public function messages()
    {
        return [
            'folio.required' => 'El número de folio no puede ir vacío.',
            'folio.numeric' => 'El folio debe de ser un número.',
            'folio.min' => 'El folio debe de ser un número positivo.',
            'folio.unique' => 'El folio ya existe en la base de datos, verifique.',
            'tFolio.required' => 'El tipo de folio es requerido.',
            'turno.required' => 'Debe de seleccionar un turno.',
            'ot.numeric' => 'La OT debe de ser un número.',
            'ot.min' => 'La OT debe de ser un número mayor a cero.',
            'distrito_id.required' => 'Debe de seleccionar un distrito.',
            'cluster.required' => 'Debe de seleccionar un cluster.',
            'falla.required' => 'Debe de seleccionar una falla.',
            'cAfectacion.required' => 'Debe de seleccionar una causa/afectación.',
            'nClientes.required' => 'El campo cliente no puede ir vacío.',
            'nClientes.numeric' => 'El campo cliente tiene que ser un número.',
            'nClientes.min' => 'El campo cliente tiene que ser un número mayor a cero',
            'despachoIos.required' => 'El campo de despacho iOS no puede ir vacío.',
            'supervisorTTP.required' => 'Debe de seleccionar un supervisor.',
            'tecnicoIos.required' => 'Debe de seleccionar un técnico.',
            'fechaIos.required' => 'La fecha de asignación iOS es obligatoria.',
            'tiempoMuerto.required_with' => 'Si existe Justificacion Pausa debe de capturar el tiempo muerto.',
            'tiempoMuerto.numeric' => 'El valor del tiempo en pausa debe de ser un número.',
            'tiempoMuerto.min' => 'El valor del tiempo en pausa debe de ser un número positivo.',
            'otro.required_if' => 'Por favor especifique el otro tipo de folio.',
            'material.*.required' => 'Por favor seleccione un material',
            'material_can.*.required_unless' => 'La cantidad de material no puede ser cero.',
            'material_can.*.min' => 'La cantidad debe de ser un número positivo',
            'material_can.*.numeric' => 'La cantidad debe de ser un número',
            'latitud.required_if' => 'Si existe Latitud por favor capturar Longitud.',
            'longitud.required_if' => 'Si existe Longitud por favor capturar Latitud.',
            'concepto_cant.*.required' => 'Debe de seleccionar la cantidad en Conceptos',
            'concepto.*.required' => 'Por favor escoja un concepto',
            'cab24.*.required_if' => 'Por favor agregue al menos una coordenada del CAB-24',
            'latitud.regex' =>'El formato de Latitud es incorrecto',
            'longitud.regex' =>'El formato de Longitud es incorrecto',
            'imagen_antes.max' => 'Tamaño de la imagen (antes) demasiado pesado',
            'imagen_durante.max' => 'Tamaño de la imagen (durante) demasiado pesado',
            'imagen_despues.max' => 'Tamaño de la imagen (despues) demasiado pesado',
        ];
    }
}
