<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntreeFormRequest extends FormRequest
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
            'equipement.*.equipement_id'=> ['required', 'integer', 'exists:equipements,id'],
            'equipement.*.Aprice'=> ['required', 'numeric', 'min:1'],
            'equipement.*.quantite'=> ['required', 'integer', 'min:1'],
            'equipement.*.salle_id'=> ['required', 'integer', 'exists:salles,id'],
        ];
    }
}
