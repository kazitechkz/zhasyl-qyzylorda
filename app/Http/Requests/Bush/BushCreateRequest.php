<?php

namespace App\Http\Requests\Bush;

use Illuminate\Foundation\Http\FormRequest;

class BushCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type_id'=>"required|exists:types,id",
            'breed_id'=>"required|exists:breeds,id",
            'sanitary_id'=>"required|exists:sanitaries,id",
            'place_id'=>"required|exists:places,id",
            'geocode'=>"required",
            'length'=>"required|int|min:0",
            'height'=>"required|int|min:0",
            'width'=>"required|int|min:0"
        ];
    }
}
