<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        switch (auth()->user()->role){
            case 'admin':
                return view('users.index', compact('users'));
                break;
            case 'officer':
                return redirect()->route('dashboard');
                break;
            default:
                return redirect()->route('dashboard');
                break;
        }
        
    }
}
