<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Company\RegisterCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function register(RegisterCompanyRequest $request)
    {
        $credentials = $request->validated();
        $company = Company::create($credentials);
        return ApiResponse::success($company, 'Successfully registered company');
    }
}
