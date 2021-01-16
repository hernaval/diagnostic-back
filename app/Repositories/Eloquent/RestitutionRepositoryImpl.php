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
    $bulk = [] ;


    for($i = 0; $i < count($mesures) ; $i++){
        array_push($bulk, [
            'tDimensionId' => $data['dimension'],
            'tMesureId' => $mesures[$i]["id"],
            'value' => $mesures[$i]['value'],
            'userId' => auth('api')->user()->id
          
        ]);
        
    }

     $this->model->insert($bulk);

    
   }


}