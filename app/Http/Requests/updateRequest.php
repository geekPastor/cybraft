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
        'prenom' => 'required|string|max:255',
        'profession' => 'required|string|max:255',
        'sexe' => 'required|string|max:10',
        'number' => 'required|string|max:20',
        'email' => 'required|string|email|max:255',
        'naissance' => 'required|date',
        'domicile' => 'required|string|max:255',
        'description' => 'required|string',
        'competences' => 'required|string',
        'nom_entite' => 'required|string|max:255',
        'services' => 'required|string|max:255',
        'facebook' => 'required|string|max:255',
        'twitter' => 'required|string|max:255',
        'instagram' => 'required|string|max:255',
        'linkedin' => 'required|string|max:255',
        'tiktok' => 'required|string|max:255',
        'description_entite' => 'required|string|max:255',
        'theads' => 'required|string|max:255',
        'telegram' => 'required|string|max:255',
        'whatsapp' => 'required|string|max:255',
    ];
}

}
