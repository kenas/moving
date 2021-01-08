<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequestValidation extends FormRequest
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
            
            'subject' => 'required|min:5',
            'email' => 'required|email',
            'content' => 'required|min:10'

        ];
    }

    public function messages()
    {
        return [
            
            'subject.required' => 'Vložte předmět prosím.',
            'subject.min' => 'Více textu v předmětu prosím.',
            'email.required' => 'Vložte svůj e-mail prosím.',
            'content.min' => 'Vice obsahu je lepsi pro vyjadreni Vaseho nazoru nebo myslenky.',
            'content.required' => 'Obsah nemůže být prázdný.'
        ];
    }
}