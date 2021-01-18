<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendFloozFormRequest extends FormRequest
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
            'amount'     => 'required',
            'coin_enter' => 'required|numeric',
            'coin_out'   => 'required|numeric',
        ];
    }
}
