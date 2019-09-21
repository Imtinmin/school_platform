<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use APIReturn;


class ChallengeController extends Controller
{

    private $challenge;

    /**
     * ChallengeController constructor.
     * @param Challenge $challenge
     */
    public function __construct(Challenge $challenge)
    {
        $this->challenge = $challenge;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author tinmin
     */
    public function create(Request $request){
        $validator = \Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'score' => 'required|numeric',
            'level_id' => 'required|numeric|max:5|min:0'  //level 0-5
        ],[
            'title.required' => '名称不能为空',
            'score.required' => '分数不能为空',
            'description.required' => '说明不能为空',
            'score.numeric' => '分数格式不符',
            'level_id.required' => '缺少级别字段',
            'level_id.numeric' => '级别格式不符'
        ]);
        if($validator->fails()){
            return APIReturn::fail($validator->errors()->all());
        }
        try{
            $this->challenge->create([
                'title' => $request->input('title'),
                'url' => $request->input('url'),
                'description' => $request->input('description'),
                'score' => $request->input('score'),
                'level_id' => $request->input('level_id'),
            ]);
        }catch (Exception $err){
            return APIReturn::fail('database_error');
        }
        return APIReturn::success($request->only('title','description','score'));
    }

    public function getAllChallenges(){

    }

    public function info(){

    }




}
