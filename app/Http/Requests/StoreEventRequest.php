<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'pictures.*' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'videos.*' => 'nullable|mimetypes:video/mp4,video/avi,video/mov|max:10240',
            'pdfs.*' => 'nullable|mimes:pdf|max:2048',
        ];
    }

     /**
     * Messages de validation personnalisés.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Le nom de l\'événement est requis.',
            'name.string' => 'Le nom de l\'événement doit être une chaîne de caractères.',
            'name.max' => 'Le nom de l\'événement ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
}
