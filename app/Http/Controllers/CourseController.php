<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Chapter;
use App\Examination;
use APIReturn;

class CourseController extends Controller
{
    //
    public function CourseList(){
        try{
            $allCourse = Course::with('category')->get()->makeHidden(['updated_at','created_at']);
            return APIReturn::success($allCourse);
        }catch (\Exception $error){
            echo $error;
            return APIReturn::error("database_error");
        }
    }

    public function CourseInfo(Request $request){
        $validator = \Validator::make($request->all(),[
            'course_id' => 'required',
        ],[
            'course_id.required' => '课程id不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $course = Course::find($request->input('course_id'));
            $chapter_id = $request->input('chapter_id');
            $course->chapter->each(function ($item,$key){
               $item->videos = Chapter::find($item->chapter_id)->video;
               if(Examination::where('chapter_id',$item->chapter_id)->first()){
                   $item->exam = Examination::where('chapter_id',$item->chapter_id)->first()->exam_id;
               }
            });
            Examination::where('chapter_id',1)->get();
            if(Examination::where('course_id',$request->input('course_id'))->first()){
                $course->exam = Examination::where('course_id',$request->input('course_id'))->first()->exam_id;
            }
            //echo $catalogue = Chapter::where('course_id',$request->input('course_id'))->get();
            return APIReturn::success($course);
        }catch (\Exception $error){
            echo $error;
            return APIReturn::error("database_error");
        }
    }


    public function AddCourse(Request $request){
        $validator = \Validator::make($request->all(),[
            'courseName' => 'required',
            'course_category_id' => 'required',
            'image_url' => 'required|url',
            'Introduction' => 'required'
        ],[
            'courseName.required' => '课程名称不能为空',
            'course_category_id.required' => '课程类别ID不能为空',
            'image_url.required' => '展示图片url不能为空',
            'image_url.url' => '展示图片url格式不符',
            'Introduction.required' => '课程介绍不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $newcourse = new Course();
            $newcourse->course_name = $request->input('courseName');
            $newcourse->image_url = $request->input('image_url') ? :"https://oneanime.reallct.com/acg";
            $newcourse->course_category_id = $request->input('course_category_id');
            $newcourse->Introduction = $request->input('Introduction');
            $newcourse->save();
            return APIReturn::success($newcourse);
        }catch (\Exception $err){
            //echo $err;
            return APIReturn::error("database_error");
        }

    }

    public function DelCourse(Request $request){
        $validator = \Validator::make($request->all(),[
            'course_id' => 'required',
        ],[
            'course_id.required' => '课程ID不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $course_id = $request->input('course_id');
            Course::find($course_id)->delete();
            return APIReturn::success(null, "delete success");
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }


    }

    public function CreateTestCourse(){
        try{
            for ($i =0;$i<=20;$i++) {
                Course::create([
                    'course_name' => 'TestCourse' . $i,
                    'image_url' => 'https://oneanime.reallct.com/acg',
                    'course_category_id' => [1,2][array_rand([1,2])],
                    'Introduction' => '测试用例',
                ]);
            }
            return APIReturn::success("创建测试课程成功");
        }catch (\Exception $err){
            echo $err;
            return APIReturn::error("database_error");
        }

    }

    public function UpdateCourse(Request $request){
        $validator = \Validator::make($request->all(),[
            'course_id' => 'required',
            'courseName' => 'required',
            'course_category_id' => 'required',
            'image_url' => 'required|url',
            'Introduction' => 'required'
        ],[
            'course_id' => '课程ID不能为空',
            'courseName.required' => '课程名称不能为空',
            'course_category_id.required' => '课程类别ID不能为空',
            'image_url.required' => '展示图片url不能为空',
            'image_url.url' => '展示图片url格式不符',
            'Introduction.required' => '课程介绍不能为空'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            if(!$course = Course::find($request->input('course_id'))) {
                return APIReturn::error("该课程不存在");
            }else{
                $course->course_name = $request->input('courseName');
                $course->image_url = $request->input('image_url');
                $course->course_category_id = $request->input('course_category_id');
                $course->Introduction = $request->input('Introduction');
                $course->save();
                return APIReturn::success($course,"修改成功");
            }
        }catch (\Exception $error){
                return APIReturn::error("database_error");
        }
    }

}
