<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Dimension;
use \App\User;
use \App\Question;
class DimensionController extends Controller
{
    
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        
    }


    public function create(Request $req)
    {
        
        $validator = Validator::make($req->all(),[
            'dimension' => 'required',
            'reponse1' => 'required',
            'reponse2' => 'required',
            'reponse3' => 'required'
        ]);

        

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $q = new Question;
        $user_id = auth('api')->user()->id;
        $question_id = $q->getById($req->dimension)->id;

        $dim = new Dimension;
        $newDimension = null;

        $isResponded = $dim->checkIfUserHasResponded($user_id,$question_id);

       

        if(!$isResponded){   
            $newDimension = $dim->createAndAsignUser($user_id,$question_id, $validator->validated());

        }else{
            $newDimension = $dim->updateDimension($user_id,$question_id, $validator->validated());
        }


        return response()->json([
            'message' => "response send",
            "data" => $newDimension
        ]);
    }
}
