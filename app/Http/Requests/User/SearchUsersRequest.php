<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SearchUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $name = $this->name;
        $email = $this->email;
        $cpf = $this->cpf;

        $this->merge([
            'name'  => strtolower(trim($name)),
            'email' => strtolower(trim($email)),
            'cpf'   => $cpf,
        ]);
    }
    public function rules(): array
    {
        return [
            'name'     => ['sometimes', 'string', 'min:1'],
            'email'    => ['sometimes', 'string', 'min:1'],
            'cpf'      => ['sometimes'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }
}
