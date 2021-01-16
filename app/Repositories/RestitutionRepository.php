<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface RestitutionRepository
{
   //public function all(): Collection;
   public function addOrUpdateResponse(array $data) ;

   public function statByDimensions($dimensionId);
}