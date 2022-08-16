<?php
namespace  App\Http\Repositories;


use App\Http\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthRepo implements AuthInterface
{

    public function loginPage()
    {
        return view('admin.pages.reg_login.login');
    }

    public function login($request)
    {
        $credentials = $request->only('email' , 'password');
        if(Auth::attempt($credentials))
        {
            return redirect(route('admin.index'));
        }
        else{
            Alert::success('Login Failed' ,'Please Try Again !');
            return redirect(route('loginPage'));
        }
    }
    public  function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('loginPage'));
    }
}
