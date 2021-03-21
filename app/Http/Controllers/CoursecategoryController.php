<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Video;
use Illuminate\Http\Request;
use App\Coursecategory;
use App\Course;
use APIReturn;

class CoursecategoryController extends Controller
{
    //
    public function createCategory(Request $request){
        $validator = \Validator::make($request->all(),[
            'category_name' => 'required',
        ],[
            'category_name.required' => '课程类别不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $CourseCategory = new Coursecategory();
            $CourseCategory->category_name = $request->input('category_name');
            $CourseCategory->save();
            return APIReturn::success($CourseCategory);
        }catch (\Exception $error){
            //echo $error;
            return APIReturn::error("database_error");
        }
    }

    public function delCategory(Request $request){
        $validator = \Validator::make($request->all(),[
            'category_id' => 'required',
        ],[
            'category_id.required' => '课程类别不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            if(!$courseCategory = Coursecategory::find($request->input('category_id'))){
                return APIReturn::error("该类型不存在");
            }
            $courseCategory->delete();
            return APIReturn::success(null,"删除成功");
        }catch (\Exception $error){
            //echo $error;
            return APIReturn::error("database_error");
        }
    }

    public function update(Request $request){
        $validator = \Validator::make($request->all(),[
            'category_id' => 'required',
            'category_name' => 'required'
        ],[
            'category_id.required' => '课程类别不能为空',
            'category_name.required' => '课程名不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            if(!$courseCategory = Coursecategory::find($request->input('category_id'))){
                return APIReturn::error("该类型不存在");
            }
            $courseCategory->category_name = $request->input('category_name');
            $courseCategory->save();
            return APIReturn::success(null,"删除成功");
        }catch (\Exception $error){
            //echo $error;
            return APIReturn::error("database_error");
        }
    }


    public function list(){
        try{
            $CourseList = Coursecategory::with('course')->get();
            return APIReturn::success($CourseList);
        }catch (\Exception $error){
            //echo $error;
            return APIReturn::error("database_error");
        }

    }


    public function AllCourseInfo(){
        try{
            $CourseList = Coursecategory::with('course')->get()->each(function ($item,$value){
                $item->course->each(function ($item,$value){
                    $item->chapter = Chapter::where('course_id',$item->course_id)->orderBy('order_num')->get();
                    $item->chapter->each(function ($item,$value){
                        $item->video = Video::where('chapter_id',$item->chapter_id)->orderBy('order_num')->get();
                    });
                });
            });
            return APIReturn::success($CourseList);
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }
}
