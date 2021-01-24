<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface MesureRepository
{
  public function statRestitutionByQuestionnaire($id);
}