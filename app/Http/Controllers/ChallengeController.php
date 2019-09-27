<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use App\Level;
use App\Category;
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
            'category_id' => 'required|numeric',
            'url' => 'required|url'
        ],[
            'title.required' => '名称不能为空',
            'score.required' => '分数不能为空',
            'description.required' => '说明不能为空',
            'score.numeric' => '分数格式不符',
            'category_id.required' => '缺少类型字段',
            'category_id.numeric' => '类型ID格式不符',
            'url.required' => '题目链接不能为空',
            'url.url' => '题目格式不符',
        ]);

        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        if(!Category::find($request->input('category_id'))){
            return APIReturn::error('category_id is not exists');
        }

        try{
            $newChallenge = new Challenge();
            $newChallenge->title = $request->input('title');
            $newChallenge->description = $request->input('description');
            $newChallenge->score = $request->input('score');
            $newChallenge->category_id = $request->input('category_id');
            $newChallenge->category_name = Category::find($request->input('category_id'))->category_name;
            $newChallenge->url = $request->input('url');
            $newChallenge->save();

        }catch (Exception $err){
            return APIReturn::error('database_error');
        }
        return APIReturn::success($newChallenge);
    }

    public function list(){
        try{
            $categories = Category::with('challenges')->get();
            $categories->makeHidden(['updated_at','created_at']);
        //$categories->challenges->makeHidden(['updated_at','created_at']);
            return APIReturn::success($categories);
        }catch (\Exception $err){
            return APIReturn::error('database_error');
        }
    }

    public function info(){

    }





}
