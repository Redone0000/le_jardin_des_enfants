<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['required', 'string', 'max:255'],

            
        ];

        $user = auth()->user();

        if ($user && $user->role_id === 2) {
            $rules['description'] = ['nullable', 'string', 'max:255'];
            $rules['picture'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
        }

        if ($user && $user->role_id === 3) {
            $rules['address'] = ['required', 'string', 'max:255'];
            $rules['emergency_contact_name'] = ['required', 'string', 'max:255'];
            $rules['emergency_contact_phone'] = ['required', 'string', 'max:255'];
        }
        return $rules;
    }
}
