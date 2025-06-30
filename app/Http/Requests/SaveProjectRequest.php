<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class SaveProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'url' => [
                'required',
                Rule::unique('projects')->ignore($this->route('project'))
            ],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => [
                $this->route('project') ? 'nullable' : 'required',
                'image',
            ], //mimes:jpg,png (permite ser mas especifico), dimensions (especifica las medidas o/y el ratio), size o max(el tamaño)
            'description' => 'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'El proyecto necesita un titulo'
        ];
    }
}
