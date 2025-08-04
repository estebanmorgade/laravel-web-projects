<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SaveUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    //public function show(User $user)

    public function store(SaveUserRequest $request)
    {
        $user = User::create($request->all());
        return $user;
    }

    public function update(User $user, SaveUserRequest $request)
    {
        $user->update($request->validated());
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
