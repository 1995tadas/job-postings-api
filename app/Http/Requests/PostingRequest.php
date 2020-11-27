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
        $rules = [];

        $titleRules = 'required|string|min:2|max:255';
        $descriptionRules = 'required|string|min:5|max:500';
        $salaryRules = 'required|string|min:5|max:500';
        $areasRules = 'sometimes|nullable|string|min:2|max:255';

        $available_locales = config('app.available_locales');
        foreach ($available_locales as $language){
            $rules['title.'.$language] = $titleRules;
            $rules['description.'.$language] = $descriptionRules;
            $rules['salary.'.$language] = $salaryRules;
        }

        for ($i = 0; $i <= 5; $i++) {
            foreach ($available_locales as $language) {
                $rules['areas.'.$language.'.'. $i] = $areasRules;
            }
        }

        return $rules;
    }
}
