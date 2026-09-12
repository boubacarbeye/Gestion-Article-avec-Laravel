<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //
    public function form(){
        return view('auth.login');
    }
    public function login(LoginRequest $request){
        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('articles.index'));
        }

        return back()->withErrors([
            'name'=> 'Identifiants incorrects'
        ])->onlyInput('name');

    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success','Voues êtes déconnectés');
    }
}
