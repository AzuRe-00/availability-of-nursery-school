<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use IlluminateAuth\Events\Registered;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{
    public function create()
    {
        return view('register');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' .User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        event(new Registered($user));
        
        Auth::guard('user')->login($user);
        
        return redirect(RouteServiceProvider::Home);
    }
    
    public function index()
    {
        if (Auth::guard('members')->user()){
            return redirect()->route('dashboard');
        }
        
        return view('main');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        
        if (Auth::guard('members')->attempt($credentials)){
            return redirect()->route('user.dashboard')->with([
                'login_msg' => 'ログインしました！',
            ]);
        }
        
        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::guard('members')->logout();
        $request->session()->regenerateToken();
        
        return redirect()->route('login.index')->with([
            'auth' => ['ログアウトしました！'],
        ]);
    }
}
