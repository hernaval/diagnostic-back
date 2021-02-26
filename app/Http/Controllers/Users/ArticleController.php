<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserToArticle;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json(
          Article::all()
        );
    }
    public function save(Request $req){
        $articleId = $req->articleId;

        $user = auth('api')->user();

        return response()->json(
            UserToArticle::create([
                'articleId' => $articleId,
                'userId' => $user->id
            ])
            );

    }

    public function show()
    {
        $user = auth('api')->user();
        return response()->json(
            UserToArticle::where(function($query) use($user){
                $query->where('userId',$user->id)  ;
            })->get()
        );
    }

    public function remove($id){
        $user = auth('api')->user();

        return response()->json(
            UserToArticle::where(function($query) use($id){
                $query->where('articleId',$id)  ;
            })->delete()
        );
    }
}
