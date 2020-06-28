<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerRequest extends FormRequest
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
            'name_en' => 'required|max:100|unique:offers,name_en',
            'name_fr' => 'required|max:100|unique:offers,name_fr',
            'price' => 'required|numeric',
            'cato_fr' => 'required',
            'cato_en' => 'required',
        ];
    }
    public function messages()
    {
        return  [
            'name_fr.required' => __('message.offer name required'),
            'name_fr.unique' => __('message.offer name must be unique'),
            'name_en.required' => __('message.offer name required'),
            'name_en.unique' => __('message.offer name must be unique'),
            'price.numeric' => 'le prix il faut qui soit en form numerique ',
            'price.required' => ' remplier le prix',

        ];
    }
}
