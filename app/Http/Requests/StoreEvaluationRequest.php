<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationRequest extends FormRequest
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
            'activity_id' => 'required|exists:activities,id',
            'grades' => 'required|array',
            'grades.*' => 'required|integer|between:1,4',
            'feedback' => 'nullable|array',
            'feedback.*' => 'nullable|string',
            'child_ids' => 'required|array',
            'child_ids.*' => 'required|exists:children,id',
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
            'activity_id.required' => 'L\'ID de l\'activité est requis.',
            'activity_id.exists' => 'L\'activité spécifiée n\'existe pas.',
            'grades.required' => 'Les notes sont requises.',
            'grades.array' => 'Les notes doivent être un tableau.',
            'grades.*.required' => 'Chaque note est requise.',
            'grades.*.integer' => 'Chaque note doit être un entier.',
            'grades.*.between' => 'Chaque note doit être entre 1 et 4.',
            'feedback.array' => 'Les feedbacks doivent être un tableau.',
            'feedback.*.nullable' => 'Les feedbacks peuvent être nuls.',
            'feedback.*.string' => 'Chaque feedback doit être une chaîne de caractères.',
            'child_ids.required' => 'Les ID des enfants sont requis.',
            'child_ids.array' => 'Les ID des enfants doivent être un tableau.',
            'child_ids.*.required' => 'Chaque ID d\'enfant est requis.',
            'child_ids.*.exists' => 'Un des enfants spécifiés n\'existe pas.',
        ];
    }
}
