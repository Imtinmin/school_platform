<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursecategory;
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
}
