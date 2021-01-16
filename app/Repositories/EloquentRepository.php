<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepository
{
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;
}