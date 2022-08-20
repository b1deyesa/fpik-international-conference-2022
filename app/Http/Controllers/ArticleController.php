<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public static function store($user)
    {
        return Article::create([ 'user_id' => $user->id]);
    }

    public static function update($request,$user)
    {
        if($request->article != null)
        { 
            $article = $request->file('article');
            $article->storeAs('public/article', $article->hashName());
            Storage::delete('public/article/' . $user->article->path);
            
            return Article::where('user_id', $user->id)->update([
                'name' => $article->getClientOriginalName(),
                'path' => $article->hashName()
            ]);
        }
            
    }

    public function download(Article $article)
    {
        $path = 'storage/article/' . $article->path;        
        $name = $article->name;
        
        return response()->download($path, $name);

    }
}
