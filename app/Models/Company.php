<?php

namespace App\Models;

use App\Casts\TrimLower;
use App\Casts\TrimUpper;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $with = ['vacancies'];
    protected $fillable = [
        'name',
        'description',
        'cnpj',
        'plan',
    ];
    protected $casts = [
        'name' => TrimUpper::class,
        'plan'  => TrimLower::class,
    ];

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
