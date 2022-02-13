<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function getUser()
    {
        return User::all();
    }

    public function getUserById($userId)
    {
        
    }
}