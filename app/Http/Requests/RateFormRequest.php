<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateFormRequest extends FormRequest
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
            'monnaie_enter' => 'required|string',
            'devise_enter'  => 'required|string',
            'valeur_enter'  => 'required|numeric',
            'monnaie_out'   => 'required|string',
            'devise_out'    => 'required|string',
            'valeur_out'    => 'required|numeric',
        ];
    }
}
