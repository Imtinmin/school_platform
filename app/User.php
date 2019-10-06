<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Boolean;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','signUpTime','lastLoginTime','token'    //可控写入
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
        'score' => 'integer',
    ];
    /*protected $casts = [
        //'email_verified_at' => 'datetime',
        'admin' => 'boolean',
        'banned' => 'boolean',
    ];*/
    protected $primaryKey = "user_id";

    public $timestamps = false;


    public function test()
    {
        return $this->hasMany('App\Ctfachieve','user_id');
    }


    public function challenges(){
        return $this->hasManyThrough(
            'App\Challenge',    //target table
            'App\Ctfachieve',   //through table
            'user_id',          //user table Foreign key
            'qid',           //ctfachieve table Foreign key
            'user_id',          //local key on users
            'qid');     //local key on ctfachieve
    }

}
