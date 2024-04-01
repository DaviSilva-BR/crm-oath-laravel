<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
      
        $rules = [
            'name' => 'required|min:3|max:150',
            'email' => 'required|email|min:3|max:180',
            'subject' => 'nullable|min:3|max:100',
            'message' => 'required|min:3|max:550',
            'attachments' => 'nullable|max:10000|mimes:doc,docx,png,svg,jpeg,jpg,pdf,xls',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name' => '*Digite o seu nome',
            'email' => '*Digite o seu e-mail',
            'subject' => '*Digite o assunto',
            'message' => '*Digite a mensagem',
            'attachments' => 'Entensão de arquivo não permitida ou tamanho superior ao limite permitido'
        ];
    }
}
