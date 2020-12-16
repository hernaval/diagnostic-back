<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \App\Dimension;
use \App\Question;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomUser', 'email', 'password','prenomUser','fonctionUser','organisationUser','codeConfirmUser','social'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dimensions()
    {
        return $this->hasMany(Dimension::class);
    }

    public function isUserEmailExist($email)
    {
        return User::where(['email' => $email])->first() != null;
    }
    
    public function isUserEmailConfirm($email)
    {
        $user =  User::where([
            'email' => $email,
          
            ])->first();
        
        return $user->codeConfirmUser != "";
    }

    public static function randomPass($n){
        $characters = '0123456789'; 
        $randomString = ''; 

        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString; 
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }    
}
