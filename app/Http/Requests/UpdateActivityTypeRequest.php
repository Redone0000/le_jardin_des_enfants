<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityTypeRequest extends FormRequest
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
            $id = $this->route('id'); // Récupérer l'ID de l'enregistrement en cours d'édition

            return [
                'category' => 'required|string|max:255',
                'name' => 'required|string|max:255|unique:activity_types,name,' . $id,
                'description' => 'nullable|string',
            ];

    }
}
