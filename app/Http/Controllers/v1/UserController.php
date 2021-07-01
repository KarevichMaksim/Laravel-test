<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(User::whereRoleUser()->paginate($request->query('limit')));
    }

    public function update(UpdateUserRequest $request,User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }

    public function profile(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
