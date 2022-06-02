<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseTemplateRequest extends FormRequest
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
            'branch_id' => ['required','integer'],
            'course_category_id' => ['required','integer'],
            'cancellation_policy_id' => ['required','integer'],
            'name' => ['required','string'],
            'note' => ['required','string'],
            'calendarColor' => ['required','string'],
            'enabled' => ['required','integer'],
            'requirements' => ['required','string','nullable'],
            'slotDuration' => ['required','integer'],
            'clientCanCancel' => ['required','integer'],
            'courseType' => ['required','string'],
        ];
    }
}
