<?php
/**
 * Created by phpstorm
 * User: tinmin
 * Date: 2019/9/20
 * Time: 8:08am
 */

namespace  App\Services;


class APIReturnService {

    /**
     * @param $data
     * @param $msg
     * @param $httpCode
     * @param $redirect
     * @return \Illuminate\Http\JsonResponse
     */
    protected function APIReturn($data, $msg, $httpCode, $redirect){

        $body['code'] = $httpCode;
        $body['data'] = $data;
        $body['msg'] = $msg;
        if($redirect){
            $body['redirect'] = $redirect;
        }
        return response()->json($body);
    }

    /**
     * @param array $data
     * @param string $msg
     * @param int $httpCode
     * @param null $redirect
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data=[],$msg="success", $httpCode=200, $redirect=null){
        return $this->APIReturn($data,$msg,$httpCode,$redirect);
    }

    /**
     * @param array $data
     * @param string $msg
     * @param int $httpCode
     * @param null $redirect
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($msg='error',$httpCode=500,$data=[],$redirect=null){
        return $this->APIReturn($data,$msg,$httpCode,$redirect);
    }
}


