<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Dimension;

class Question extends Model
{
    protected $table = "question";
    protected $guarded = [''];

    public function dimensions(){
        return $this->hasMany(Dimension::class);
    }

    public function getByCate($cate)
    {
        return Question::where(['categorieQuestion' => $cate])->first()->id;
    }

    public function getById($id)
    {
        return Question::find($id);
    }
}
