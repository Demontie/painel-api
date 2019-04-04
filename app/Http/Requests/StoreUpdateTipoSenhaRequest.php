<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTipoSenhaRequest extends FormRequest
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
            'prefixo' => 'required',
            'descricao' => 'required|max:100',
            'tela_grupo_id' => 'required|exists:tela_grupo.id',
            'ordem' => 'required',
        ];
    }
}
