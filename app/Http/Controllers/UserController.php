<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;  //时间包
use Auth;
use App\User;
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
            'name.required' => '缺少用户名字段',
            'name.max' => '用户名过长',
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
            return $validator->errors()->all();
        }
        if(Auth::once($credentials)){
            $this->user->where('email',$request->input('email'))->update(['lastLoginTime' => Carbon::now('Asia/Shanghai')]);   //更新登录时间
            $user = Auth::getUser();
            $access_token = JWTAuth::fromUser($user,['is_admin' => $user->admin]);
            return APIReturn::success(['access_token' => $access_token ],'login_success',200);
        }else{
            return APIReturn::fail([],"invalid_email_or_password",401);
        }

    }

    /**
     * 用户信息
     * @return \Illuminate\Http\JsonResponse
     * @author tinmin
     */
    public function getAuthInfo(){
        try{
            $user = JWTAuth::parseToken()->toUser();
            var_dump($user->name);  //name
            return APIReturn::success($user);
        }catch (JWTException $err){
            return APIReturn::error('token_invalid');
        }
    }

    public function tokenVerify(Request $request){
        $token = $request->route('token');
        try{
            $user = $this->user::where('token' ,$token)->firstOrFail();
        }catch (\Exception $err){

        }
    }


    public function logout(){

    }



}
