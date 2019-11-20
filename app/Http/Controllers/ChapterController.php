<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use App\Chapter;
use App\Course;
use APIReturn;

class ChapterController extends Controller
{
    //
    public function add(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'chapterName' => 'required',
            'course_id' => 'required',
            'order_num' => 'required',
        ], [
            'chapterName.required' => '章节名称不能为空',
            'course_id.required' => '课程ID不能为空',
            'order_num.required' => '课程序号不能为空'
        ]);
        if ($validator->fails()) {
            return APIReturn::error($validator->errors()->all());
        }
        try {
            if (!Course::find($request->input('course_id'))) {
                return \APIReturn::error("课程不存在");
            }
            $newchapter = new Chapter();
            $newchapter->chapter_name = $request->input('chapterName');
            $newchapter->order_num = $request->input('order_num');
            $newchapter->course_id = $request->input('course_id');
            $newchapter->save();

            return APIReturn::success($newchapter);
        } catch (\Exception $error) {
            return APIReturn::error("database_error");
        }


    }

    public function delete(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'chapter_id' => 'required',
        ],[
            'chapter_id.required' => '章节ID不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }

        try{
            if(!$chapter = Chapter::find($request->input('chapter_id'))){
                return \APIReturn::error("章节不存在");
            }else{
                Video::where('chapter_id',$request->input('chapter_id'))->delete();
                $chapter->delete();
                return APIReturn::success($chapter,"删除成功");
            }
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }

    }

    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'chapter_id' => 'required',
            'chapterName' => 'required',
            //'course_id' => 'required',
            'order_num' => 'required',
        ], [
            'chapter_id' => '章节ID不能为空',
            'chapterName.required' => '章节名称不能为空',
            //'course_id.required' => '课程ID不能为空',
            'order_num.required' => '课程序号不能为空'
        ]);
        if ($validator->fails()) {
            return APIReturn::error($validator->errors()->all());
        }
        try {
            if (! $chapter = Chapter::find($request->input('chapter_id'))) {
                return \APIReturn::error("课程不存在");
            }
            $chapter->chapter_name = $request->input('chapterName');
            $chapter->order_num = $request->input('order_num');
            //$chapter->course_id = $request->input('course_id');
            $chapter->save();

            return APIReturn::success($chapter);
        } catch (\Exception $error) {
            return APIReturn::error("database_error");
        }
    }

    public function list(){
        try{
            return APIReturn::success(Chapter::all());
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }
}


