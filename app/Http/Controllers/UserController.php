<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        return view('user');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email|unique:users,email',
            'status' => 'required'
        ]);

        // Access Code
        $access_code = Str::upper(fake()->bothify('ICSBE##???'));

        $user = new User;
        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->status_id      = $request->status;
        $user->remember_token = Str::random(10);
        $user->password       = Hash::make($access_code);
        $user->save();
        
        PaymentController::store($user);
        ArticleController::store($user);

        // Send Mail
        Mail::to($request->email)->send(new SendCode($request->name,$access_code));
        
        return back()->with('success', 'Regist success, please check your email');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'        => 'required',
            'phone'       => 'nullable',
            'institution' => 'nullable',
            'article'     => 'nullable|max:100000',
        ]);

        $user = User::find($user->id);
        $user->name        = $request->name;
        $user->phone       = $request->phone;
        $user->institution = $request->institution;
        $user->save();

        ArticleController::update($request,$user);

        return back()->with('success', 'Update success');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);

 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/user');
        }
 
        return back()->withErrors(["password" => "Email and Access code doesn't match"]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect(route('login'));
    }
}