<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        if(auth()->user()->role_id != 2) { return redirect('/'); }
        return view('admin', [
            'users' => User::whereNotIn('id', array(1))->orderBy('status_id', 'DESC')->get(),
        ]);
    }

    public function setAdmin(User $user)
    {
        User::where('id',$user->id)->update(['role_id' => 2]);
        return back();
    }
    
    public function getAdmin(User $user)
    {
        User::where('id',$user->id)->update(['role_id' => 1]);
        return back();
    }
}
