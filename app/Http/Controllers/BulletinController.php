<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bulletin;
use App\User;
use APIReturn;

class BulletinController extends Controller
{
    //
    private $bulletin;

    public function __construct(Bulletin $bulletin)
    {
        $this->bulletin = $bulletin;
    }

    public function add(Request $request){
        $validator = \Validator::make($request->all(),[
            'content' => 'required',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $newbulletin = new Bulletin();
            $newbulletin->bulletin_content = $request->input('content');
            $newbulletin->save();
            return APIReturn::success($newbulletin,"添加成功");
        }catch (\Exception $err){
            //echo $err;
            return APIReturn::error("database_error");
        }
    }

    public function del(Request $request){
        $validator = \Validator::make($request->only('Bulletin_id'),[
            'Bulletin_id' => 'required|numeric',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $bulletin_id = $request->input('Bulletin_id');
            $bulletin = Bulletin::find($bulletin_id);
            $bulletin->delete();
            return APIReturn::success("删除公告成功");
        }catch(\Exception $err){
            return APIReturn::error("database_error");
        }
    }

    public function list(Request $request){
        try{
            $BulletinList = Bulletin::orderBy('created_at','desc')->get();
            return APIReturn::success($BulletinList);
        }catch (\Exception $err){
            return APIReturn::error("database_error");
        }
    }

    public function edit(Request $request){
        $validator = \Validator::make($request->all(),[
            'Bulletin_id' => 'required|numeric',
            'content' => 'required',
            //'time' => 'required'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try {
            $bulletin_id = $request->input('Bulletin_id');
            $bulletin = Bulletin::find($bulletin_id);
            $bulletin->bulletin_content = $request->input('content');
            //$bulletin->created_time = $request->input('time');
            $bulletin->save();
            return APIReturn::success($bulletin,"修改成功");
        }catch (\Exception $error){
            //echo $error;
            return APIReturn::error("database_error");
        }
    }

}
