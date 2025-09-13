<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Vacancy\RegisterVacancyRequest;
use App\Http\Resources\VacancyResource;
use App\Models\Company;
use App\Models\Vacancy;

class VacancyController extends Controller
{
    public function register(RegisterVacancyRequest $request)
    {
        $credentials = $request->validated();
        $company = Company::find($request->company_id);
        if (
            ($company->plan == 'free' && $company->vacancies->count() >= 5) ||
            ($company->plan == 'premium' && $company->vacancies->count() >= 10)
        ) {
            return ApiResponse::error('Maximum number of registered vacancies');
        }
        $vacancy = Vacancy::create($credentials);
        return ApiResponse::success(new VacancyResource($vacancy), 'Successfully registered job');
    }
    public function show($id)
    {
        
        $vacancy = Vacancy::with('users')->find($id);

        return ApiResponse::success(new VacancyResource($vacancy), 'success in finding a job');
    }
}
