<?php

namespace App\Http\Controllers;

use App\Models\FullPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FullPaperController extends Controller
{
    public static function store($user)
    {
        return FullPaper::create([ 'user_id' => $user->id]);
    }

    public static function update($request,$user)
    {
        if($request->fullpaper != null)
        { 
            $fullpaper = $request->file('fullpaper');
            $fullpaper->storeAs('public/fullpaper', $fullpaper->hashName());
            Storage::delete('public/fullpaper/' . $user->fullpaper->path);
            
            return FullPaper::where('user_id', $user->id)->update([
                'name' => $fullpaper->getClientOriginalName(),
                'path' => $fullpaper->hashName()
            ]);
        }
            
    }

    public function download(FullPaper $fullpaper)
    {
        $path = 'storage/fullpaper/' . $fullpaper->path;        
        $name = $fullpaper->name;
        
        return response()->download($path, $name);

    }
}
