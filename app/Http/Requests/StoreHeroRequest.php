<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeroRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|string|max:100',
            'height' => 'required|numeric|gt:0',
            'weight' => 'required|numeric|gt:0',
            'intelligence' => 'required|numeric|between:1,100',
            'strength' => 'required|numeric|between:1,100',
            'speed' => 'required|numeric|between:1,100',
            'durability' => 'required|numeric|between:1,100',
            'power' => 'required|numeric|between:1,100',
            'combat' => 'required|numeric|between:1,100',
            'publisher_id' => 'required',
            'alignment_id' => 'required',
            'cover' => 'required|mimes:png|dimensions:width=1000,height=1000',
            'aliases.*.name' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'aliases.*.name.required' => 'The alias field is required.',
            'aliases.*.name.max' => 'The alias field must not be greater than 100 characters.'
        ];
    }
}
