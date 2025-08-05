<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function CreateUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        // Return the created user
        return User::create($data);
    }

    public function UpdateUser(array $data): void
    {
        $user = User::where('email', $data['email'])->firstOrFail();
        $user->password = Hash::make($data['password']);
        $user->save();
    }
}
