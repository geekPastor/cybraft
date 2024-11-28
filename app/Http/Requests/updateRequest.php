<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
        'profession' => 'required|string|max:255',
        'sexe' => 'required|string|max:10',
        'number' => 'required|string|max:20',
        'number2' => 'nullable|string|max:20',
        'email' => 'required|string|email|max:255',
        'naissance' => 'required|date',
        'domicile' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:2000',
        'competences' => 'nullable|string|max:500',


        // Réseaux sociaux

        'facebook' => 'nullable|string|max:255|starts_with:https://',
        'twitter' => 'nullable|string|max:255|starts_with:https://',
        'instagram' => 'nullable|string|max:255|starts_with:https://',
        'linkedin' => 'nullable|string|max:255|starts_with:https://',
        'tiktok' => 'nullable|string|max:255|starts_with:https://',
        'theads' => 'nullable|string|max:255|starts_with:https://',
        'telegram' => 'nullable|string|max:255|starts_with:https://',
        'whatsapp' => 'nullable|string|max:255|starts_with:https://',
        
        'files' => 'nullable',
        'files.*' => 'nullable|max:10240',
    ];
}

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire',
            'profession.required' => 'La profession est obligatoire',
            'sexe.required' => 'Le sexe est obligatoire',
            'number.required' => 'Le numéro de téléphone est obligatoire',
            'email.required' => 'L\'adresse email est obligatoire',
            'naissance.required' => 'La date de naissance est obligatoire',
            'facebook.starts_with' => 'Le lien doit commencer par https://',
            'twitter.starts_with' => 'Le lien doit commencer par https://',
            'instagram.starts_with' => 'Le lien doit commencer par https://',
            'linkedin.starts_with' => 'Le lien doit commencer par https://',
            'tiktok.starts_with' => 'Le lien doit commencer par https://',
            'theads.starts_with' => 'Le lien doit commencer par https://',
            'telegram.starts_with' => 'Le lien doit commencer par https://',
            'whatsapp.starts_with' => 'Le lien doit commencer par https://',
        ];
    }
}
