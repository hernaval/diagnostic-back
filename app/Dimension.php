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

    public function checkIfUserHasResponded($user,$question)
    {
        return Dimension::where([
            'userId' => $user,
            'questionId' =>$question
        ])->first() !== null ;
    }

    public function update($user,$question,$data)
    {
        $dimensionToUpdate = Dimension::where([
            'userId' =>$user,
            "questionId" =>$question
        ])->first();

        $dimensionToUpdate->reponse1 = $data['reponse1'];
        $dimensionToUpdate->reponse2 = $data['reponse2'];
        $dimensionToUpdate->reponse3 = $data['reponse3'];
        
        return $dimensionToUpdate->save();
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
