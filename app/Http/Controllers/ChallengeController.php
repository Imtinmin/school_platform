<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Challenge;
use App\Level;
use App\Category;
use App\Ctfachieve;
use APIReturn;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


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
            'url' => 'required|url',
            'flag' => 'required'
        ],[
            'title.required' => '名称不能为空',
            'score.required' => '分数不能为空',
            'description.required' => '说明不能为空',
            'score.numeric' => '分数格式不符',
            'category_id.required' => '缺少类型字段',
            'category_id.numeric' => '类型ID格式不符',
            'url.required' => '题目链接不能为空',
            'url.url' => '题目链接格式不符',
            'flag.required' => 'flag不能为空'
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
            //$newChallenge->category_name = Category::find($request->input('category_id'))->category_name;
            $newChallenge->url = $request->input('url');
            $newChallenge->flag = $request->input('flag');
            $newChallenge->save();

        }catch (Exception $err){
            return APIReturn::error('database_error');
        }
        return APIReturn::success($newChallenge);
    }

    public function list(){
        try{
            $user = JWTAuth::parseToken()->toUser();
            try{
                $categories = Category::with('challenges')->get();
                $categories->makeHidden(['updated_at','created_at']);
                $categories->each(function ($category) use(&$user){
                $category->challenges->each(function ($challenges) use (&$user){
                  $challenges->solvecount = Ctfachieve::where('qid',$challenges->qid)->count();
                  if(!$user->admin){
                      $challenges->makeHidden(['flag','created_at','updated_at']);
                  }
               });
            });
                return APIReturn::success($categories);
            }catch (\Exception $err){
                //echo $err;
                return APIReturn::error('database_error');
            }
        }catch (JWTException $err){
            return APIReturn::error('token_invalid');
        }
    }

    public function ChallengeRank(Request $request){
        try{
            $qid = $request->input('qid');
            $rank = Ctfachieve::where('qid',$qid)->orderBy('AchieveTime')->get();
            return APIReturn::success($rank);
        }catch (\Exception $error){
            //echo $error;
            return APIReturn::error("database_error");
        }
    }


    /**
     * 提交答案
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function SubmitFlag(Request $request){
        $validator = \Validator::make($request->all(),[
            'qid' => 'required',
            'flag' => 'required',
        ],[
            'qid.required' => '题目ID不能为空',
            'flag.required' => 'flag字段不能为空',
        ]);

        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $user_id = JWTAuth::parseToken()->toUser()->user_id;
            //题目是否存在
            if(!$challenge = Challenge::find($request->input('qid'))){
                return APIReturn::error("题目不存在");
            }
            //检查是否提交过这题flag
            if(Ctfachieve::where('qid',$request->input('qid'))
                ->where('user_id',$user_id)
                ->first()){
                if($request->input('flag') === $challenge->flag){
                    return APIReturn::error("flag正确,但你已经提交过这题flag了");
                }else{
                    return APIReturn::error("flag错误,你已经提交过这题flag了");
                }
            }
            if($request->input('flag') === $challenge->flag){
                //回答正确记录进表里
                try{
                    //更新用户表的分数
                    User::where('user_id',$user_id)->update(['score' => User::find($user_id)->score + $challenge->score]);
                    //echo User::find($user_id)->score + $challenge->score;
                    $archieve = new Ctfachieve();
                    $archieve->qid = $request->input('qid');
                    $archieve->user_id = $user_id;
                    $archieve->AchieveTime = Carbon::now('Asia/Shanghai');
                    $archieve->save();

                }catch (\Exception $err){
                    //echo $err;
                    return APIReturn::error("database_error");
                }
                return APIReturn::success(['score' => $challenge->score],"flag正确");
            }else{
                return APIReturn::error("flag错误");
            }
        }catch (JWTException $err){
            return APIReturn::error('token_invalid');
        }

    }

    /**
     * 解决人数
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function solvedUsers(Request $request){
        $validator = \Validator::make($request->only(['qid']), [
            'qid' => 'required'
        ], [
            'qid.required' => '缺少 题目ID 字段'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        $qid = $request->input('qid');
        if(!Challenge::find($qid)){
            return APIReturn::error('题目不存在',404);
        }
        try{
            $logs = Ctfachieve::where('qid','=',$qid)->with(['users'])->orderBy('AchieveTime')->get();
            $result = [];

            $logs->each(function ($log) use (&$result){
		if(!$log->users->admin){
                array_push($result,[
                    'name' => $log->users->name,
                    'solvedAt' => $log->AchieveTime,
                ]);
		}

            });
            return APIReturn::success($result);
        }catch(\Exception $error){
            //echo $error;
            return APIReturn::error("database_error",500);
        }

    }

    public function CreateChallenge(){
        try{
            for ($i =0;$i<=50;$i++){
                Challenge::create([
                    'title' => 'test'.$i,
                    'url' => '',
                    'flag' => '1',
                    'description' => 'test',
                    'score' => 10,
                    'category_id' => [1,2,3,4,5][array_rand([1,2,3,4,5])]
                ]);
            }
            return APIReturn::success(null,"创建测试题目成功");

        }catch (\Exception $err){
            return APIReturn::error("database_error");
        }
    }

    /**
     * 删除题目
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function DeleteChallenge(Request $request){
        $validator = \Validator::make($request->only(['qid']), [
            'qid' => 'required'
        ], [
            'qid.required' => '缺少 题目ID 字段'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $challenge = Challenge::find($request->input('qid'));
            $ctfachieve = Ctfachieve::where('qid',$request->input('qid'));  //删除该题解题记录
            $challenge->delete();
            $ctfachieve->delete();
            return APIReturn::success($challenge,"操作成功");
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }

    }

    /**
     * 更改题目
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function UpdateChallenge(Request $request){
        $validator = \Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'score' => 'required|numeric',
            'url' => 'required|url',
            'flag' => 'required'
        ],[
            'title.required' => '名称不能为空',
            'score.required' => '分数不能为空',
            'description.required' => '说明不能为空',
            'score.numeric' => '分数格式不符',
            'url.required' => '题目链接不能为空',
            'url.url' => '题目链接格式不符',
            'flag.required' => 'flag不能为空'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $challenge = Challenge::find($request->input('qid'));
            if(!$challenge){
                return APIReturn::error("题目不存在");
            }
            $challenge->title = $request->input('title');
            $challenge->url = $request->input('url');
            $challenge->description = $request->input('description');
            $challenge->flag = $request->input('flag');
            $challenge->score = $request->input('score');
            $challenge->save();
            return APIReturn::success($challenge);
        }catch (\Exception $error){
            //echo $error;
            return APIReturn::error("database_error");
        }

    }


}
