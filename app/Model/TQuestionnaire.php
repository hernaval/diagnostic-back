<?php

namespace App\Model;

use TDimension;
use Illuminate\Database\Eloquent\Model;

class TQuestionnaire extends Model
{
    protected $table = 'TQuestionnaire';
    protected $guarded = [''];

    public function tDimensions()
    {
        return $this->hasMany(TDimension::class);
    }
}
