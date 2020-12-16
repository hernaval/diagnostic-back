<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Question;
use \App\User;

class Dimension extends Model
{
    //
    protected $table = "dimension";
    protected $guarded = [''];

    public function user()
    
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function createAndAsignUser($user,$question,$data)
    {
        return Dimension::create(
            [
                'reponse1' => $data['reponse1'],
                'reponse2' => $data['reponse2'],
                'reponse3' => $data['reponse3'],
                'userId' => $user,
                'questionId' => $question
            ]
        );
    }
}
