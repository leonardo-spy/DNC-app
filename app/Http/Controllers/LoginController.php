<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('login/login');
    }

    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|alphaNum|min:3'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
      return redirect('manage/main');
     }
     else
     {
      return back()->with('error', 'Credenciais informadas não correspondem com nossos registros.');
     }

    }
    function successlogin()
    {
     return view('manage/main');
    }

    function logout()
    {
     Auth::logout();
     return redirect('logib');
    }
}