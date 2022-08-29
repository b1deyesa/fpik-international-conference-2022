<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->role_id != 2) { return redirect('/'); }
        
        return view('admin', [
            'users' => User::where('name', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('institution', 'LIKE', '%' . $request->search . '%')
                            ->get(),
            'status' => User::whereNotIn('id', array(1))->orderBy('status_id', 'DESC')->get()
        ]);
    }
    
    public function status($status)
    {
        return view('admin', [
            'users' => User::whereNotIn('id', array(1))->where('status_id', $status)->get(),
            'status' => User::whereNotIn('id', array(1))->orderBy('status_id', 'DESC')->get()
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

    public function export()
    {
        return Excel::download(new UserExport, 'backup-icsbe.xlsx'); 
    }
}
