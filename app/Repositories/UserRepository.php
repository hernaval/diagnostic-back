<?php
namespace App\Repositories;

use App\Model\User;
use Illuminate\Support\Collection;

interface UserRepository
{
   public function all(): Collection;
}