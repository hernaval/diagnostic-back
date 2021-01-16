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

   public function  statRestitutionByDimension($id)
   {
    return DB::table('tmesure')
        ->join('trestitution', 'tmesure.id', '=', 'trestitution.tMesureId')
        ->select('tmesure.id','trestitution.value',DB::raw('count(trestitution.value) as total' ) )
        ->where('trestitution.tDimensionId',$id)
        ->groupBy('tmesure.id',"trestitution.value")
        ->get();
        ;
   }
}