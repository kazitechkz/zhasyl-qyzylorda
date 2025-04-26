<?php

namespace App\Http\Requests\Chef;

use Illuminate\Foundation\Http\FormRequest;

class CreateChefEditRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'password' => 'sometimes|nullable|min:4|max:16',
            'role_id' => 'required',
        ];
    }
}
