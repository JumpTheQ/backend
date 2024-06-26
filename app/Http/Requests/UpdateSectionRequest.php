<?php

namespace App\Http\Requests;

use App\Enum\SectionableType;
use App\Rules\MorphExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'sectionable_type' => [
                'nullable',
                Rule::enum(SectionableType::class),
            ],
            'sectionable_id' => [
                'nullable',
                new MorphExists('sectionable'),
            ],
        ];
    }
}
