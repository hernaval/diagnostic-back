<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Repositories\MesureRepository;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    private $mesureRepo;

    public function __construct(MesureRepository $mesureRepo)
    {
        $this->mesureRepo = $mesureRepo;
    }


    public function statByDimension()
    {
        $question = request()->questionnaire;

        
        $res = $this->mesureRepo->statRestitutionByQuestionnaire($question);

        return response()->json($res);
    }
}
