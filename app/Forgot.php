<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forgot extends Model
{
    protected $guarded = [''];
    protected $table ="forgot";

    public function user()
    {
        return $this->hasOne(\App\User::class);
    }

    public function createForgotTokenLink($data)
    {
        return Forgot::create($data);
    }

    public function isValid($token)
    {
        return Forgot::where(['token' => $token,'isValid' => true])->first() !== null;
    }

    public function getUserByToken($token)
    {
        return Forgot::where(['token' =>$token])->first();
    }

    public function deleteByToken($token)
    {
        Forgot::where(['token' => $token])->delete();
    }

}
