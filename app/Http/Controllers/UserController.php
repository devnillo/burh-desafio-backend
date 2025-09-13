<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\SearchUsersRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $credentials = $request->validated();
        $user = User::create($credentials);
        return ApiResponse::success(new UserResource($user), 'Successfully registered user');
    }
    public function search(SearchUsersRequest $request)
    {
        $filters = $request->validated();
        $query = User::query();
        if ($request->filled('nome')) {
            $query->where('name', 'like', '%' . $request->nome . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', $request->email);
        }
        if ($request->filled('cpf')) {
            $query->where('cpf', $request->cpf);
        }
        $users = $query->with('vacancies')->get();

        return UserResource::collection($users);
    }
}
