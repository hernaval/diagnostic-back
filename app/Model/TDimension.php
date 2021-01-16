<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use TQuestionnaire;
use TMesure;
use TRestitution;

class TDimension extends Model
{
    protected $table = 'TDimension';
    protected $guarded = [''];

    public function tQuestionnaire()
    {
        return $this->belongsTo(TQuestionnaire::class);
    }

    public function tMesures()
    {
        return $this->hasMany(TMesure::class);
    }

    public function tRestitutions()
    {
        return $this->hasMany(TRestitution::class);
    }
}
