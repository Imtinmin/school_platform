<?php

namespace App\Http\Controllers;


use App\Examination;
use APIReturn;
use App\SelectChallenge;
use App\Examlog;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ExaminationController extends Controller
{

    /**
     * 获取题目
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function getExam(Request $request)
    {

        if(!$examID = $request->input('exam_id')){
            return APIReturn::error("error");
        }
        if(!$exam=Examination::find($examID)){
            return APIReturn::error("exam_not_exists");
        }
        if(!$request->session()->has('StartTime') && !$request->session()->has('examID')){
            session(['StartTime' => time()]);
        }
        session(['examID' => $request->input('exam_id')]);  //不管session 中的examID 和传入的一不一样，直接覆盖

        $EndTime = 1800 + $request->session()->get('StartTime');
        try{
            $choice_question = $exam->choiceQuestion()->get()->makeHidden(['created_at','updated_at','answer','option1','option2','option3','option4'])->each(function ($item,$value){
               $item->options = [
                   $item->option1,
                   $item->option2,
                   $item->option3,
                   $item->option4
               ];
            });
            $data = [
                //'SurplusTime' => $SurplusTime
                'EndTime' => $EndTime,
                'choice_question' => $choice_question
            ];
            return  APIReturn::success($data);
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }


    /**
     * 获取测验状态   时间到 未开始 已开始
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function Status(Request $request){
        if($request->session()->has('StartTime') && $request->session()->has('examID')){
            if($request->session()->get('StartTime') + 1800 < time()){
                return APIReturn::error("timeout",403,null);
            }
            return APIReturn::success("is_start");
        }else{
            return APIReturn::success(null,"no_yet",400);
        }
    }



    public function SubmitAnswer(Request $request){
        try{
            $user = JWTAuth::parseToken()->toUser();
        }catch (JWTException $err){
            return APIReturn::error('token_invalid',401);
        }
        if($request->session()->get('StartTime') + 1800 < time()){
            return APIReturn::error("timeout",403,null);
        }

        $validator = \Validator::make($request->all(),[
            'answer' => 'required|array',
            'examID' => 'required'
        ], [
            'answer.required' => '缺少答案字段',
            'answer.array' => '答案格式不符',
            'examID.required' => '缺少测试ID字段'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        if(!$exam = Examination::find($request->input('examID'))){
            return APIReturn::error("The Exam not exists");
        }
        $answer = $request->input("answer");
        //return $answer;
        $correctNum = 0;
        $correctList = [];
        try{
            for($i = 0;$i < sizeof($answer);$i++){
                if(array_key_exists("radio",$answer[$i])){
                    if(SelectChallenge::find($answer[$i]["id"])->answer === $answer[$i]["radio"]){
                        $correctNum += 1;
                        array_push($correctList,$answer[$i]["id"]);
                    }
                }
            }
            $score = $correctNum * ($exam->score);

            $newlog = new Examlog();
            $newlog->exam_id = $request->input('examID');
            $newlog->user_id = $user->user_id;
            $newlog->correct_count = $correctNum;
            $newlog->score = $score;
            $newlog->save();

            $request->session()->forget('StartTime');
            $request->session()->forget('examID');
            return APIReturn::success(['correctNum' => $correctNum,'correctList' => $correctList,'score' => $score]);
        }catch (\Exception $error){
            //return $error;
            return APIReturn::error("database_error");
        }
    }


    /**
     * 放弃答题
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AbandonExam(Request $request)
    {         //重置session
        $request->session()->forget('StartTime');
        $request->session()->forget('examID');
        return APIReturn::success("ResetStatus");
    }


    /*public function test(){
        var_dump(Examination::where('chapter_id',1)->first());
    }*/


    //admin
    public function ExamList()
    {
        try{
            $tableData = Examination::with('choiceQuestion')->get();
            return APIReturn::success($tableData);
        }catch (\Exception $err){
            return APIReturn::error("database_error");
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function AddExam(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'examName' => 'required',
            'score' => 'required|numeric',
        ],[
            'examName.required' => '课程名称不能为空',
            'score.required' => '分数字段不能为空',
            'score.numeric' => '分数字段不符',
        ]);
        if($validator->fails())
        {
            return APIReturn::error($validator->errors()->all());
        }
        if(!($request->input('chapter_id')) &&  !($request->input('course_id'))){
            return APIReturn::error('章节测验or综合测验?');
        }
        if($request->input('chapter_id')){
            if(Examination::where('chapter_id',$request->input('chapter_id'))->first()){
                return APIReturn::error('该章节已经有测验了');
            }
        }
        if($request->input('course_id')){
            if(Examination::where('course_id',$request->input('course_id'))->first()){
                return APIReturn::error('该课程已经有综合测验了');
            }
        }
        if(Examination::where('chapter_id',$request->input('chapter_id')))
        try{
            $new_exam = new Examination();
            $new_exam->exam_name = $request->input('examName');
            $new_exam->score = $request->input('score');
            $new_exam->chapter_id = $request->input('chapter_id');
            $new_exam->course_id = $request->input('course_id');
            $new_exam->save();
            return APIReturn::success($new_exam);
        }catch (\Exception $err){
            //echo $err;
            return APIReturn::error("database_error");
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function DelExam(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'examID' => 'required',
        ],[
            'examID.required' => '测验ID字段不能为空'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }

        try{
            if(!$exam = Examination::find($request->examID)){
                return APIReturn::error("不存在这个测验");
            }
            $exam->delete();
            return APIReturn::success("删除成功");
        }catch (\Exception $err){
            return APIReturn::error("database_error");
        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function UpdateExam(Request $request){
        $validator = \Validator::make($request->all(),[
            'examID' => 'required',
            'examName' => 'required',
            'score' => 'required|numeric',
        ],[
            'examID.required' => '测验ID字段不能为空',
            'examName.required' => '课程名称不能为空',
            'score.required' => '分数字段不能为空',
            'score.numeric' => '分数字段不符',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        if(!($request->input('chapter_id')) ^ ($request->input('course_id'))){
            return APIReturn::error('章节测验or综合测验?');
        }
        try{
            if(!$exam = Examination::find($request->input('examID'))){
                return APIReturn::error("不存在这个测验");
            }
            if($request->input('chapter_id')){
                if(Examination::where('chapter_id',$request->input('chapter_id'))->first()){
                    return APIReturn::error('该章节已经有测验了');
                }
            }
            if($request->input('course_id')){
                if(Examination::where('course_id',$request->input('course_id'))->first()){
                    return APIReturn::error('该课程已经有综合测验了');
                }
            }
            $exam->exam_name = $request->input('examName');
            $exam->score = $request->input('score');
            $exam->chapter_id = $request->input('chapter_id');
            $exam->course_id = $request->input('course_id');
            $exam->save();
            //var_dump($exam);
            return APIReturn::success("修改成功");
        }catch (\Exception $err){
            //echo $err;
            return APIReturn::error("database_error");
        }
    }

}
