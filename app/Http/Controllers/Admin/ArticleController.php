<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Article;
class ArticleController extends Controller
{
    public function store(Request $req){

        return response()->json(
            Article::create($req->all())
        );
    }

    public function index()
    {
        return response()->json(
            Article::all()
        );
    }

    public function remove($id)
    {
        return response()->json(
            Article::where(['id' => $id])->delete()
        );
    }
}
