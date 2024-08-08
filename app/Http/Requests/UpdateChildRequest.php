<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildRequest extends FormRequest
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
            'classe' => 'required|integer',
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'sexe' => 'required|in:Male,Female',
            'birth_date' => 'nullable|date',
            'picture' => ['nullable', 'image', 'mimetypes:image/jpeg,image/png,image/jpg,image/gif', 'max:2048'],
            'firstname_tutor' => ['required', 'string', 'max:255'],
            'lastname_tutor' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'string', 'max:255'],
        ];
    }
}
