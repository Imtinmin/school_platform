<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
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
            $course_name = Course::find($request->input('course_id'));
            return APIReturn::success($course_name);
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }


    public function AddCourse(Request $request){
        $validator = \Validator::make($request->all(),[
            'course_name' => 'required',
        ],[
            'course_id.required' => '课程id不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $newcourse = new Course();
            $newcourse->course_name = $request->input('courseName');
            $newcourse->image_url = $request->input('image_url') ? :"https://oneanime.reallct.com/acg";
            $newcourse->save();
            return APIReturn::success($newcourse);
        }catch (\Exception $err){
            return APIReturn::error("database_error");
        }

    }

    public function DelCourse(Request $request){

    }

    public function CreateTestCourse(){
        try{
            for ($i =0;$i<=20;$i++) {
                Course::create([
                    'course_name' => 'TestCourse' . $i,
                    'image_url' => 'https://oneanime.reallct.com/acg',
                    'course_category_id' => [1,2][array_rand([1,2])]
                ]);
            }
            return APIReturn::success("创建测试课程成功");
        }catch (\Exception $err){
            echo $err;
            return APIReturn::error("database_error");
        }

    }
}
