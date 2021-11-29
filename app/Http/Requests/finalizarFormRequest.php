<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Ui\Presets\React;

class finalizarFormRequest extends FormRequest
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
        $folioBase = 'required|numeric|min:0|';
     if(($this->form== 2 && $this->detalle != 1) || ($this->folioModificado == '1')){
        $folioBase = $folioBase.'unique:App\Models\d_analisi,folio';
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
            'tiempoMuerto' => 'nullable|required_with:fPausado',
            'hora_eta' =>'required',
            'hora_sla' =>'required',
            'material' =>'',
            'material_can'=>'',
            'ot' => '',
            'material.*' =>'required',
            'latitud' => 'required|regex:/^(-?\d{2}+\.(\d+)?)$/',
            'longitud' => 'required|regex:/^\s*(-\d{2}+\.(\d+)?)$/',
            'material_can.*' =>'required_unless:material.*,==,sinMaterial',
            'concepto_cant.*' => 'required',
            'concepto.*' => 'required',
            'cab24.*' => 'required_if:concepto.*,==,17',
            'imagen_antes' => 'sometimes',
            'imagen_durante' => 'sometimes',
            'imagen_despues' => 'sometimes',
        ];
    }
    public function messages()
    {
        return [
            'folio.required'                => 'El número de folio no puede ir vacío.',
            'folio.numeric'                 => 'El folio debe de ser un número.',
            'folio.min'                     => 'El folio debe de ser un número positivo.',
            'folio.unique'                  => 'El folio ya existe en la base de datos, verifique.',
            'tFolio.required'               => 'El tipo de folio es requerido.',
            'turno.required'                => 'Debe de seleccionar un turno.',
            'ot.numeric'                    => 'La OT debe de ser un número.',
            'ot.min'                        => 'La OT debe de ser un número mayor a cero.',
            'distrito_id.required'          => 'Debe de seleccionar un distrito.',
            'cluster.required'              => 'Debe de seleccionar un cluster.',
            'falla.required'                => 'Debe de seleccionar una falla.',
            'cAfectacion.required'          => 'Debe de seleccionar una causa/afectación.',
            'nClientes.required'            => 'El campo cliente no puede ir vacío.',
            'nClientes.numeric'             => 'El campo cliente tiene que ser un número.',
            'nClientes.min'                 => 'El campo cliente tiene que ser un número mayor a cero',
            'despachoIos.required'          => 'El campo de despacho iOS no puede ir vacío.',
            'supervisorTTP.required'        => 'Debe de seleccionar un supervisor.',
            'tecnicoIos.required'           => 'Debe de seleccionar un técnico.',
            'fechaIos.required'             => 'La fecha de asignación iOS es obligatoria.',
            'tiempoMuerto.required_with'    => 'Si existe Justificacion Pausa debe de capturar el tiempo muerto.',
            'tiempoMuerto.numeric'          => 'El valor del tiempo en pausa debe de ser un número.',
            'tiempoMuerto.min'              => 'El valor del tiempo en pausa debe de ser un número positivo.',
            'otro.required_if'              => 'Por favor especifique el otro tipo de folio.',
            'material.*.required'           => 'Por favor seleccione un material',
            'material_can.*.required_unless' => 'La cantidad de material no puede ser cero.',
            'latitud.required_if'           => 'Si existe Latitud por favor capturar Longitud.',
            'longitud.required_if'          => 'Si existe Longitud por favor capturar Latitud.',
            'concepto_cant.*.required'      => 'Debe de seleccionar la cantidad en Conceptos',
            'concepto.*.required'           => 'Por favor escoja un concepto',
            'cab24.*.required_if'           => 'Por favor agregue al menos una coordenada del CAB-24',
            'longitud.required'             => 'Las coordendas son obligatorias para finalizar el folio.',
            'latitud.required'              => 'Las coordendas son obligatorias para finalizar el folio.',
            'latitud.regex'                 =>'El formato de Latitud es incorrecto',
            'longitud.regex'                =>'El formato de Longitud es incorrecto',
            'imagen_antes.image'            => 'Por favor seleccione una imagen del antes',
            'imagen_durante.image'          => 'Por favor seleccione una imagen del durante',
            'imagen_despues.image'          => 'Por favor seleccione una imagen del después',
            'hora_eta.required'             => 'Es necesario el ETA para finalizar el folio.',
            'hora_sla.required'             => 'Es necesario el SLA para finalizar el folio.'
        ];
    }
}
