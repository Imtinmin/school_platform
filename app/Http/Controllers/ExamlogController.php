<?php

namespace App\Http\Controllers;

use App\Examlog;
use App\User;
use APIReturn;
use Illuminate\Http\Request;

class ExamlogController extends Controller
{
    //
    public function list()
    {
        try{
            $data = Examlog::all()->each(function($item,$value){
                $item->userName = User::find($item->user_id)->name;
            });
            return APIReturn::success($data);
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }

    public function DelLog(Request $request)
    {
        try{

        }catch (\Exception $error){

        }

    }

    //public function

}
