<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Validation\Rule;

class PreventivoFormRequest extends FormRequest
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
            'folio' => 'required|numeric|min:0|'.Rule::unique('d_analisis')->where('d_analisis.tfolio_id', $this->tFolio),
            'tFolio' => 'required',
            'ot' => '',
            'turno' => 'required',
            'distrito_id' => 'required',
            'cluster' => 'required',
            'falla' => 'required',
            'cAfectacion' => 'required',
            'nClientes' => 'required|numeric|min:0',
            'despachoIos' => 'required',
            'supervisorTTP' => 'required',
            'tecnicoIos' => 'required',
            'fechaIos' => 'required',
            'llegadaFolio' =>'',
            'activacionFolio' => '',
            'fPausado' => '',
            'tiempoMuerto' => 'nullable|required_with:fPausado|numeric|min:1',
            'hora_eta' =>'',
            'hora_sla' =>'',
            'latitud' => 'nullable|regex:/^(-?\d{2}+\.(\d+)?)$/',
            'longitud' => 'nullable|regex:/^\s*(-\d{2}+\.(\d+)?)$/',
           /* 'otro' => 'required_if:tFolio,=,Otro',*/
            'material.*' =>'required',
            'material_can.*' =>'required_unless:material.*,==,sinMaterial',
            /*'imagen_antes' => 'nullable|max:50',
            'imagen_durante' => 'nullable|max:50',
            'imagen_despues' => 'nullable|max:50',*/
            'concepto_cant.*' => 'required',
            'concepto.*' => 'required',
            'cab24.*' => 'required_if:concepto.*,==,17'
        ];
    }

    public function messages()
    {
        return [
            'folio.required' => 'El n??mero de folio no puede ir vac??o.',
            'folio.numeric' => 'El folio debe de ser un n??mero.',
            'folio.min' => 'El folio debe de ser un n??mero positivo.',
            'folio.unique' => 'El folio ya existe en la base de datos, verifique.',
            'tFolio.required' => 'El tipo de folio es requerido.',
            'turno.required' => 'Debe de seleccionar un turno.',
            'ot.numeric' => 'La OT debe de ser un n??mero.',
            'ot.min' => 'La OT debe de ser un n??mero mayor a cero.',
            'distrito_id.required' => 'Debe de seleccionar un distrito.',
            'cluster.required' => 'Debe de seleccionar un cluster.',
            'falla.required' => 'Debe de seleccionar una falla.',
            'cAfectacion.required' => 'Debe de seleccionar una causa/afectaci??n.',
            'nClientes.required' => 'El campo cliente no puede ir vac??o.',
            'nClientes.numeric' => 'El campo cliente tiene que ser un n??mero.',
            'nClientes.min' => 'El campo cliente tiene que ser un n??mero mayor a cero',
            'despachoIos.required' => 'El campo de despacho iOS no puede ir vac??o.',
            'supervisorTTP.required' => 'Debe de seleccionar un supervisor.',
            'tecnicoIos.required' => 'Debe de seleccionar un t??cnico.',
            'fechaIos.required' => 'La fecha de asignaci??n iOS es obligatoria.',
            'tiempoMuerto.required_with' => 'Si existe Justificacion Pausa debe de capturar el tiempo muerto.',
            'tiempoMuerto.numeric' => 'El valor del tiempo en pausa debe de ser un n??mero.',
            'tiempoMuerto.min' => 'El valor del tiempo en pausa debe de ser un n??mero positivo.',
            'otro.required_if' => 'Por favor especifique el otro tipo de folio.',
            'material.*.required' => 'Por favor seleccione un material',
            'material_can.*.required_unless' => 'La cantidad de material no puede ser cero.',
            'latitud.required_if' => 'Si existe Latitud por favor capturar Longitud.',
            'longitud.required_if' => 'Si existe Longitud por favor capturar Latitud.',
            'latitud.regex' =>'El formato de Latitud es incorrecto',
            'longitud.regex' =>'El formato de Longitud es incorrecto',
            'concepto_cant.*.required' => 'Debe de seleccionar la cantidad en Conceptos',
            'concepto.*.required' => 'Por favor escoja un concepto',
            'cab24.*.required_if' => 'Por favor agregue al menos una coordenada del CAB-24',
            'imagen_antes.max' => 'Tama??o de la imagen (antes) demasiado pesado',
            'imagen_durante.max' => 'Tama??o de la imagen (durante) demasiado pesado',
            'imagen_despues.max' => 'Tama??o de la imagen (despues) demasiado pesado',
        ];
    }
}
