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
        'email' => 'required|string|email|max:255',
        'naissance' => 'required|date',
        'domicile' => 'required|string|max:255',
        'description' => 'required|string|max:2000',
        'competences' => 'required|string|max:500',


        // Réseaux sociaux

        'facebook' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'linkedin' => 'nullable|string|max:255',
        'tiktok' => 'nullable|string|max:255',
        'theads' => 'nullable|string|max:255',
        'telegram' => 'nullable|string|max:255',
        'whatsapp' => 'nullable|string|max:255',
    ];
}

}
