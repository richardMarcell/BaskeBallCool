<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login() 
    {
        return view ('login');
    }

    public function authenticate(StoreUserRequest $request)
    {
        $check = $request->only('email', 'password');
    
        if(Auth::attempt($check)) 
        {
            $user = Auth::user();
    
            if($user->role == 'admin') 
            {
                // Membuat agar user tidak bisa mengakses page tertentu melalui address bar atau melalui session tanpa login
                $request->session()->regenerate();
    
                // Membuat agar role setiap user masuk ke dalam session
                session()->put('role', $user->role);
                return redirect('/basketball-courts')
                    ->withCookie(cookie('username', $user->name, 60))
                    ->withCookie(cookie('email', $user->email, 60));
    
            } 
            
            elseif($user->role == 'player') 
            {
                // Membuat agar user tidak bisa mengakses page tertentu melalui address bar atau melalui session tanpa login
                $request->session()->regenerate();
    
                // Membuat agar role setiap user masuk ke dalam session
                session()->put('role', $user->role);
                return redirect('/booking')
                    ->withCookie(cookie('username', $user->name, 60))
                    ->withCookie(cookie('email', $user->email, 60));
            }
        }
    
        return redirect()->back()->with('error', 'Username atau Password Salah');
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        $cookie_username = cookie()->forget('username');
        $cookie_email = cookie()->forget('email');
    
        return redirect('/')->withCookie($cookie_username)->withCookie($cookie_email);
    }
    
}
