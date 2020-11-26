<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostingRequest extends FormRequest
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
            'title.*' => 'required|string|min:2|max:255',
            'description.*' => 'required|string|min:5|max:500',
            'salary.*' => 'required|string|min:5|max:500',
            'areas.en.*'=> 'nullable|string|min:2|max:255',
            'areas.lt.*'=> 'sometimes|nullable|string|min:2|max:255',
        ];
    }
}
