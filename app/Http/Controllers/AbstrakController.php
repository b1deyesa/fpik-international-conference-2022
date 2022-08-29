<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use App\Models\FullPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbstrakController extends Controller
{
    public function index()
    {
        return view('abstract-fullpaper', [
            'abstracts'  => Abstrak::whereNotNull('name')->get(),
            'fullpapers' => FullPaper::whereNotNull('name')->get()
        ]); 
    }

    public static function store($user)
    {
        return Abstrak::create([ 'user_id' => $user->id]);
    }

    public static function update($request,$user)
    {
        if($request->abstrak != null)
        { 
            $abstrak = $request->file('abstrak');
            $abstrak->storeAs('public/abstrak', $abstrak->hashName());
            Storage::delete('public/abstrak/' . $user->abstrak->path);
            
            return Abstrak::where('user_id', $user->id)->update([
                'name' => $abstrak->getClientOriginalName(),
                'path' => $abstrak->hashName()
            ]);
        }
            
    }

    public function download(Abstrak $abstrak)
    {
        $path = 'storage/abstrak/' . $abstrak->path;        
        $name = $abstrak->name;
        
        return response()->download($path, $name);

    }
}
