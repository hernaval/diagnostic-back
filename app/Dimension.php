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

    public function updateDimension($user,$question,$data)
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

    public function userLastDimension($user)
    {
        $reponse_for_7_dimensions = Dimension::where(function($query) use($user){
            $query->where('questionId','>',0)
                  ->where('questionId','<',8)
                  ->where('userId',$user)  ;
        })->get();

        $responded = count($reponse_for_7_dimensions);

        $formatted_dimension;

        $i =0;
        while($i < 7){

            if($i > $responded - 1){
                $formatted_dimension[$i][0] = null;
                $formatted_dimension[$i][1] = null;
                $formatted_dimension[$i][2] = null;
            }else{
               

                $formatted_dimension[$i][0] =  (int) $reponse_for_7_dimensions[$i]->reponse1;
                $formatted_dimension[$i][1] = (int) $reponse_for_7_dimensions[$i]->reponse2;
                $formatted_dimension[$i][2] = (int) $reponse_for_7_dimensions[$i]->reponse3;
            }
            $i++;
        }

       

        return $formatted_dimension;
    }

    public function userDimension($user)
    {
        return  Dimension::where(function($query) use($user){
            $query->where('questionId','>',0)
                  ->where('questionId','<',8)
                  ->where('userId',$user)  ;
        })->get();
    }

    public function deleteUserDimension ($user)
    {
        $dimension = Dimension::where(function($query) use($user){
            $query->where('questionId','>',0)
                  ->where('questionId','<',8)
                  ->where('userId',$user)  ;
        })->delete();

        return true;
    }
}
