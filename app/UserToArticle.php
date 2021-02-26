<?php

namespace App;
use User;
use Article;

use Illuminate\Database\Eloquent\Model;

class UserToArticle extends Model
{
    protected $guarded = [''];

    public function user()
    
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    
    {
        return $this->belongsTo(Article::class);
    }


}
