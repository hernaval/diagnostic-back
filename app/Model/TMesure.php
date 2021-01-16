<?php

namespace App\Model;
use TDimension;
use TRestitution;

use Illuminate\Database\Eloquent\Model;

class TMesure extends Model
{
    protected $table = 'TMesure';
    protected $guarded = [''];

    public function tDimension()
    {
        return $this->belongsTo(\App\Model\TDimension::class);
    }

    public function tRestitutions()
    {
        return $this->hasMany(TRestitution::class);
    }
}
