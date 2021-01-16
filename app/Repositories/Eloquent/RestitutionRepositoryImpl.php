<?php

namespace App\Repositories\Eloquent;

use App\Model\TRestitution;
use App\Repositories\RestitutionRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class RestitutionRepositoryImpl extends BaseRepository implements RestitutionRepository
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(TRestitution $model)
   {
       parent::__construct($model);
   }

   public function addOrUpdateResponse(array $data) 
   {

    $mesures = $data["mesures"];

    for($i = 0; $i < count($mesures)  ; $i++){
        $this->model->create([
            'tDimensionId' => $data['dimension'],
            'tMesureId' => $mesures[$i]["id"],
            'value' => $mesures[$i]['value'],
            'userId' => auth('api')->user()->id
        ]);
    }

    
   }

   public function statByDimensions($id)
    {
        
        return $this->model
        ->select(DB::raw('count(*) as total' ),"value","tMesureId")
        ->where([
            'tDimensionId' =>$id,
            'tMesureId' => 1
        ])
        ->orderBy("value","asc")
        ->groupBy("value","tMesureId")
        ->get();
        
    }

    

}