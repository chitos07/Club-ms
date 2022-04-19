<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'course_template_id' => ['required', 'integer'],
            'staff_id' => ['required', 'integer'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
            'maxNumber' => ['required', 'integer'],
        ];
    }
}
