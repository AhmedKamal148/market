<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AuthInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected  $authInterface ;

    public function __construct(AuthInterface $authInterface)
    {
        return $this-> authInterface = $authInterface;
    }


    public  function  loginPage()
    {
        return $this->authInterface->loginPage();
    }

    public  function login(Request $request)
    {
        return $this->authInterface->login($request);

    }
    public  function logout()
    {
        return $this->authInterface->logout();
    }
}
