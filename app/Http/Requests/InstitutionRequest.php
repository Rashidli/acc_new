<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'voen' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:255',
            'bank_code' => 'required|string|max:255',
            'bank_voen' => 'required|string|max:255',
            'swift' => 'required|string|max:255',
            'correspondent_account' => 'required|string|max:255',
            'contract' => 'required|string|max:255',
        ];
    }
}
