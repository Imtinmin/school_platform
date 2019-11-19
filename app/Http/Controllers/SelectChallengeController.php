<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examination;
use App\SelectChallenge;
use APIReturn;

class SelectChallengeController extends Controller
{
    //
    public function getChallenge(Request $request){
/*
        if(!$request->session()->has('StartTime')){
            session(['StartTime' => time()]);
            //return APIReturn::error("你还没开始答题");
        }
        $SurplusTime = 1800 - (time() - $request->session()->get('StartTime'));     //30分钟
        $EndTime = 1800 + $request->session()->get('StartTime');
        //echo $EndTime.PHP_EOL;
        //echo time().PHP_EOL;

        if(time() >= $EndTime){
            return APIReturn::error("timeout");
        }
        $challenge = SelectChallenge::all()->makeHidden(['updated_at','created_at'])->each(function ($item,$value){
            $item->options = [
                $item->option1,
                $item->option2,
                $item->option3,
                $item->option4
            ];
        })->makeHidden(['option1','option2','option3','option4']);
        $data = [
          //'SurplusTime' => $SurplusTime
            'EndTime' => $EndTime,
            'Challenge' => $challenge
        ];
        return APIReturn::success($data);*/
    }


    /*public function is_start(Request $request){
        if(!$request->session()->has('StartTime')) {
            return APIReturn::error("no_yet");
        }else{
            return APIReturn::success("is_start");
        }
    }*/


    /*public function reset(Request $request){                          //重置session
        $request->session()->forget('StartTime');
        return APIReturn::success("ResetStatus");
    }*/

    public function addChoiceQuestionToExam(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'data' => 'required|array',
            'examID' => 'required'
        ],[
            'data.required' => '缺少题目字段',
            'data.array' => '题目字段格式不符',
            'examID.required' => '缺少测试ID'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            if(!$exam = Examination::find($request->input('examID'))){
                return APIReturn::error("不存在这个测验");
            }
            $AllQuestions = $request->input('data');
            for($i=0;$i<sizeof($AllQuestions);$i++){
                $new = new SelectChallenge();
                $new-> title = $AllQuestions[$i]["title"];
                $new-> exam_id = $exam->exam_id;
                $new-> option1 = $AllQuestions[$i]["option1"];
                $new-> option2 = $AllQuestions[$i]["option2"];
                $new-> option3 = $AllQuestions[$i]["option3"];
                $new-> option4 = $AllQuestions[$i]["option4"];
                $new-> answer = $AllQuestions[$i]["answer"];
                $new->is_multiple = 0;    //暂时全单选，解决不了多选的答案存储问题
                $new->save();
            }
            return APIReturn::success(null,"添加成功");
        }catch (\Exception $error){
            echo $error;
            //return APIReturn::error("database_error");
        }
    }



    public function CreateTestSelectChallenge(){
        try{
            for ($i =0;$i<=20;$i++) {
                SelectChallenge::create([
                    'title' => 'test'.$i,
                    'option1' => '1',
                    'option2' => '2',
                    'option3' => '3',
                    'option4' => '4',
                    'answer' => random_int(1,4)     //随机答案
                ]);
            }
            return APIReturn::success("创建测试的选择题成功");
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }



}
