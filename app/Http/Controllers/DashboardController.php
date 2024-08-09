<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // show the dashboard based on user role

        $user = Auth::user();
        if ($user->role == 1) {
            // Admin: fetch all users with role 0 only
            $users = User::where('role', 0)->get();
            return view('admin', ['users' => $users]);
        }else {
            // Regular user: fetch only their own details
            return view('user', ['user' => $user]);
        }
    }
}
