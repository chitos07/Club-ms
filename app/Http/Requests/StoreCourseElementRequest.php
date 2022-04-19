<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseElementRequest extends FormRequest
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
            'name' => ['required','string'],
            'course_template_id' => ['required','integer'],
            'price' =>  ['required','regex:^-?[0-9]+(?:\.[0-9]{1,6})?$^'],
            'applyTax' => ['required','integer'],
        ];
    }
}
