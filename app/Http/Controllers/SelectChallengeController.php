<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examination;
use App\SelectChallenge;
use APIReturn;

class SelectChallengeController extends Controller
{
    //


    public function addChoiceQuestionToExam(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'data' => 'required|array',
            'examID' => 'required'
        ],[
            'data.required' => '缺少题目字段',
            'data.array' => '题目字段格式不符',
            'examID.required' => '缺少测验ID'
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
            //echo $error;
            return APIReturn::error("database_error");
        }
    }


    public function updateChoiceQuestion(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'title' => 'required',
            'id' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required'
        ],[
            'title.required' => '缺少题目字段',
            'examID.required' => '缺少题目ID',
            'option1.required' => '缺少选项1字段',
            'option2.required' => '缺少选项2字段',
            'option3.required' => '缺少选项3字段',
            'option4.required' => '缺少选项4字段',
            'answer.required' => '缺少答案字段'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $choice_question = SelectChallenge::find($request->input('id'));
            $choice_question->title = $request->input('title');
            $choice_question->option1 = $request->input('option1');
            $choice_question->option2 = $request->input('option2');
            $choice_question->option3 = $request->input('option3');
            $choice_question->option4 = $request->input('option4');
            $choice_question->answer = $request->input('answer');
            $choice_question->save();
            return APIReturn::success($choice_question,"更改成功");
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }

    /**
     * 删除选择题
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function delChoiceQuestionFromExam(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'id' => 'required',
        ],[
            'id.required' => '缺少题目ID字段',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            if(!$choice_question = SelectChallenge::find($request->input('id'))){
                return APIReturn::error("不存在这个题目");
            }
            $choice_question->delete();
            return APIReturn::success(null,"删除成功");
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }


    }


    /*public function CreateTestSelectChallenge(){
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
    }*/



}
