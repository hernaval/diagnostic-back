<?php

namespace App\Model;
use \App\User;
use TMesure;
use TDimension;

use Illuminate\Database\Eloquent\Model;

class TRestitution extends Model
{
    protected $table = 'TRestitution';
    protected $guarded = [''];

    public function user()
    
    {
        return $this->belongsTo(User::class);
    }

    public function tMesure()
    {
        return $this->belongsTo(TMesure::class);
    }

    public function tDimension()
    {
        return $this->belongsTo(TDimension::class);
    }
}
