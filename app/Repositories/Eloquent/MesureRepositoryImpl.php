<?php

namespace App\Repositories\Eloquent;

use App\Model\TMesure;
use App\Repositories\MesureRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class MesureRepositoryImpl extends BaseRepository implements MesureRepository
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(TMesure $model)
   {
       parent::__construct($model);
   }

   public function  statRestitutionByQuestionnaire($question)
   {

    if($question=="vision"){
        return DB::table('TMesure')
        ->join('TRestitution', 'TMesure.id', '=', 'TRestitution.tMesureId')
        ->select('TMesure.id','TRestitution.value',DB::raw('count(TRestitution.value) as total' ) )
        ->where('TRestitution.tDimensionId',">",7)
        ->where('TRestitution.tDimensionId',"<",11)
        ->groupBy('TMesure.id',"TRestitution.value")
        ->get();
        ;
   }
    }
    
}