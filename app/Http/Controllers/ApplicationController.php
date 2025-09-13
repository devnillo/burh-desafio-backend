<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'vacancy_id' => 'required|exists:vacancies,id',
        ]);
        $user = User::with('vacancies')->find($request->user_id);
        $vacancy = Vacancy::with('users')->find($request->vacancy_id);

        if ($vacancy->users()->where('user_id', $user->id)->exists()) {
            return ApiResponse::error('You have already applied for the vacancy!', 409);
        }
        $vacancy->users()->attach($user->id);
        return ApiResponse::success($user);
    }
}
