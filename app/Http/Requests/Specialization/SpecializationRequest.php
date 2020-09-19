<?php

namespace App\Http\Requests\Specialization;

use Illuminate\Foundation\Http\FormRequest;

class SpecializationRequest extends FormRequest
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
            'point' => ['required','integer'],
            'is_special' => ['required','boolean'],
            'is_paid' => ['required','boolean'],
            'university_id' => ['required','integer'],
            'group' => ['required','integer','min:1','max:5']
        ];
    }
}
