<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin', [
            'users' => User::orderBy('status_id', 'DESC')->get()
        ]);
    }

    public function setAdmin(User $user)
    {
        User::where('id', $user->id)->update(['role_id' => 2]);

        return back();
    }
}
