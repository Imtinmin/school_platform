<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Http\Request;
use App\Category;
use App\Ctfachieve;
use APIReturn;
use function foo\func;


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
        try{
            if(!$category = Category::find($request->input('category_id'))){
                return APIReturn::error("该题目类型不存在");
            }
            Category::where('category_id', $request->input('category_id'))->delete();
            Challenge::where('category_id',$request->input('category_id'))->each(function($item,$key){
                Ctfachieve::where('qid',$item->qid)->delete();
            });
            return APIReturn::success(null,"删除成功");
        }catch (\Exception $err){
            return APIReturn::error('database_error');

        }
    }

    /**
     * 修改题目类型
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request){
        $validator = \Validator::make($request->all(),[
            'category_id' => 'required',
            'category_name' => 'required|unique:categories',
        ],[
            'category_id.required' => '类型ID不能为空',
            'category_name.required' => '类型字段不能为空',
            'category_name.unique' => '类型字段已存在',
        ]);

        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }
        try {
            if(!$category = Category::find($request->input('category_id'))){
                return APIReturn::error("该题目类型不存在");
            }
            $category->category_name = $request->input("category_name");
            $category->save();
            return APIReturn::success("修改成功");
        }catch (\ErrorException $err){
            return APIReturn::error("database_error");
        }
    }


    /**
     * 题目类型列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request){
        try{
            $CategoryList = Category::all();
            //$CategoryList->makeHidden(['updated_at','created_at']);
        }catch (\Exception $err){
            return APIReturn::error('database_error');
        }

        return APIReturn::success($CategoryList);
    }


}
