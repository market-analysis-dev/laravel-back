<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): \App\Responses\ApiResponse
    {
        try {
            $user = User::create($request->validated());
            return $this->success('User created successfully', $user);
        } catch (\Exception $e) {
            return $this->error('Error creating user: ' . $e->getMessage(), 500);
        }
    }

    /**
     * @param User $user
     * @return \App\Responses\ApiResponse
     */
    public function show(User $user): \App\Responses\ApiResponse
    {
        return $this->success(data: $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        $user->update($request->validated());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): \App\Responses\ApiResponse
    {
        try {
            if ($user->delete()) {
                return $this->success('User deleted successfully');
            }
            return $this->error('User delete failed', 423);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
