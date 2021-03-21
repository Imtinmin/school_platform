<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ctfachieve;
use APIReturn;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CtfachieveController extends Controller
{
    //
    private $ctfachieve;

    public function __construct(Ctfachieve $ctfachieve)
    {
        $this->ctfachieve = $ctfachieve;
    }


    public function getSolvedChallenges(){
        try{
            $user_id = JWTAuth::parseToken()->toUser()->user_id;
            $solved = Ctfachieve::where('user_id',$user_id)->get()->makeHidden(['ctfachieve_id']);
            return APIReturn::success($solved);
        }catch (JWTException $error){
            return APIReturn::error("token_invalid");
        }
    }



}
