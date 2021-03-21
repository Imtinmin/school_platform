<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APIReturn;
use App\Video;
use App\Course;
use App\Chapter;

class VideoController extends Controller
{
    //
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request){
        $validator = \Validator::make($request->all(),[
            'title' => 'required',
            'url' => 'required|url',
            'chapter_id' => 'required',
            'content' => 'required',
            'ppt_url' => 'nullable|url',
            'order_num' => 'required|numeric'
        ],[
            'title.required' => '名称不能为空',
            'url.required' => '视频链接不能为空',
            'url.url' => '视频链接格式不符',
            'chapter_id.required' => '章节ID不能为空',
            'content.required' => '视频介绍不能为空',
            'ppt_url.url' => 'ppt链接格式不符',
            'order_num.required' => '序号字段不能为空',
            'order_num.numeric' => '序号格式不对'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            if(!Chapter::where('chapter_id')){
                return APIReturn::error("章节不存在");
            }
            $newVideo = new Video();
            $newVideo->title = $request->input('title');
            $newVideo->url = $request->input('url');
            $newVideo->content = $request->input('content');
            $newVideo->chapter_id = $request->input('chapter_id');
            $newVideo->ppt_url = $request->input('ppt_url');
            $newVideo->order_num = $request->input('order_num');
            $newVideo->save();
            return APIReturn::success($newVideo);
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }

    public function delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'video_id' => 'required',
        ],[
            'video_id.required' => '视频ID不能为空',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $video = Video::find($request->input('video_id'));
            $video->delete();
            return APIReturn::success("删除成功");
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }

    public function edit(Request $request){
        $validator = \Validator::make($request->all(),[
            'video_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'url' => 'required|url',
            'order_num' => 'required|numeric',
        ],[
            'video_id.required' => '视频ID不能为空',
            'title.required' => '视频标题不能为空',
            'content.required' => '视频介绍不能为空',
            'url.required' => '视频链接不能为空',
            'url.url' => '视频url格式不符',
            'order_num.required' => '序号不能为空',
            'order_num.numeric' => '序号格式不符',
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try{
            $video = Video::find($request->input('video_id'));
            $video->title = $request->input('title');
            $video->content = $request->input('content');
            $video->url = $request->input('url');
            $video->order_num = $request->input('order_num');
            $video->ppt_url = $request->input('ppt_url');
            $video->save();
            return APIReturn::success($video,"修改成功");
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }
}
