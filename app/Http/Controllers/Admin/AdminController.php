<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Admin;
use IlluminateAuth\Events\Registered;
use App\Providers\RouteServiceProvider;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin.register');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' .Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        event(new Registered($admin));
        
        Auth::guard('admin')->login($admin);
        
        return redirect(RouteServiceProvider::Home);
    }
    
    public function index()
    {
        return view('admin.login.index');
        
    }
    
    public function login(Request $request)
    {
        $credentials = $request-> only(['email', 'password']);
        
        if(Auth::guard('admins')->attempt($credentials)){
            return redirect()->route('admin.dashboard')->with([
                'login_msg' => 'ログインしました！',
            ]);
        }
        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->regenerateToken();
        
        return redirect()-> route('admin.login.index')->with([
            'logout_msg' => 'ログアウトしました！',
        ]);
    }
}
