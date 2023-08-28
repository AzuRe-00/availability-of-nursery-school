<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('main');
    }
}
