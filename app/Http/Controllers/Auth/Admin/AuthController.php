<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Requests\Admin\LoginRequest;

use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use  App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm(){

        return view("auth.admin.login") ;
    }

    public function login(LoginRequest $request) {
       
        $validated=$request->validated() ;

        $remember=$request->input('remember') ;

        if(Auth::guard('admin')->attempt($validated,$remember) ){

            ;

            return redirect()->route("admin.dashboard") ;
        }
        return back()->withErrors("invalid username or password") ;
    }

    public function logout(){
  
        Auth::guard("admin")->logout() ;
      
        return redirect()->route("admin.login.form") ;
    }
}
