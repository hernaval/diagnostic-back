<?php

namespace App\Http\Controllers;
use \App\Repositories\UserRepository;
use \App\Repositories\RestitutionRepository;

use Illuminate\Http\Request;
use Validator;
use \App\Model\Activity;

class RestitutionController extends Controller
{
    private $userRepository;
    private $restitutionRepo;
    private $mesureRepo;

    public function __construct(UserRepository $userRepository,
     RestitutionRepository $restitutionRepo
     )
    {
        $this->middleware("api");
        $this->userRepository = $userRepository;
        $this->restitutionRepo = $restitutionRepo;
      
        $this->activit = new Activity;
        $this->activitType = Activity::type();

    }

    public function create(Request $req)
    {

        $validator = Validator::make($req->all(),[
            'dimension' => 'required',
            'mesures' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $this->restitutionRepo->addOrUpdateResponse($validator->validated());

        //activity
        $this->activit->asignActivityToUser($this->activitType['post_questionnaire'],"vision");


        return response()->json("ok");
    }

    public function last()
    {
        $question = request()->questionnaire;
        $restitution = null;
      
        if($question =="maturite"){
           
            $restitution = $this->restitutionRepo->userMaturiteRestitution();
        }else{
            $restitution = $this->restitutionRepo->userVisionResitution();
        }
       
       //activity
       $this->activit->asignActivityToUser($this->activitType['get_questionnaire'],"vision");

        return response()->json($restitution);
    }

    public function destroy()
    {
        $question = request()->questionnaire;

        
            $this->restitutionRepo->deleteUserRestitution($question);

        //activity
       $this->activit->asignActivityToUser($this->activitType['delele_questionnaire'],"vision");

        
            return response()->json("ok deleted");
    }
}
