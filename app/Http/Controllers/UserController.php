<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $All_user = $this->users->getUser();

        return response()->json([
            'message' => 'User fetched succefully',
            'users' => $All_user
        ]);
    }

}
