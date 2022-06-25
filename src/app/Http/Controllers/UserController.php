<?php

namespace App\Http\Controllers;

use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->fetch( 
                                      orderByColumn: 'created_at', 
                                      sort: 'desc'
                                  );
    }

    public function search(Request $request)
    {
        $keyword = "example@laravel.php";
        return $this->userService->search(
                                        column: 'email', 
                                        keyword: $keyword, 
                                        getColumns: ['id', 'email', 'name']
                                    );
    }

    public function show()
    {
        return $this->userService->find(1, getColumns: ['id', 'name', 'email']);
    }
}
