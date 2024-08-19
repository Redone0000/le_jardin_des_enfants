<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvaluationRequest extends FormRequest
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
            'grade' => 'required|numeric|min:0|max:10',
            'feedback' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Obtenir les messages de validation personnalisés.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'grade.required' => 'La note est requise.',
            'grade.numeric' => 'La note doit être un nombre.',
            'grade.min' => 'La note doit être d\'au moins :min.',
            'grade.max' => 'La note ne peut pas dépasser :max.',
            'feedback.string' => 'Le feedback doit être une chaîne de caractères.',
            'feedback.max' => 'Le feedback ne peut pas dépasser :max caractères.',
        ];
    }
}
