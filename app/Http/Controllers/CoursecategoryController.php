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

    public function list(){
        try{
            $CourseList = Coursecategory::with('course')->get()->makeHidden(['updated_at','created_at']);
            return APIReturn::success($CourseList);
        }catch (\Exception $error){
            echo $error;
            return APIReturn::error("database_error");
        }

    }


    public function AllCourseInfo(){
        try{
            $CourseList = Coursecategory::with('course')->get()->each(function ($item,$value){
                $item->course->each(function ($item,$value){
                    //$item->chapter = Course::find($item->course_id)->chapter;
                    $item->chapter = Chapter::where('course_id',$item->course_id)->orderBy('order_num')->get();
                    $item->chapter->each(function ($item,$value){
                       //$item->video = Chapter::find($item->chapter_id)->video;
                        $item->video = Video::where('chapter_id',$item->chapter_id)->orderBy('order_num')->get();
                    });
                    //echo $item->course_id;
                });
            });
            //$CourseList = Coursecategory::with('course')->get();
            return APIReturn::success($CourseList);
        }catch (\Exception $error){
            echo $error;
            return APIReturn::error("database_error");
        }
    }
}
