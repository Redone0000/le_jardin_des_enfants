<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'classe' => 'required',
            'type' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',

            // Validation pour les images
            'pictures.*' => 'nullable|file|mimes:jpeg,png,jpg|max:2048', // Maximum 2MB par image
            
            // Validation pour les vidéos
            'videos.*' => 'nullable|file|mimes:mp4,mov,avi,mkv|max:10000', // Maximum 10MB par vidéo
            
            // Validation pour les PDF
            'pdfs.*' => 'nullable|file|mimes:pdf|max:5120', // Maximum 5MB par PDF
        ];
    }
}
