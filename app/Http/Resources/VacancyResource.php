<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'type'          => $this->type,
            'salary'        => $this->salary,
            'working_hours' => $this->working_hours,
            'company'       => [
                'id'   => $this->company->id ?? null,
                'name' => $this->company->name ?? null,
                'cnpj' => $this->company->cnpj ?? null,
                'plan' => $this->company->plan ?? null,
            ],
            'users' => $this->whenLoaded('users', function () {
                return $this->users->map(fn($user) => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'applied_at' => optional($user->pivot)->created_at?->toISOString(),
                ]);
            }),
        ];
    }
}
