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


    public function statByDimension($id)
    {
        $res = $this->mesureRepo->statRestitutionByDimension($id);

        return response()->json($res);
    }
}
