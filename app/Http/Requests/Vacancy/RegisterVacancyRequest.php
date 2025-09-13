<?php

namespace App\Http\Requests\Vacancy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterVacancyRequest extends FormRequest
{
    private const MIN_CLT_SALARY = 1212;
    private const MAX_INTERNSHIP_HOURS = 6;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => $this->title,
            'description' => $this->description,
            'type' => strtoupper($this->type),
            'salary' => $this->salary,
            'working_hours' => $this->working_hours
        ]);
    }

    public function rules(): array
    {
        return [
            'title'         => ['bail', 'required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
            'type'          => ['required', Rule::in(['PJ', 'CLT', 'INTERNSHIP'])],
            'salary'        => [
                'nullable',
                'numeric',
                Rule::requiredIf(fn() => in_array($this->type, ['CLT', 'INTERNSHIP'], true)),
                Rule::when($this->type === 'CLT', ['min:' . self::MIN_CLT_SALARY]),
            ],
            'working_hours' => [
                'nullable',
                'integer',
                Rule::requiredIf(fn() => in_array($this->type, ['CLT', 'INTERNSHIP'], true)),
                Rule::when($this->type === 'INTERNSHIP', ['max:' . self::MAX_INTERNSHIP_HOURS]),
            ],
            'company_id'    => ['required', 'exists:companies,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'          => 'The vacancy title is required.',
            'description.required'    => 'The vacancy description is required.',
            'type.required'           => 'The vacancy type is required.',
            'type.in'                 => 'The type must be one of: PJ, CLT, or Internship.',
            'salary.required'         => 'Salary is required for CLT or internship vacancies.',
            'salary.numeric'          => 'The salary must be numeric.',
            'salary.min'              => 'For CLT, the salary must be at least R$ :min.00.',
            'working_hours.required'  => 'Working hours are required for CLT or internship vacancies.',
            'working_hours.integer'   => 'Working hours must be an integer.',
            'working_hours.max'       => 'Internships cannot have more than :max hours per day.',
            'company_id.required'     => 'A valid company is required.',
            'company_id.exists'       => 'The selected company does not exist.',
        ];
    }
}
