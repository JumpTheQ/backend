<?php

namespace App\Http\Requests;

use App\Enum\PromptableType;
use App\Rules\MorphExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePromptRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'promptable_type' => [
                'nullable',
                Rule::enum(PromptableType::class),
            ],
            'promptable_id' => [
                'nullable',
                new MorphExists('promptable'),
            ],
        ];
    }
}
