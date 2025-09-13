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

        // Filtro por nome (corrigido: usar 'name' ao invés de 'nome')
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filtro por e-mail
        if ($request->filled('email')) {
            $query->where('email', $request->email);
        }

        // Filtro por CPF
        if ($request->filled('cpf')) {
            $query->where('cpf', $request->cpf);
        }

        // Retorna usuários junto com as vagas em que estão inscritos
        $users = $query->with('vacancies')->get();

        return UserResource::collection($users);
    }
}
