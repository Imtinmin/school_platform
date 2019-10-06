<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use APIReturn;


class CategoryController extends Controller
{
    //
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * 添加题目类型
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author tinmin
     */
    public function add(Request $request){
        $validator = \Validator::make($request->all(),[
            'category_name' => 'required|unique:categories'
            ],[
                'category_name.required' => '类型字段不能为空',
                'category_name.unique' => '类型字段已存在',
            ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all(),"invalid_parameters");
        }
        try{
            $category = new Category();
            $category->category_name = $request->input('category_name');
            $category->save();

        }catch (\Exception $err){
            return APIReturn::error('database_error');
        }
        return APIReturn::success($category);
    }

    /**
     * 删除题目类型
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(Request $request){
        $validator = \Validator::make($request->only('category_id'),[
            'category_id' => 'required'
        ],[
            'category_id.required' => '类型编号错误'
        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        $this->category->destroy($request->input('category_id'));
        try{
            $this->category::where('category_id', $request->input('category_id'))->delete();
        }catch (\Exception $err){
            return APIReturn::error('database_error');

        }
        return APIReturn::success();

    }

    /**
     * 修改题目类型
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request){
        $validator = \Validator::make($request->all(),[
            'category_name' => 'required|unique:categories',
        ],[
            'category_name.required' => '类型字段不能为空',
            'category_name.unique' => '类型字段已存在',
        ]);

    }


    /**
     * 题目类型列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request){
        try{
            $CategoryList = $this->category::with('challenges')->get();
            $CategoryList->makeHidden(['updated_at','created_at']);
        }catch (\Exception $err){
            return APIReturn::error('database_error');
        }

        return APIReturn::success($CategoryList);
    }


}
