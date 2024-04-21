<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'filled|string',
            'company_name' => 'filled|string',
            'description' => 'nullable',
            'start_date' => 'filled|date',
            'end_date' => 'nullable|date',
        ];
    }
}
