<?php

namespace App\Http\Controllers;
use \App\Repositories\UserRepository;
use \App\Repositories\RestitutionRepository;

use Illuminate\Http\Request;
use Validator;

class RestitutionController extends Controller
{
    private $userRepository;
    private $restitutionRepo;
    private $mesureRepo;

    public function __construct(UserRepository $userRepository,
     RestitutionRepository $restitutionRepo
     )
    {
        $this->middleware("api",['expect' =>["create"]]);
        $this->userRepository = $userRepository;
        $this->restitutionRepo = $restitutionRepo;
      
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

        return response()->json("ok");
    }
}
