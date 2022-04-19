<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'firstName'       => ['required','string','max:50'],
           // 'email'       => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'password'       => ['required', 'string', 'min:8', 'confirmed'],
            'lastName'       => ['required','string','max:50'],
            'phoneNumber'       => ['required','string','max:50'],
            'emergencyNumber'       => ['required','string','max:50'],
            'country'       => ['required','string','max:10'],
            'city'       => ['required','string','max:10'],
            'adressLine'       => ['required','string','max:255'],
            'adressLine2'       => ['required','string','max:255'],
            'canSwim'       => ['required','integer','max:2'],
        ];
    }
}
