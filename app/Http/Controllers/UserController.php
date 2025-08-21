<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SaveUserRequest;

class UserController extends Controller
{
    /* Define middleware */

    public function __construct(){

        $this->middleware('auth:sanctum');

    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        return User::all();
    }

    //public function show(User $user)

    public function store(SaveUserRequest $request)
    {
        $this->authorize('create', $request->user());
        $user = User::create($request->all());
        return $user;
    }

    public function update(User $user, SaveUserRequest $request)
    {
        $this->authorize('update', $request->user());
        $user->update($request->validated());
        return $user;
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
