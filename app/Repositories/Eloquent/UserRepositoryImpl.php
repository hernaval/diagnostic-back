<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Collection;

class UserRepositoryImpl extends BaseRepository implements UserRepository
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }
}