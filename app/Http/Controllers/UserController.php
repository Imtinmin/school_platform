<?php

namespace App\Http\Controllers;


use App\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;  //时间包
use Auth;
use App\User;
use App\Ctfachieve;
use Illuminate\Support\Facades\Hash;
use APIReturn;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
    //
    private $user;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 注册
     * @param Request $request
     * @return
     * @author tinmin
     */
    public function register(Request $request){
        $input = $request->only('email','name','password');
        $validator = \Validator::make($input,[
           'email' => 'required|email|unique:users',
           'name' => 'required|max:30|unique:users',
           'password' => 'required|max:64|min:8',
        ],[
            'email.required' => '缺少邮箱字段',
            'email.email' => '邮箱格式不符',
            'email.unique' => '该邮箱已被注册',
            'name.required' => '缺少用户名字段',
            'name.max' => '用户名过长',
            'name.unique' => '用户名已被注册',
            'password.required' => '缺少密码字段',
            'password.max' => '密码太长',
            'password.min' => '密码至少8位'

        ]);
        if($validator->fails()){
            return APIReturn::error($validator->errors()->all());
        }

        try {
            $this->user->create([
                'email' => $input['email'],
                'name' => $input['name'],
                'password' => Hash::make($input['password']),
                'signUpTime' => Carbon::now('Asia/Shanghai'),
                'lastLoginTime' => Carbon::now('Asia/Shanghai'),
                'token' => str_random(32),
            ]);

        } catch (\Exception $err) {
            return APIReturn::error('database_error');
        }
        return APIReturn::success($request->only('email','name','token'),'注册成功');

    }


    /**
     * 登录
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @author tinmin
     */
    public function login(Request $request){
        $credentials = $request->only('email','password');
        $validator = \Validator::make($credentials,[
            'email' => 'required|email',
            'password' => 'required|max:64'
        ],[
            'email.required' => '缺少邮箱字段',
            'email.email' => '邮箱格式不符',
            'password.required' => '缺少密码字段',
            'password.size' => '密码太长'
        ]);

        if($validator->fails()){
            return  APIReturn::error($validator->errors()->all());
        }
        if(Auth::once($credentials)){
            $user = Auth::getUser();
            if($user->banned){
                return APIReturn::error("你的账号被封了,请联系管理员");
            }
            $this->user->where('email',$request->input('email'))->update(['lastLoginTime' => Carbon::now('Asia/Shanghai')]);   //更新登录时间
            $access_token = JWTAuth::fromUser($user,['is_admin' => $user->admin]);
            return APIReturn::success(['access_token' => $access_token ],'login_success',200);
        }else{
            return APIReturn::error("invalid_email_or_password",401);
        }

    }

    /**
     * 个人用户信息
     * @return \Illuminate\Http\JsonResponse
     * @author tinmin
     */
    public function getAuthInfo(){
        try{
            $user = JWTAuth::parseToken()->toUser();
            //echo ($user->name);  //name
            return APIReturn::success($user);
        }catch (JWTException $err){
            return APIReturn::error('token_invalid',401);
        }
    }

    public function tokenVerify(Request $request){
        $token = $request->route('token');
        try{
            $user = JWTAuth::parseToken()->toUser();
        }catch (\Exception $err){

        }
    }


    /**
     * 排行
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function getRanking(Request $request){

        $page = $request->input('page') ?? 1;
        try {
            //$result = User::where([['admin', '0'], ['banned', '0']])->orderBy('score','desc')->get();
            $result = User::where([['admin', '0'], ['banned', '0']])->orderBy('score','desc')->skip(($page-1)*10)->take(10)->get();
            $result->makeHidden(['token', 'admin', 'banned', 'lastLoginTime', 'signUpTime', 'email']);
            $total = User::where([['admin', '0'], ['banned', '0']])->count();
            } catch (\Exception $err) {
                echo $err;
                return APIReturn::error('database_error');
            }
            return APIReturn::success(['total' => $total,'ranking' => $result]);
        }


    public function UserList(){
        try{
            $UserList = User::all();
            return APIReturn::success($UserList);
        }catch (\Exception $err){
            return APIReturn::error("database_error");
        }
    }

    /**
     * 修改密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function ResetPassword(Request $request){
        try{
            $user = JWTAuth::parseToken()->toUser();
            $userid = $user->user_id;
            $validator = \Validator::make($request->all(),[
                'newpassword' => 'required|min:8',
            ],[
                'newpassword.required' => '密码字段不能为空',
                'newpassword.min' => '密码至少8位'
            ]);
            //echo $user;
            if($validator->fails()){
                return APIReturn::error($validator->errors()->all(dele));
            }
            try{
                $user = User::find($userid);
                $user->password = Hash::make($request->input('newpassword'));

            }catch (\Exception $err){
                return APIReturn::error('database_error');
            }
            return APIReturn::success($user);
        }catch (JWTException $err){
            return APIReturn::error('token_invalid');
        }
    }

    /**
     * 查看他人信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function SelectUser(Request $request){
        $validator = \Validator::make($request->only('user_id'),[
            'user_id' => 'required|numeric',
        ]);
        if($validator->fails()){
            //var_dump($validator->errors());
            return APIReturn::error("Error");
        }
        try{
            $UnShowUser = User::where('admin',1)->get();
            foreach ($UnShowUser as $usu){
                if($request->input('user_id') == $usu["user_id"]){
                    return APIReturn::error("Error");
                }
            }

            $user_id = $request->input('user_id');
            //$user = User::find($user_id);
            $user = User::where('user_id',$user_id)->get()->first();
            //echo $user->challenges;
            $solvedChallenges = $user->challenges->makeHidden(['description','qid','laravel_through_key','url','updated_at','flag'])->each(function($item,$value){
               $item->category_name = Category::find($item->category_id)->category_name;
               $item->makeHidden(['category_id']);
            });
            $data = ["name" => $user->name,"email" => $user->email,"score" => $user->score,'SolvedChallenges' => $solvedChallenges, "lastLoginTime" => $user->lastLoginTime];
            return APIReturn::success($data);
        }catch (\Exception $e){
            //echo $e;
            return APIReturn::error("用户不存在");
        }
    }

    /**
     * 升级管理员
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function UpdateAdmin(Request $request){
        $validator = \Validator::make($request->only('user_id'),[
            'user_id' => 'required|numeric',
        ]);
        if($validator->fails()){
            //var_dump($validator->errors());
            return APIReturn::error("Error");
        }
        try{
            $user = User::where('user_id',$request->input('user_id'))
                ->update(['admin' => 1]);
            return APIReturn::success($user,'操作成功');
        }catch (\Exception $error){
            return APIReturn::error('database_error');
        }
    }

    public function degrade(Request $request){
        $validator = \Validator::make($request->only('user_id'),[
            'user_id' => 'required|numeric',
        ]);
        if($validator->fails()){
            return APIReturn::error("Error");
        }
        try{
            $user = User::where('user_id',$request->input('user_id'))
                ->update(['admin' => 0]);
            return APIReturn::success($user,'操作成功');
        }catch (\Exception $error){
            return APIReturn::error('database_error');
        }
    }


    /**
     * 禁用户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function BannedUser(Request $request){
        $validator = \Validator::make($request->only('user_id'),[
            'user_id' => 'required|numeric',
        ]);
        if($validator->fails()){
            //var_dump($validator->errors());
            return APIReturn::error("Error");
        }
        try{
            $user = User::where('user_id',$request->input('user_ud'))
                ->update(['banned' => 1]);
            return APIReturn::success($user,'操作成功');
        }catch (\Exception $error){
            return APIReturn::error('database_error');
        }
    }

    /**
     * 删除用户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function DeleteUser(Request $request){
        $validator = \Validator::make($request->only('user_id'),[
            'user_id' => 'required|numeric',
        ]);
        if($validator->fails()){
            return APIReturn::error("Error");
        }
        try{
            $user = User::find($request->input('user_id'));
            $user->delete();
            return APIReturn::success($user,"操作成功");
        }catch (\Exception $error){
            return APIReturn::error("database_error");
        }
    }

    public function CreateTestUser(){
        try{
            for ($i = 6;$i < 20; $i++){
                $this->user->create([
                    'email' => $i."@qq.com",
                    'name' => "Test".$i,
                    'password' => Hash::make($i),
                    'signUpTime' => Carbon::now('Asia/Shanghai'),
                    'lastLoginTime' => Carbon::now('Asia/Shanghai'),
                    'token' => str_random(32),
                ]);
            }
            return APIReturn::success(null,"创建测试用户成功");
        }catch (\Exception $error){
            echo $error;
            return APIReturn::error("database_error");
        }
    }


}
