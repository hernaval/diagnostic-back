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

    $response =  $this->model->where(function ($query) use ($data){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",$data["dimension"])
        ;
    });

    if(count($response->get()) > 0){
       $response->delete();
    }

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

   public function userMaturiteRestitution()
   {
       $param = 2;

       $reponse_for_1 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",1)
        ;
    })->get();

    $reponse_for_2 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",2)
        ;
    })->get();

    $reponse_for_3 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",3)
        ;
    })->get();

    $reponse_for_4 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",4)
        ;
    })->get();

    $reponse_for_5 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",5)
        ;
    })->get();

    $reponse_for_6 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",6)
        ;
    })->get();

    $reponse_for_7 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",7)
        ;
    })->get();

    $responded_1 = count($reponse_for_1); 
    $responded_2 = count($reponse_for_2); 
    $responded_3 = count($reponse_for_3); 
    $responded_4  = count($reponse_for_4);
    $responded_5  = count($reponse_for_5);
    $responded_6  = count($reponse_for_6);
    $responded_7= count($reponse_for_7);

    $formatted_dimension2 = [];

    if($responded_1 == 0){
       
        for($i=0; $i<$responded_1;$i++){
            $formatted_dimension2[0][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_1;$i++){
            $formatted_dimension2[0][$i] =$reponse_for_1[$i]->value;
        }
    }

    if($responded_2 ==0){
        for($i=0; $i<3;$i++){
            $formatted_dimension2[1][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_2;$i++){
            $formatted_dimension2[1][$i] =$reponse_for_2[$i]->value;
        }
    }

    if($responded_3 ==0){
        for($i=0; $i<3;$i++){
            $formatted_dimension2[2][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_3;$i++){
            $formatted_dimension2[2][$i] =$reponse_for_3[$i]->value;
        }
    }

    if($responded_4 ==0){
        for($i=0; $i<3;$i++){
            $formatted_dimension2[3][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_4;$i++){
            $formatted_dimension2[3][$i] =$reponse_for_4[$i]->value;
        }
    }

    if($responded_5 ==0){
        for($i=0; $i<3;$i++){
            $formatted_dimension2[4][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_5;$i++){
            $formatted_dimension2[4][$i] =$reponse_for_5[$i]->value;
        }
    }

    if($responded_6 ==0){
        for($i=0; $i<3;$i++){
            $formatted_dimension2[5][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_6;$i++){
            $formatted_dimension2[5][$i] =$reponse_for_6[$i]->value;
        }
    }

    if($responded_7 ==0){
        for($i=0; $i<3;$i++){
            $formatted_dimension2[6][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_7;$i++){
            $formatted_dimension2[6][$i] =$reponse_for_7[$i]->value;
        }
    }

       
     
       //for($i=1;$i<=7;$i++){
          
       
        //    $response = $this->model->where(function ($query) use ($i){
        //         $query
        //         ->where("userId",7)
        //         ->where("tDimensionId",$i)
        //         ;
        //     })->get();

        //     $items = count($response);
           
        //     if($items == 0){
        //         for($j=0; $j<$items;$j++){
        //             $formatted_dimension[$i][$j] =null;
        //         }
        //     }else{
        //         for($j=0; $j<$items;$j++){
        //             $formatted_dimension[$i][$j] =$response[$j]->value;
        //         }
        //     }
        

       // }

       return $formatted_dimension2 ;
       
   }

   public function userVisionResitution()
   {
    $param = 2;
   

    $reponse_for_1 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",8)
        ;
    })->get();

    $reponse_for_2 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",9)
        ;
    })->get();

    $reponse_for_3 =  $this->model->where(function ($query) use ($param){
        $query
        ->where("userId",auth('api')->user()->id)
        ->where("tDimensionId",10)
        ;
    })->get();


    // 6 11 18
    $responded_1 = count($reponse_for_1); 
    $responded_2 = count($reponse_for_2); 
    $responded_3 = count($reponse_for_3); 

    $formatted_dimension;

    if($responded_1 == 0){
        for($i=0; $i<6;$i++){
            $formatted_dimension[0][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_1;$i++){
            $formatted_dimension[0][$i] =$reponse_for_1[$i]->value;
        }
    }

    if($responded_2 ==0){
        for($i=0; $i<5;$i++){
            $formatted_dimension[1][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_2;$i++){
            $formatted_dimension[1][$i] =$reponse_for_2[$i]->value;
        }
    }

    if($responded_3 ==0){
        for($i=0; $i<7;$i++){
            $formatted_dimension[2][$i] =null;
        }
    }else{
        for($i=0; $i<$responded_3;$i++){
            $formatted_dimension[2][$i] =$reponse_for_3[$i]->value;
        }
    }

    

    

    return $formatted_dimension;
   }

   public function deleteUserRestitution($question)
   {
       $param = 2;
       if($question == "maturite"){
        $this->model->where(function ($query) use ($param){
            $query
            ->where("userId",auth('api')->user()->id)
            ->where("tDimensionId",">",0)
            ->where("tDimensionId","<",8)
            ;
        })->delete();
       }
       if($question == "vision"){
        $this->model->where(function ($query) use ($param){
            $query
            ->where("userId",auth('api')->user()->id)
            ->where("tDimensionId",">",8)
            ->where("tDimensionId","<",11)
            ;
        })->delete();
       }
   }


}