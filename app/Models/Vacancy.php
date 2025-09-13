<?php

namespace App\Models;

use App\Casts\TrimLower;
use App\Casts\TrimUpper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'salary',
        'working_hours',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    protected $casts = [
        'title' => TrimUpper::class,
        'type'  => TrimUpper::class,
    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_vacancy')->withTimestamps();
    }
}
